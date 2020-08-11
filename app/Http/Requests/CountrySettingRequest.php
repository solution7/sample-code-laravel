<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountrySettingRequest extends FormRequest
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
        $rules = [];

        if ($this['type'] == 'two_taxkeys') {
            $rules = [
              'name.0' => 'required',
              'name.*' => 'nullable|distinct',
              'tax_key_id.0' => 'required',
              'tax_key_id.*' => 'nullable|distinct',
            ];
        }

        $rules['type'] = 'required';

        return $rules;
    }

    public function messages()
    {
        return VALIDATION_MESSAGE;
    }
}
