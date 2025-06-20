<?php

namespace App\Services\Cms\Popup;

use App\Models\Cms\Popup\PopupPage;

class PopupPageService
{
    public static function _storing($data, $id)
    {
        if ($data != null) {
            foreach($data as $page) {
                $batch[] = [
                    'popup_id' => $id,
                    'page_id'  => $page   
                ];
                
            }
            if (isset($batch) && !empty($batch)) {
                PopupPage::insert($batch);
            }
        }
    }

    public static function _deleting($id)
    {
        PopupPage::where('popup_id', $id)->delete();
    }
}