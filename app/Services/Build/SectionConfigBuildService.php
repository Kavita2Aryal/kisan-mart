<?php

namespace App\Services\Build;

use Illuminate\Support\Facades\Storage;
use App\Models\Build\SectionConfigBuild;

class SectionConfigBuildService
{
    public static function _new_filename($image)
    {
        $original_name = preg_replace('/\..+$/', '', $image->getClientOriginalName());
        $original_name = preg_replace('/\s/', '_', $original_name);
        $rep_original  = str_replace( array( '\'', '"',',' , ';','-', '<', '>','_','$','$','%' ), '_', $original_name);
        $rep_original  = substr($rep_original, 0, 75); 
        return $rep_original.'-'.time().'.'.$image->getClientOriginalExtension();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $sections = SectionConfigBuild::with('user')->orderBy('display_order', 'DESC');
        if ($search) { 
            $sections->where('id', $search);
        }
        
        $paging = $sections->paginate($per_page);

        $data = $paging->getCollection()->transform(function($config) {
            return SectionConfigBuild::single_format($config);
        });

        return (object) [
            'data' => $data, 
            'paging' => $paging
        ];
    }
    
    public static function _find($uuid)
    {
        return SectionConfigBuild::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get_sections()
    {
        return SectionConfigBuild::with('user')->orderBy('display_order', 'DESC')->get()->map->format();
    }

    public static function _storing($configs)       
    {
        foreach ($configs as $key => $config) {
            $final = self::_prep_config($config);

            $section = new SectionConfigBuild();
            $section->filename      = $final['filename'];
            $section->styles        = $final['styles'];
            $section->scripts       = $final['scripts'];
            $section->config        = $final['config'];
            $section->list_config   = $final['list_config'];
            $section->type_config   = $final['type_config'];
            $section->display_order = self::_max_order();
            $section->is_active     = 10;
            $section->save();
        }
        return true;
    }

    public static function _updating($config, $uuid)
    {
        $config = array_values($config)[0];
        $final = self::_prep_config($config);

        $section = self::_find($uuid);
        $old_filename = $section->filename;

        $section->filename      = $final['filename'];
        $section->styles        = $final['styles'];
        $section->scripts       = $final['scripts'];
        $section->config        = $final['config'];
        $section->list_config   = $final['list_config'];
        $section->type_config   = $final['type_config'];
        $section->update();

        if ($old_filename != $final['filename']) {
            Storage::delete('public/cms/section/' . $old_filename);
        }
        return true;
    }

    public static function _deleting($uuid) 
    {
        $section = self::_find($uuid);

        Storage::delete('public/cms/section/' . $section->filename);
        return $section->delete() ? true : false;
    }

    public static function _max_order()
    {
    	$max_display_order = 1;
        if ($section = SectionConfigBuild::select('display_order')->orderBy('display_order','DESC')->first()) {
            $max_display_order = $section->display_order + 1;
        }
        return $max_display_order;
    }

    public static function _prep_config($config)
    {
        $final['filename'] = $config['filename'];

        $final['list_config'] = ($config['list'] == 1) 
                                ? json_encode($config['list_config']) 
                                : null;

        $final['type_config'] = ($config['type'] == 1 && isset($config['type_config'])) 
                                ? json_encode($config['type_config']) 
                                : null;

        $final['styles']  = ($config['style'] == 1 && isset($config['style_config'])) 
                            ? json_encode($config['style_config']) 
                            : null;

        $final['scripts'] = ($config['script'] == 1 && isset($config['script_config'])) 
                            ? json_encode($config['script_config']) 
                            : null;
                                    
        $final['config'] = json_encode([
            'title'         => $config['title'],
            'subtitle'      => $config['subtitle'],
            'description'   => $config['description'],
            'link'          => $config['link'],
            'image'         => $config['image'],
            'no_of_images'  => self::no_of_check($config['image'], $config['no_of_images']),
            'slider'        => $config['slider'],
            'no_of_sliders' => self::no_of_check($config['slider'], $config['no_of_sliders']),
            'video'         => $config['video'],
            'no_of_videos'  => self::no_of_check($config['video'], $config['no_of_videos']),
            'list'          => $config['list'],
            'type'          => $config['type'],
        ]);

        return $final;
    }

    public static function no_of_check($main, $no_of)
    {
        if ($main == 0) return (int) 0;

        if ($no_of > 0) return (int) $no_of;
        
        return (int) 1;
    }

    public static function _get_data()
	{
		return cache()->remember('section_config_cache', config('app.config.cache.24HR'), function () {
            $configs = SectionConfigBuild::with('user')->where('is_active', 10)->get()->map->format()->toArray();
            return array_column($configs, null, 'index');
        });
	}
}