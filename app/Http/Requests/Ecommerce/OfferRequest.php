<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name'                  => 'required|max:255|unique:offers,name,'.$this->uuid.',uuid',
            'alias'                 => 'required|max:255|unique:web_alias,alias,'.$this->alias_id,
            'title'                 => 'required',
            'discount_type'         => 'required',
            'start_date'            => 'nullable|date|after_or_equal:today',
            'end_date'              => 'nullable|date|after_or_equal:start_date',
        ];
    }
    
    public function attributes()
    {
        return [
            'name'                  => 'Offer Name',
            'alias'                 => 'Alias',
            'title'                 => 'Offer Title',
            'discount_type'         => 'Discount Type',
            'start_date'            => 'Offer Start Date',
            'end_date'              => 'Offer End Date',
        ];
    }
}
