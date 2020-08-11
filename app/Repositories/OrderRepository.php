<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderRow;
use App\Models\OrderStatus;
use App\Models\Invoice;

class OrderRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Order";
    }

    public function createFromRequest(Request $request)
    {
        $user = $request->user();

        $order = parent::create([
            'invoice_id' => null,
            'user_id' => $user->id,
            'customer_id' => $request->customer_id,
            'currency_id' => $request->currency_id,
            'workdates' => json_encode($request->work_dates),
            'specification' => $request->specification,
            'show_date' => $request->display_dates,
            'show_hour' => $request->display_hours,
        ]);

        return $order;
    }

    public function updateFromRequest(Request $request)
    {
        $user = $request->user();
        $order = $this->findOrFail($request->id);

        if ($order->isEditable()) {
            $orderId = parent::update([
                'user_id' => $user->id,
                'customer_id' => $request->customer_id,
                'currency_id' => $request->currency_id,
                'workdates' => json_encode($request->work_dates),
                'specification' => $request->specification,
                'show_date' => $request->display_dates,
                'show_hour' => $request->display_hours,
            ], $order->id);

            $order = $this->findOrFail($order->id);
            return $order;
        } else {
            throw new AccessDeniedHttpException('Could not update order. Order is not editable.');
        }
    }

    public function associateWithInvoice(Order $order, Invoice $invoice)
    {
        $order->invoice_id = $invoice->id;
        $order->save();

        return $order;
    }

    public function shouldSendEmail(Order $order)
    {
        $customerHasEmail = $order->customer->email != '';
        $orderStatusId = $order->status->order_status_type_id;
        $orderIsPreregistered = $orderStatusId == OrderStatus::PREREGISTERED;

        return $customerHasEmail && !$orderIsPreregistered;
    }

    public function checkScopes(Request $request)
    {
        $user = $request->user();
        if ($user->isAccountAdministrator() || $user->isProjectAdministrator()) {
            $this->model->withoutGlobalScopes();
        }
        return $this;
    }
}
