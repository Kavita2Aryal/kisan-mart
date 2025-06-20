<?php

use App\Models\Cms\WebAlias;

if (!function_exists('check_web_page_type')) {

    function check_web_page_type($with_web = false)
    {
        $uri = app('request')->path();
        $web = WebAlias::where('alias', $uri)->first();
        $response = get_web_page_type($web);
        $response = array_merge($response, ['uri' => $uri, 'web' => ($with_web) ? $web : '']);
        return $response;
    }
}

if (!function_exists('check_web_alias_type')) {

    function check_web_alias_type($type)
    {
        $web_alias_types = get_alias_table_relation();
        return isset($web_alias_types[$type]) ? $web_alias_types[$type] : null;
    }
}

if (!function_exists('get_web_alias_by_slug')) {

    function get_web_alias_by_slug($type, $slug)
    {
        if ($web_alias_type = check_web_alias_type($type)) {
            $data = DB::table('web_alias')
                ->join($web_alias_type['table'], $web_alias_type['table'] . '.id', '=', 'web_alias.' . $web_alias_type['relation'])
                ->select('web_alias.alias')
                ->where($web_alias_type['table'] . '.slug', $slug)
                ->first();
            return $data != null ? $data->alias : '';
        }
        return '';
    }
}

if (!function_exists('get_web_alias_by_id')) {

    function get_web_alias_by_id($type, $id)
    {
        if ($web_alias_type = check_web_alias_type($type)) {
            $data = DB::table('web_alias')
                ->join($web_alias_type['table'], $web_alias_type['table'] . '.id', '=', 'web_alias.' . $web_alias_type['relation'])
                ->select('web_alias.alias')
                ->where($web_alias_type['table'] . '.id', $id)
                ->first();
            return $data != null ? $data->alias : '';
        }
        return '';
    }
}