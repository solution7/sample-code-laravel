<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactDetailsRequest extends FormRequest
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
            'first_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'last_name' => 'nullable|regex:/^[a-zA-Z ]+$/u|max:255',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'telephone_number' => 'nullable|numeric|digits_between:10,13',
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
