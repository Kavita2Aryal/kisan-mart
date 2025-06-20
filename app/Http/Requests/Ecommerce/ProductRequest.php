<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'                  => 'required|max:255|unique:products,name,'.$this->uuid.',uuid',
            'alias'                 => 'required|max:255|unique:web_alias,alias,'.$this->alias_id,
            'seo.meta_title'        => 'required|max:255',
            'seo.meta_description'  => 'required',
            'seo.meta_keywords'     => 'required',
            'seo.image_alt'         => 'required',
            'thumbnail'             => 'required',
            // 'sku'                   => 'sometimes|nullable|unique:product_variants,sku'.$this->id.',product_id',
            // 'custom_sku'            => 'sometimes|nullable|unique:product_variants,sku'.$this->id.',product_id',
            // 'variants.*.sku'        => 'sometimes|nullable|unique:product_variants,sku'.$this->id.',product_id',
        ];
    }

    public function attributes()
    {
        return [
            'seo.meta_title'        => 'Meta Title',
            'seo.meta_description'  => 'Meta Description',
            'seo.meta_keywords'     => 'Meta Keywords',
            'seo.image_alt'         => 'Meta Image Alt',
            'sku'                   => 'Product SKU',
            'variants.*.sku'        => 'Product SKU'
        ];
    }
}
