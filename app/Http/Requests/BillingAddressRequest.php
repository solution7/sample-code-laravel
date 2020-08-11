<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingAddressRequest extends FormRequest
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
        $emailRquired = ($this->invoicing == 1) ? 'required' : 'nullable';

        return [
            'company' => 'required',
            'address1' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
            'vat_number' => 'required',
            'email' => $emailRquired.'|email|unique:customers,email,'.$this->id
        ];
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
