<?php

namespace App\Http\Requests\Addons;

use Illuminate\Foundation\Http\FormRequest;

class QuickLinkRequest extends FormRequest
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
            'title'     => 'required|max:255',
            'link'      => 'required|max:255|url',
            'group_id'  => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'group_id' => 'Group',
        ];
    }
}
