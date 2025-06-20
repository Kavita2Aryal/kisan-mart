<?php

namespace App\Http\Requests\Cms\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageCheck extends FormRequest
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
            'name'  => 'required|max:255|unique:pages,name,'.$this->uuid.',uuid',
            'alias' => 'required|max:255|unique:web_alias,alias,'.$this->alias_id
        ];
    }
}
