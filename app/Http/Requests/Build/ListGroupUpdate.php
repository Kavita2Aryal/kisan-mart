<?php

namespace App\Http\Requests\Build;

use Illuminate\Foundation\Http\FormRequest;

class ListGroupUpdate extends FormRequest
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
            'name'  => 'required|max:255|unique:list_groups,name,'.$this->uuid.',uuid',
            'slug'  => 'required|max:255|unique:list_groups,name',
            'items' => 'required|array|min:1'
        ];
    }
}
