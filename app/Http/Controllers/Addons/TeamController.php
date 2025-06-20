<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\TeamService;
use App\Http\Requests\Addons\TeamRequest;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $teams = TeamService::_paging($request);
        $groups = get_list_group('team_groups');
        return view('modules.addons.team.index', compact('teams', 'groups'));
    }

    public function create()
    {
        $groups = get_list_group('team_groups');
        return view('modules.addons.team.create', compact('groups'));
    }

    public function store(TeamRequest $request)
    {
        if (TeamService::_storing($request)) {
            return redirect()->route('team.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create team at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $team = TeamService::_find($uuid);
        $groups = get_list_group('team_groups');
        return view('modules.addons.team.edit', compact('team', 'groups'));
    }

    public function update(TeamRequest $request, $uuid)
    {
        if (TeamService::_updating($request, $uuid)) {
            return redirect()->route('team.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update team at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (TeamService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the team at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = TeamService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function sort($group_id) 
    {
        $teams = TeamService::_get($group_id);
        return view('modules.addons.team.sort', compact('teams'));
    }

    public function manage_order(Request $request)
    {
        if (!$request->ajax()) abort(403);
        TeamService::_ordering($request->input('team'));
        return response()->json(true);
    }
}