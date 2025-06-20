<?php

namespace App\Http\Requests\Addons;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'description'   => 'required',
            'published_at'  => 'required|date',
            'image_id'      => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'published_at'  => 'Publish Date',
            'image_id'      => 'Image',
        ];
    }
}
