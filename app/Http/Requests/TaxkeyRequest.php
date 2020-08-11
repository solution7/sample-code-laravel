<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxkeyRequest extends FormRequest
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
            'name' => [
                'required',
                Rule::unique('tax_keys')->where('country_id', SYSTEM_COUNTRY_ID)
                ->where(function ($query) {
                    if ($this->id != null) {
                        $query->where('id', '<>', $this->id);
                    }
                })
            ],
            'value' => 'required|numeric|between:1,100',
            'fee' => 'required|numeric|between:1,100',
            'tax' => 'numeric|between:1,100|nullable',
            'payroll_tax' => 'numeric|between:1,100|nullable'
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
