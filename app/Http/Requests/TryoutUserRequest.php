<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class TryoutUserRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'last_name' => 'regex:/^[a-zA-Z]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'email_confirmation' => 'required|string|email|max:255|same:email',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'phone_number' => 'digits_between:10,13|numeric',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'terms_conditions' => 'required',
            'privacy_policy' => 'required',
            'bic' => 'required|swiftbic',
            'iban' => 'required|iban',
            'profession' => 'required|exists:professions,name',
            'tax_key_id' => 'required|exists:tax_keys,id',
        ];

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
