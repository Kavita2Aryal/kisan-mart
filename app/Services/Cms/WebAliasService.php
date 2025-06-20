<?php

namespace App\Services\Cms;

use App\Models\Cms\WebAlias;
use DB;


use App\Models\Cms\Page\Page;

class WebAliasService
{
    public static function _storing($field, $id, $alias)
    {
        $web_alias = new WebAlias;
        $web_alias->$field = $id;
        $web_alias->alias = trim($alias);
        $web_alias->save();
    }

    public static function _updating($field, $id, $alias)
    {
        WebAlias::where($field, $id)->update( ['alias' => trim($alias)] );
    }

    public static function _deleting($field, $id)
    {
        WebAlias::where($field, $id)->delete();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);
        
        $data = WebAlias::select('web_alias.*')->with(['page', 'blog', 'event', 'news', 'package']);
        if ($search) { 
            $data->where( function ($query) use ($search) {
                $query->whereHas('page', function ($query1) use ($search) {
                        $query1->where('name', 'LIKE', '%'.$search.'%');
                    })
                    ->orWhereHas('blog', function ($query2) use ($search) {
                        $query2->where('title', 'LIKE', '%'.$search.'%');
                    })
                    ->orWhereHas('event', function ($query3) use ($search) {
                        $query3->where('title', 'LIKE', '%'.$search.'%');
                    })
                    ->orWhereHas('news', function ($query4) use ($search) {
                        $query4->where('title', 'LIKE', '%'.$search.'%');
                    })
                    ->orWhereHas('package', function ($query5) use ($search) {
                        $query5->where('name', 'LIKE', '%'.$search.'%');
                    });
            });
        }
        return $data->paginate($per_page);
    }

    public static function _checking($req)
    {
        $url = filter_var($req->alias, FILTER_SANITIZE_URL);
        if (!filter_var(url($url), FILTER_VALIDATE_URL)) {
            return [
                'status' => 'failed',
                'msg' => 'Please enter a valid unique web alias. Please dont include special characters in the web alias.'
            ];
        }

        $check = ['error' => 'none'];
        $config = config('app.addons_config.default_pages');
        foreach ($config as $conf) {
            if (strcmp($req->alias, $conf['alias']) === 0 || strcmp($req->alias, $conf['alias'] . '/') === 0) {
                $check = ['error' => 'default_pages']; break;
            }
        }

        if ($check['error'] == 'default_pages') {
            return [
                'status' => 'failed',
                'msg' => 'Web alias already exist in the system. Please enter unique web alias.'
            ];
        }

        return [ 'status' => 'success' ];
    }

    public static function _change_status($req)
    {
        if ($req->filled('type') && $req->filled('parent_id')) {
            if ($req->type == 'page') {
                $page = DB::table('pages')->where('id', $req->parent_id);
                if ($temp = $page->first()) {
                    $value = ($temp->is_active == 10 ? 0 : 10);
                    $page->update([ 'is_active' => $value ]);
                    return $value;
                }
            }
        }
        return -1;
    }

    public static function hyperlink_search($req, $uuid)
    {
        $search = "%".filter_var($req->q, FILTER_SANITIZE_STRING)."%";
        return Page::with('alias')
                ->orderBy('name', 'ASC')
                ->where('is_active', 10)
                ->where('uuid', '!=', $uuid)
                ->where('name', 'LIKE', $search)
                ->get()->map->hyperlink_search_format();
    }
}