<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\CountrySetting;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $requireAgreementApproval = CountrySetting::getOne('REQUIRE_AGREEMENT_APPROVAL_ON_PREREGISTER');
        $user = $this->user();

        if ($user->isAdmin() && $this->paid_at) {
            return [];
        }

        $rules = [
            'specification' => 'required|min:5',
            'customer_id' => [
              'required',
              Rule::exists('customers', 'id')->where(function ($query) use ($user) {
                  $query->where('profile_id', $user->profile->id);
              }),
            ],
            'currency_id' => 'required|exists:currencies,id',
            'work_dates' => 'required',
            'invoiceuser' => 'required|array',
            'vat_id' => 'required|exists:value_added_taxes,id'
        ];

        if ($this->order_agreement == 1 &&
            (!$this->pre_register || $this->pre_register && $requireAgreementApproval == 1)) {
            $rules['terms_and_conditions'] = 'required';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return VALIDATION_MESSAGE;
    }
}
