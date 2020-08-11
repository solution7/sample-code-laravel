<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Eloquent\Repository;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Customer;

class InvoiceRepository extends Repository
{

    /**
     *
     * @return mixed
     */
    public function model()
    {
        return "\App\Models\Invoice";
    }

    public function createForOrder(Order $order)
    {
        $customer = Customer::find($order->customer_id);

        $invoice = parent::create([
            'customer_address_id' => ($customer->address()) ? $customer->address()->id : '',
            'country_id' => SYSTEM_COUNTRY_ID,
            'due_date' => $this->getDueDateFromCustomer($customer),
        ]);

        return $invoice;
    }

    private function getDueDateFromCustomer(Customer $customer)
    {
        $dueDays = $customer->due_days ?? Customer::DEFAULT_DUE_DAYS;
        $dueDate = Carbon::now();
        $dueDate->addDays($dueDays);

        return $dueDate;
    }
}
