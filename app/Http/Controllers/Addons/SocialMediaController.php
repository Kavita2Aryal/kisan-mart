<?php

namespace App\Http\Controllers\Addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Addons\SocialMediaService;
use App\Http\Requests\Addons\SocialMediaRequest;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {
        $social_medias = SocialMediaService::_paging($request);
        return view('modules.addons.social_media.index', compact('social_medias'));
    }

    public function create()
    {
        $socials = get_list_group('social_media');
        return view('modules.addons.social_media.create', compact('socials'));
    }

    public function store(SocialMediaRequest $request)
    {
        if (SocialMediaService::_storing($request)) {
            return redirect()->route('social.media.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not create social media at this time. Please try again later.');
    }

    public function edit($uuid)
    {
        $social_media = SocialMediaService::_find($uuid);
        $socials = get_list_group('social_media');
        return view('modules.addons.social_media.edit', compact('social_media', 'socials'));
    }

    public function update(SocialMediaRequest $request, $uuid)
    {
        if (SocialMediaService::_updating($request, $uuid)) {
            return redirect()->route('social.media.index');
        }
        return back()->withInput()
            ->with('error', 'Sorry, could not update social media at this time. Please try again later.');
    }

    public function destroy($uuid)
    {
        if (SocialMediaService::_deleting($uuid)) {
            return back();
        }
        return back()
            ->with('error', 'Sorry, could not delete the social media at this time. Please try again later.');
    }

    public function change_status($uuid) 
    {
        $response = SocialMediaService::_change_status($uuid);
        return response()->json($response, 200);
    }

    public function sort() 
    {
        $social_medias = SocialMediaService::_get();
        return view('modules.addons.social_media.sort', compact('social_medias'));
    }

    public function manage_order(Request $request)
    {
        // if (!$request->ajax()) abort(403);
        SocialMediaService::_ordering($request->input('social-media'));
        return response()->json(true);
    }
}