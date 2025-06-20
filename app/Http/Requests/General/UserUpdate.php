<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            'email'         => 'required|max:255|unique:users,email,'.$this->uuid.',uuid',
            'name'          => 'required|max:255',
            'password'      => 'confirmed',
            'role_id'       => 'sometimes|required',
            'permissions.*' => 'sometimes|required'
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'Access Role',
        ];
    }
}
