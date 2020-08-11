<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxSchemeRequest extends FormRequest
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
            'name' => ['required', Rule::unique('tax_schemes')
                ->where('country_id', SYSTEM_COUNTRY_ID)
                ->where(function ($query) {
                    if ($this->id != null) {
                        $query->where('id', '<>', $this->id);
                    }
                    $query->where('deleted_at', null);
                })
            ],
            'public_name.0' => 'required',
            'public_name.*' => 'nullable|distinct',
            'tax_key.0' => 'required',
            'tax_key.*' => 'nullable|distinct',
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
