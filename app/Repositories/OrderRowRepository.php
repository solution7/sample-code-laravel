<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Profile;

class OrderRowRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\OrderRow";
    }

    public function createForOrder(Request $request, Order $order)
    {
        $this->deleteForOrder($order->id);

        // Probably should be responsible for validating the invoiceuser here?
        $rows = $request->invoiceuser;

        $invoiceusers = [];

        foreach ($rows as $row) {
            $invoiceusers[] = $this->createSingle($row, $order->id, $request->vat_id);
        }

        return $invoiceusers;
    }

    private function createSingle($row, $orderId, $vatId)
    {
        $profile = Profile::find($row['profile_id']);

        $orderRow = parent::create([
            'profile_id' => $profile->id,
            'order_id' => $orderId,
            'tax_key_id' => $profile->tax_key_id,
            'vat_id' => $vatId,
            'amount' => $row['amount'],
        ]);

        return $orderRow;
    }

    public function deleteForOrder($orderId)
    {
        $rows = $this->model->where('order_id', $orderId);
        return $rows->delete();
    }
}
