<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
          'name'    => 'required',
          'telephone_number'   => 'required|numeric|digits_between:8,13',
          'email'   => 'required|email',
          'message' => 'required',
          'terms'   => 'required',
        ];
    }

    public function messages()
    {
        return VALIDATION_MESSAGE;
    }
}
