<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Services\Cms\MediaService;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media_path = url('storage/media') . '/';
        $images = MediaService::_paging($request);
        return view('modules.cms.media.index', compact('media_path', 'images'));
    }

    public function upload()
    {
        return view('modules.cms.media.upload');
    }

    public function upload_image(Request $request)
    {
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize', '24M');
        ini_set('post_max_size', '32M');

        if (!$request->hasFile('image')) {
            return response()->json(['status' => 'failed'], 200);
        }

        $image = $request->file('image');
        $filename = MediaService::_new_filename($image);

        if ($image->storeAs('public/media', $filename)) {
            MediaService::_storing($filename, $image->getClientOriginalName());
            return response()->json(['status' => 'success', 'filename' => $filename], 200);
        }
        return response()->json(['status' => 'failed'], 200);
    }

    public function upload_image_modal(Request $request)
    {
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize', '24M');
        ini_set('post_max_size', '32M');

        if (!$request->hasFile('image')) {
            return response()->json(['status' => 'failed'], 200);
        }

        $image = $request->file('image');
        $filename = MediaService::_new_filename($image);

        if ($image->storeAs('public/media', $filename)) {
            $id = MediaService::_storing($filename, $image->getClientOriginalName());
            $type = $request->type;
            $html = view('modules.cms.media.use.media_unit', compact('filename', 'id', 'type'))->render();
            return response()->json(['status' => 'success', 'filename' => $filename, 'html' => $html], 200);
        }
        return response()->json(['status' => 'failed'], 200);
    }

    public function remove_image(Request $request)
    {
        if (!$request->filled('image') && !Storage::exists('public/media/' . $request->image)) {
            return response()->json(['status' => 'failed', 'issue' => ''], 200);
        }

        $check = MediaService::_check_if($request->image);
        if ($check['status'] == 'used') {
            return response()->json($check, 200);
        }

        if ($check['status'] == 'not_used' && $check['issue'] == '') {
            MediaService::_deleting($request->image);
        }

        Storage::delete('public/media/' . $request->image);
        return response()->json(['status' => 'success'], 200);
    }

    public function update_detail(Request $request)
    {
        return response()->json([
            'status' => MediaService::_updating($request) ? 'success' : 'failed'
        ], 200);
    }

    public function get_image(Request $request)
    {
        $images = MediaService::_paging($request);
        $type = $request->type;
        $view = ($request->full == 10) ? 'modal_use_media' : 'media_grid';

        return response()->json([
            'html' => view('modules.cms.media.use.'.$view, compact('images', 'type'))->render()
        ]);
    }

    public function crop_image(Request $request)
    {
        if (!$request->filled('image_data') || !$request->filled('image_name')) {
            abort(403);
        }

        $filename = MediaService::_cropping($request->image_name, $request->image_data);
        MediaService::_storing($filename);
        return response()->json(['status' => 'success'], 200);
    }
}
