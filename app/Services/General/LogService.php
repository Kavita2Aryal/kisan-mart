<?php

namespace App\Services\General;

use Illuminate\Support\Facades\Storage;
use App\Jobs\LogJob;

class LogService
{
    protected static $path = 'logs/';

    public static function queue($type, $content)
    {
        $log = [
            'datetime'  => now()->format('Y-m-d H:i:s'),
            'type'      => $type,
            'content'   => $content,
            'user'      => auth()->user()->id ?? 0
        ];

        LogJob::dispatch($log)->delay(now()->addMinutes(10));
    }

    public static function create($log)
    {
        $filename = now()->format('Y-m') . '.log';
        $log = join('||', $log);
        
        if (!Storage::exists(self::$path . $filename)) {
            Storage::put(self::$path . $filename, $log);
        }
        else {
            Storage::append(self::$path . $filename, $log);
        }
    }

    public static function extract($filename)
    {
        if (!Storage::exists(self::$path . $filename)) {
            return null;
        }
        return Storage::get(self::$path . $filename);
    }

    public static function get($filename)
    {
        $logs = self::extract($filename);
        
        if ($logs == null) {
            return null;
        }

        $logs = array_map(
            function ($substr) {
                return explode('||', $substr);
            }, 
            preg_split("/\r\n|\n|\r/", $logs)
        );

        krsort($logs);
        return $logs; 
    }

    public static function all_files()
    {
        return Storage::files(self::$path);
    }
}