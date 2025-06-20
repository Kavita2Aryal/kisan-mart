<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Services\Ecommerce\ImageUploadService;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'  => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif,svg,webp|max:2000'
        ]);
        $filename = ImageUploadService::_upload($request->file('image'), $request->type);
        if ($filename) {
            return response()->json(['status' => 'success', 'filename' => $filename], 200);
        }
        return response()->json(['status' => 'failed'], 200);
    }

    public function remove(Request $request)
    {
        if ($request->has('image') && $request->has('type')) {
            ImageUploadService::_remove($request->image, $request->type);
            return response()->json(['status' => 'success'], 200);
        }
        return response()->json(['status' => 'failed'], 200);
    } 
}