<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CountrySetting;

class UserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255|regex:/^[A-Za-zéåäöÅÄÖ]+$/u',
            'last_name' => 'regex:/^[A-Za-zéåäöÅÄÖ]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'email_confirmation' => 'required|string|email|max:255|same:email',
            'telephone_number' => 'digits_between:10,13|numeric',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'terms_conditions' => 'required',
            'privacy_policy' => 'required',
            'url' => 'required',
        ];

        $rules = $this->customRules($rules);

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

    private function customRules($rules)
    {
        $showProfession = CountrySetting::getOne('SHOW_PROFESSION_AND_COMMUNE');

        if ($this->path() == 'api/v1/register' && $showProfession == 1) {
            $rules['profession'] = 'exists:professions,name';
        }

        return $rules;
    }
}
