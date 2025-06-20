<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'name'          => 'required|max:255',
            'email'         => 'required|max:255|unique:users,email',
            'password'      => 'required|confirmed|min:6',
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
