<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitedUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255|regex:/^[A-Za-zéåäöÅÄÖ]+$/u',
            'last_name' => 'regex:/^[A-Za-zéåäöÅÄÖ]+$/u',
            'email' => 'required|string|email|max:255',
            'email_confirmation' => 'required|string|email|max:255|same:email',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'terms_conditions' => 'required',
            'privacy_policy' => 'required',
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
