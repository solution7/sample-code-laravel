<?php

namespace App\Helpers;

use App\Models\TaxKey;
use App\Models\Country;
use App\Models\CountrySetting;

class CalculationHelper
{
    public static function baseOnInvoice($values)
    {
        $worker = $values['worker'];

        $invoiceAmount = $values['amount'];

        $vatRate = $values['vat'];

        $vatAmount = ($invoiceAmount * $vatRate) / 100;
        $feeAmount = $invoiceAmount * ($worker->fee / 100);

        $salaryCalculations = self::salaryCalculations($invoiceAmount, $worker);

        $data['amount'] = $invoiceAmount;
        $data['vat'] = $vatAmount;

        $worker->amount = $invoiceAmount;
        $worker->salary_total = $invoiceAmount;
        $worker->fee = $feeAmount;
        $worker->tax = $invoiceAmount * ($worker->tax / 100);
        $worker->payroll_tax = $invoiceAmount * ($worker->payroll_tax / 100);
        $worker->gross = $salaryCalculations['salaryGrossAmount'];
        $worker->to_pay = $worker->net = $salaryCalculations['salaryNetAmount'];

        $data['workers'] = [$worker];

        return $data;
    }

    private static function salaryCalculations($invoiceAmount, $worker)
    {
        $invoiceWOFeeAmount = $invoiceAmount - (($invoiceAmount * $worker->fee) / 100);

        $data['salaryTaxAmount'] = 0;
        $data['salarySocialCostAmount'] = $invoiceWOFeeAmount - ($invoiceAmount / $worker->tax_key_value);

        $data['salaryGrossAmount'] = $invoiceAmount / $worker->tax_key_value;
        $data['salaryNetAmount'] = $invoiceAmount / $worker->tax_key_value;
        return $data;
    }

    public static function baseOnNet($values)
    {
        $worker = $values['worker'];
        $max_invoice_amount = CountrySetting::getOne('SIMULATOR_MAX_INVOICE_AMOUNT') ?? 10000;

        $salaryNetAmount = $worker->net;

        $invoiceAmount = ($salaryNetAmount) * $worker->tax_key_value;

        $vatRate = $values['vat'];
        $vatAmount = ($invoiceAmount * $vatRate) / 100;
        $feeAmount = $invoiceAmount * ($worker->fee / 100);

        $salaryCalculations = self::salaryCalculations($invoiceAmount, $worker);

        $data['amount'] = $invoiceAmount;
        $data['vat'] = $vatAmount;

        $worker->amount = $invoiceAmount;
        $worker->salary_total = $invoiceAmount;
        $worker->fee = $feeAmount;
        $worker->tax = $invoiceAmount * ($worker->tax / 100);
        $worker->payroll_tax = $invoiceAmount * ($worker->payroll_tax / 100);
        $worker->gross = $salaryCalculations['salaryGrossAmount'];
        $worker->to_pay = $worker->net = $salaryNetAmount;

        $data['workers'] = [$worker];

        return $data;
    }

    public static function baseOnGross($values)
    {
        $taxKey = TaxKey::where('id', $values['tax_key_id'])->firstOrFail();
        $data = [
          'allowance_amount' => $values['allowance_amount'] ?? 0,
          'deduction_amount' => $values['deduction_amount'] ?? 0,
          'travel_amount' => $values['travel_amount'] ?? 0
        ];

        $salaryGrossAmount = $values['amount'];
        $salaryNetAmount = $salaryGrossAmount / ($taxKey->tax / 100);

        $salaryAmountPercentage = round(100 / $taxKey->value);

        $invoiceAmount = ($salaryNetAmount * 100)/ $salaryAmountPercentage;

        $invoiceWOFeeAmount = $invoiceAmount - (($invoiceAmount * $taxKey->fee) / 100);
        $vatRate = $values['vat'];


        $vatAmount = ($invoiceAmount * $vatRate) / 100;
        $feeAmount = $invoiceAmount * ($taxKey->fee / 100);
        $salaryTaxAmount = $invoiceAmount * ($taxKey->tax / 100);
        $salarySocialCostAmount = $invoiceAmount * ($taxKey->social_cost /100);

        $data['invoice_amount'] = $invoiceAmount;
        $data['vat_amount'] = $vatAmount;
        $data['fee_amount'] = $feeAmount;
        $data['salary_social_amount'] = $salarySocialCostAmount;
        $data['salary_tax_amount'] = $salaryTaxAmount;
        $data['salary_net_amount'] = $salaryNetAmount;
        $data['salary_gross_amount'] = $salaryGrossAmount;

        return $data;
    }
}
