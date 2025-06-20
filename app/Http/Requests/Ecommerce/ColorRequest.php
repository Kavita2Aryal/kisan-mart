<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
            'color_group'  => 'required',
            'name'  => 'required|max:100|unique:colors,name,'.$this->uuid.',uuid',
            'value' => 'nullable|unique:colors,value,'.$this->uuid.',uuid'
        ];
    }
}
