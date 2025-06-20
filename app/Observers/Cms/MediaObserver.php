<?php

namespace App\Observers\Cms;

use App\Models\Cms\ImageX;
use App\Services\General\LogService;
use Illuminate\Support\Str;

class MediaObserver
{
    public function creating(ImageX $image)
    {
        $image->user_id = auth()->user()->id;
        $image->uuid    = Str::uuid()->toString();
    }

    public function created(ImageX $image)
    {
        cache()->flush();
        LogService::queue('image', $image->image . ' - uploaded');
    }

    public function deleted(ImageX $image)
    {
        cache()->flush();
        LogService::queue('image', $image->image . ' - deleted');
    }
}
