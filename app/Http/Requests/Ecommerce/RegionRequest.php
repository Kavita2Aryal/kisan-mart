<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'name'                  => 'required|max:255|unique:countries,name,'.$this->uuid.',uuid',
            'country_id'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'name'                  => 'Name',
            'country_id'            => 'Country'
        ];
    }
}
