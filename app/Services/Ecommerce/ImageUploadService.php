<?php

namespace App\Services\Ecommerce;

use Illuminate\Support\Facades\Storage;
use Image;
use File;

class ImageUploadService
{
    public static function _upload($image, $type)
    {
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '24M');
        ini_set('post_max_size', '32M');

        $original_name = preg_replace('/\..+$/', '', $image->getClientOriginalName());
        $original_name = preg_replace('/\s/', '_', $original_name);
        $rep_original = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '$', '%'), '_', $original_name);
        $filename = $rep_original . '-' . time() . '.' . $image->getClientOriginalExtension();
        if ($image->storeAs('public/'.$type.'/' , $filename)) {
            return $filename;
        }
        return false;
    }

    public static function _remove($filename, $type)
    {
        if (Storage::exists('public/'.$type.'/' . $filename)) {
            Storage::delete('public/'.$type.'/' . $filename);
            return true;
        }
        return false;
    }
}