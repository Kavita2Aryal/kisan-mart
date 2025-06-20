<?php

namespace App\Services\Addons;

use App\Models\Addons\Team;

class TeamService
{
    public static function _find($uuid)
    {
        return Team::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get($group_id = null)
    {
        return ($group_id != null)
            ? Team::where('group_id', $group_id)->orderBy('display_order', 'ASC')->get()
            : Team::with(['user', 'image'])->orderBy('group_id', 'ASC')->orderBy('display_order', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Team::with(['user', 'image'])->orderBy('group_id', 'ASC')->orderBy('display_order', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $team = new Team();
        $team->group_id 	 = $req->group_id;
        $team->name 		 = $req->name;
        $team->description   = trim_description($req->description);
        $team->display_order = self::_max_order($req->group_id);
        $team->image_id      = $req->image_id ?? 0;
        $team->is_active 	 = $req->has('is_active') ? 10 : 0;
        return $team->save() ? true : false;
    }

    public static function _updating($req, $uuid)
    {
        $team = self::_find($uuid);
        if (!$team) return false;

        $team->group_id    = $req->group_id;
        $team->name 	   = $req->name;
        $team->description = trim_description($req->description);
        $team->image_id    = $req->image_id ?? 0;
        $team->is_active   = $req->has('is_active') ? 10 : 0;
        return $team->update() ? true : false;
    }

    public static function _deleting($uuid) 
    {
        $team = self::_find($uuid);
        if (!$team) return false;

        return $team->delete() ? true : false;
    }

    public static function _change_status($uuid)
    {
        $team = self::_find($uuid);
        if (!$team) return -1;

        $team->is_active = ($team->is_active == 10 ? 0 : 10);
        $team->update();
        return $team->is_active;
    }

    public static function _ordering($teams)
    {
        $display_order = 0; 
        foreach ($teams as $id) {
            if ($team = Team::find($id)) {
                $display_order++;
                $team->display_order = $display_order;
                $team->update();
            }
        }
    }

    public static function _max_order($group_id)
    {
    	$max_display_order = 1;
        if ($team = Team::select('display_order')->where('group_id', $group_id)->orderBy('display_order','DESC')->first()) {
            $max_display_order = $team->display_order + 1;
        }
        return $max_display_order;
    }
}