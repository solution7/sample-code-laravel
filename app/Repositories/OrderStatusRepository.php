<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderStatus;

class OrderStatusRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\OrderStatus";
    }

    public function createForOrder(Request $request, Order $order)
    {
        $this->deleteForOrder($order->id);
        $user = $request->user();
        $orderStatusId = $request->pre_registered ?
          OrderStatus::PREREGISTERED : OrderStatus::PENDING;

        $orderStatus = parent::create([
          'set_by_user_id' => $user->id,
          'order_id' => $order->id,
          'order_status_type_id' => $orderStatusId,
        ]);

        return $orderStatus;
    }

    public function deleteForOrder($orderId)
    {
        $rows = $this->model->where('order_id', $orderId);
        return $rows->delete();
    }

    public function updateForOrder($userId, $orderId)
    {
        $rows = $this->model->where('order_id', $orderId);
        return $rows->update([
          'set_by_user_id' => $userId,
          'order_status_type_id' => OrderStatus::APPROVED,
        ]);
    }
}
