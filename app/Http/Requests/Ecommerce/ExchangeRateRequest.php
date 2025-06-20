<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRateRequest extends FormRequest
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
            'currency_id'              => 'required',
            'rate'                     => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'rate'                     => 'Exchange Rate',
            'currency_id'              => 'Country'
        ];
    }
}
