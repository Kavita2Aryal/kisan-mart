<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\Page;
use App\Services\Cms\WebAliasService;
use App\Services\Cms\Page\PageSeoService;
use App\Services\Cms\Page\SectionConfigService;
use App\Services\Cms\Page\SectionContentService;

class PageService
{
    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Page::with(['user', 'alias'])->orderBy('name', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $page            = new Page();
        $page->name      = $req->name;
        $page->header_id = $req->has('header') ? $req->header : 0;
        $page->footer_id = $req->has('footer') ? $req->footer : 0;
        $page->is_active = $req->has('is_active') ? 10 : 0;
        $page->is_home   = 0;

        if ($page->save()) {
            SectionConfigService::_storing($req, $page);
            PageSeoService::_storing($req->seo, $page->id);
            WebAliasService::_storing('page_id', $page->id, $req->alias);
            return $page->uuid;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        if ($page = Page::where('uuid', $uuid)->first()) {
            $page->name      = $req->name;
            $page->is_active = $req->has('is_active') ? 10 : 0;

            if ($page->update()) {
                PageSeoService::_updating($req->seo, $page->id);
                WebAliasService::_updating('page_id', $page->id, $req->alias);
                return $uuid;
            }
        }
        return false;
    }

    public static function _layout_updating($req, $uuid)
    {
        if ($page = Page::where('uuid', $uuid)->first()) {
            $page->header_id = $req->has('header') ? $req->header : 0;
            $page->footer_id = $req->has('footer') ? $req->footer : 0;

            if ($page->update()) {
                SectionConfigService::_updating($req, $page);
                return $uuid;
            }
        }
        return false;
    }

    public static function _deleting($uuid) 
    {
        $page = Page::where('uuid', $uuid)->first();
        if (!$page) return false;
        
        PageSeoService::_deleting($page->id);
        WebAliasService::_deleting('page_id', $page->id);
        SectionContentService::_all_deleting($page->section_contents);
        return $page->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $page = Page::where('uuid', $uuid)->first();
        if (!$page) return -1;

        $page->is_active = ($page->is_active == 10 ? 0 : 10);
        $page->update();
        return $page->is_active;
    }

    public static function _change_home($uuid)
    {
        $page = Page::where('uuid', $uuid)->first();
        if (!$page) return false;

        $home = Page::where('is_home', 10)->first();
        if ($home) {
            $home->is_home = 0;
            $home->update();
        }

        $page->is_home = 10;
        $page->is_active = 10;
        $page->update();
        return true;
    }
}