<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteCoworkerRequest extends FormRequest
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
            'last_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'email' => 'required|email|unique:users,email',
        ];
    }

    public function messages()
    {
        return VALIDATION_MESSAGE;
    }
}
