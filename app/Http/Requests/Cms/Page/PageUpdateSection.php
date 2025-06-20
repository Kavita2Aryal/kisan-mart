<?php

namespace App\Http\Requests\Cms\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateSection extends FormRequest
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
            'section.*.title'                 => 'sometimes|required|max:255',
            'section.*.subtitle'              => 'sometimes|required',
            'section.*.description.*'         => 'sometimes|required',
            'section.*.slider.*'              => 'sometimes|required',
            'section.*.video.*.title'         => 'sometimes|required|max:255',
            'section.*.video.*.value'         => 'sometimes|required|url|max:255',
            'section.*.link.*.title'          => 'sometimes|required|max:255',
            'section.*.link.*.link'           => 'sometimes|required|url|max:255',
            'section.*.list.*.head.title'            => 'sometimes|required|max:255',
            'section.*.list.*.head.subtitle'         => 'sometimes|required',
            'section.*.list.*.head.description'      => 'sometimes|required',
            'section.*.list.*.head.link'             => 'sometimes|required|url|max:255',
            'section.*.list.*.body.*.title'          => 'sometimes|required|max:255',
            'section.*.list.*.body.*.subtitle'       => 'sometimes|required',
            'section.*.list.*.body.*.description'    => 'sometimes|required',
            'section.*.list.*.body.*.link'           => 'sometimes|required|url|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'section.*.title'                 => 'Title',
            'section.*.subtitle'              => 'Subtitle',
            'section.*.description.*'         => 'Description',
            'section.*.slider.*'              => 'Slider',
            'section.*.video.*.title'         => 'Video Title',
            'section.*.video.*.value'         => 'Video URL',
            'section.*.link.*.title'          => 'Link Title',
            'section.*.link.*.link'           => 'Link URL',
            'section.*.list.*.head.title'            => 'List Head Title',
            'section.*.list.*.head.subtitle'         => 'List Head Subtitle',
            'section.*.list.*.head.description'      => 'List Head Description',
            'section.*.list.*.head.link'             => 'List Head Link',
            'section.*.list.*.body.*.title'          => 'List Body Title',
            'section.*.list.*.body.*.subtitle'       => 'List Body Subtitle',
            'section.*.list.*.body.*.description'    => 'List Body Description',
            'section.*.list.*.body.*.link'           => 'List Body Link',
        ];
    }
}