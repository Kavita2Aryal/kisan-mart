<?php

namespace App\Services\Cms;

use App\Models\Cms\Slider;
use App\Models\Cms\SliderItem;

class SliderService
{
    public static function _find($uuid)
    {
        return Slider::with('items.image')->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return Slider::orderBy('name', 'ASC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Slider::orderBy('name', 'ASC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $slider = new Slider();
        $slider->name = $req->name;

        if ($slider->save()) {
            self::_item_storing($req->items, $slider->id);
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $slider = Slider::where('uuid', $uuid)->first();
        if (!$slider) return false;

        $slider->name = $req->name;

        if ($slider->update()) {
            self::_item_deleting($slider->id);
            self::_item_storing($req->items, $slider->id);
            return true;
        }
        return false;
    }

    public static function _deleting($uuid) 
    {
        $slider = Slider::where('uuid', $uuid)->first();
        if (!$slider) return false;

        self::_item_deleting($slider->id);
        return $slider->delete() ? true : false;
    }

    public static function _item_storing($items, $slider_id)
    {
        if ($items != null) { 
            $display_order = 0;
            foreach($items as $item) { 
                $display_order++;
                if ($item != null) {
                    if (isset($item['image_id']) && $item['image_id'] > 0) {
                        $batch[] = [
                            'slider_id'     => $slider_id,
                            'display_type'  => 1,
                            'display_order' => $display_order,
                            'is_active'     => isset($item['is_active']) ? 10 : 0,
                            'title'         => $item['title'],
                            'link'          => $item['link'],
                            'description'   => $item['description'],
                            'image_id'      => $item['image_id'],
                            'video_url'     => ''
                        ];
                    }
                    else if (isset($item['video_url']) && $item['video_url'] != '') {
                        $batch[] = [
                            'slider_id'     => $slider_id,
                            'display_type'  => 2,
                            'display_order' => $display_order,
                            'is_active'     => isset($item['is_active']) ? 10 : 0,
                            'title'         => $item['title'],
                            'link'          => $item['link'],
                            'description'   => $item['description'],
                            'image_id'      => 0,
                            'video_url'     => $item['video_url']
                        ];
                    }
                }
            }

            if (isset($batch) && !empty($batch)) {
                SliderItem::insert($batch);
            }
        }
    }

    public static function _item_deleting($slider_id) 
    {
        SliderItem::where('slider_id', $slider_id)->delete();
    }

    public static function _item_ordering($items)
    {
        $display_order = 0; 
        foreach ($items as $id) {
            if ($item = SliderItem::find($id)) {
                $display_order++;
                $item->display_order = $display_order;
                $item->update();
            }
        }
    }

    public static function _item_sort($uuid)
    {
        $slider = SliderItem::orderBy('display_order', 'ASC')
                    ->join('sliders', 'sliders.id', '=', 'slider_items.slider_id')
                    ->where('sliders.uuid', $uuid)
                    ->select('slider_items.*', 'sliders.uuid', 'sliders.name')->get();
        return $slider;
    }
}