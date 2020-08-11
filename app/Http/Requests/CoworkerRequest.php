<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoworkerRequest extends FormRequest
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
        return [
          'first_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
          'surname' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
          'email' => 'required|email|unique:users,email',
          'profession' => 'required',
          'social_security_number' => 'required',
          'address' => 'required',
          'city' => 'required',
          'zip_code' => 'required',
          'country' => 'required',
          'telephone_number' => 'nullable|numeric|digits_between:8,13',
          'bic' => 'required|swiftbic',
          'iban' => 'required|iban',
        ];
    }

    public function messages()
    {
        return VALIDATION_MESSAGE;
    }
}
