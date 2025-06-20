<?php

namespace App\Http\Requests\Addons;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'                     => 'required|max:255|unique:blogs,title,'.$this->uuid.',uuid',
            'alias'                     => 'required|max:255|unique:web_alias,alias,'.$this->alias_id,
            'published_at'              => 'required',
            'category_id'               => 'required',
            'intro_image_id'            => 'required',
            'seo.meta_title'            => 'required|max:255',
            'seo.meta_description'      => 'required',
            'seo.meta_keywords'         => 'required',
        ];
    }
    
    public function attributes()
    {
        return [
            'published_at'              => 'Publish Date',
            'category_id'               => 'Category',
            'intro_image_id'            => 'Intro Image',
            'banner_image_id'           => 'Banner Image',
            'seo.meta_title'            => 'Meta Title',
            'seo.meta_description'      => 'Meta Description',
            'seo.meta_keywords'         => 'Meta Keywords',
            'seo.meta_image_id'         => 'Meta Image',
            'contents.*.description'    => 'Description'
        ];
    }
}
