<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\TypeConfig;

class TypeConfigService
{
    public static function _updating($types, $config_id)
    { 
        if ($types != null) { 
            foreach ($types as $type) {
                if ($type != null) {
                    $batch[] = [
                        'config_id' => $config_id, 
                        'type_id'   => $type
                    ];
                }
            }

            if (isset($batch) && !empty($batch)) {
                TypeConfig::insert($batch);
            }
        }
    }

    public static function _deleting($config_id)
    {
        TypeConfig::where('config_id', $config_id)->delete();
    }
}
