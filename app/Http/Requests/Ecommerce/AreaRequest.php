<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
            'name'                  => 'required|max:255|unique:areas,name,'.$this->uuid.',uuid',
            'city_id'               => 'required',
            'deliver_charge'        => 'sometimes|nullable|regex:/^\d+(\.\d{1,2})?$/',
            'conditional_amount'    => 'sometimes|nullable|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function attributes()
    {
        return [
            'name'                  => 'Name',
            'city_id'               => 'City',
            'deliver_charge'        => 'Delivery Charge',
            'conditional_amount'    => 'Conditional Amount',
        ];
    }
}
