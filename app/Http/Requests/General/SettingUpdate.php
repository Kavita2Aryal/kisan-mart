<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdate extends FormRequest
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
            'setting.isrequired.*' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'setting.isrequired.*.required' => 'This field is required.'
        ];
    }
}
