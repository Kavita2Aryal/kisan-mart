<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
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
            'code'                  => 'required|max:32|unique:promo_codes,code,'.$this->uuid.',uuid',
            'discount_type'         => 'required',
            'discount'              => 'required',
            'type'                  => 'required',
            'start_date'            => 'required|date',
            'end_date'              => 'sometimes|nullable|date|after_or_equal:start_date',
        ];
    }

    public function attributes()
    {
        return [
            'code'                 => 'Code',
            'discount_type'         => 'Discount Type',
            'discount'              => 'Discount',
            'type'                  => 'Type',
            'start_date'            => 'Offer Start Date',
            'end_date'              => 'Offer End Date',
        ];
    }
}
