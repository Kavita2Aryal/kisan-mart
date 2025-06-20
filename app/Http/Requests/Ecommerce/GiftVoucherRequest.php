<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class GiftVoucherRequest extends FormRequest
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
            'title'  => 'required|max:255|unique:gift_vouchers,title,'.$this->uuid.',uuid',
            'alias' => 'required|max:255|unique:web_alias,alias,'.$this->alias_id,
            'code'  => 'required|max:32|unique:gift_vouchers,code,'.$this->uuid.',uuid',
            'value'    => 'required',
            'price'    => 'required',
        ];
    }
}
