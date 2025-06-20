<?php

namespace App\Http\Requests\Cms;

use Illuminate\Foundation\Http\FormRequest;

class WebAliasCheck extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!request()->ajax()) {
            return false;
        }
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
            'id'    => 'sometimes|required|integer|gte:0',
            'alias' => 'required|max:255|unique:web_alias,alias,'.$this->id
        ];
    }

    public function messages()
    {
        return [ 'alias.unique' => 'Web alias already exist in the system. Please enter unique alias.' ];
    }
}
