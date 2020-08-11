<?php

namespace Tests\Feature;

use Tests\BaseTestCase;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\CalculationHelper;

class CalculationHelperTest extends BaseTestCase
{
    protected $invoiceAmountValues = [];

    public function setUp()
    {
        parent::setUp();

        $this->calculationValuesValid = [
            'amount' => 1000,
            'vat' => 2,
            'tax_key_id' => $this->taxKeyValid->id,
            'worker' => (object) [
                'id' => null,
                'amount' => 1000,
                'net' => 500,
                'gross' => 0,
                'fee' => 2,
                'tax' => 12,
                'payroll_tax' => 34,
                'tax_key_value' => 1.5,
                'allowance' => 0,
                'travel' => 0,
                'vacation' => false,
                'expenses' => [],
            ],
        ];
    }

    public function testCalculationBasedOnInvoiceAmountReturnsSameAmount()
    {
        $values = $this->calculationValuesValid;
        $data = CalculationHelper::baseOnInvoice($values);

        $this->assertEquals($values['amount'], $data['amount']);
    }

    public function testCalculationBasedOnNetAmountReturnsSameAmount()
    {
        $values = $this->calculationValuesValid;
        $data = CalculationHelper::baseOnNet($values);

        $this->assertEquals($values['worker']->net, $data['workers'][0]->net);
    }
}
