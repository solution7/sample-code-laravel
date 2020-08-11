<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
            'due_days' => 'required|numeric',
            'invoice_language_id' => 'required|exists:languages,id',
            'telephone_number' => 'nullable|numeric|digits_between:8,13',
            'email' => $emailRquired.'|email'
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
