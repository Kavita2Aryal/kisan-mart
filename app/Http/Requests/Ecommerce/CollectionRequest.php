<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
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
            // 'name'                  => 'required|max:255|unique:collections,name,'.$this->collection_type.',collection_type',
            'alias'                 => 'required|max:255|unique:web_alias,alias,'.$this->alias_id,
            'collection_type'       => 'required',
        ];
    }

    public function attributes()
    {
        return [
            // 'name'                  => 'Name',
            'alias'                 => 'Alias',
            'collection_type'       => 'Collection Type',
        ];
    }
}
