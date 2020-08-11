<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteAdministratorRequest extends FormRequest
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
            'first_name' => 'required|string|max:255|regex:/^[A-Za-zéåäöÅÄÖ\s\ ]+$/u',
            'last_name' => 'required|regex:/^[A-Za-zéåäöÅÄÖ\s\ ]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'user_permission_id' => 'required',
        ];
    }

    public function messages()
    {
        return VALIDATION_MESSAGE;
    }
}
