<?php

namespace App\Services\Build;

use App\Models\General\Setting;

use App\Models\Cms\Page\SectionDescription;
use App\Models\Cms\Page\ListContentBody;
use App\Models\Cms\Page\ListContentHead;
use App\Models\Cms\Page\ListLink;
use App\Models\Cms\SliderItem;
use App\Models\Cms\Popup\Popup;

use App\Models\Addons\Faq;
use App\Models\Addons\QuickLink;
use App\Models\Addons\Blog\BlogContent;
use App\Models\Ecommerce\Brand;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Collection\Collection;
use App\Models\Ecommerce\ComboProduct\ComboProduct;
use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Models\Ecommerce\Offer\Offer;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\PromoCode\PromoCode;

class DomainFixerService
{
    public static function change_for_addons($search, $replace) 
    {
        $faqs = Faq::where('answer', 'like', '%'.$search.'%')->get();
        if ($faqs->count()) {
            foreach ($faqs as $row) {
                $row->update([
                    'answer' => str_replace($search, $replace, $row->answer)
                ]);
            }
        }
        
        $quick_links = QuickLink::where('link', 'like', '%'.$search.'%')->get();
        if ($quick_links->count()) {
            foreach ($quick_links as $row) {
                $row->update([
                    'link' => str_replace($search, $replace, $row->link)
                ]);
            }
        }

        $blog_contents = BlogContent::where('description', 'like', '%'.$search.'%')->get();
        if ($blog_contents->count()) {
            foreach ($blog_contents as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }
    }

    public static function change_for_cms($search, $replace) 
    {
        $section_descriptions = SectionDescription::where('description', 'like', '%'.$search.'%')->get();
        if ($section_descriptions->count()) {
            foreach ($section_descriptions as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $list_content_bodies = ListContentBody::where('description', 'like', '%'.$search.'%')
                            ->orWhere('link', 'like', '%'.$search.'%')->get();
        if ($list_content_bodies->count()) {
            foreach ($list_content_bodies as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description),
                    'link'        => str_replace($search, $replace, $row->link)
                ]);
            }
        }

        $list_content_heads = ListContentHead::where('description', 'like', '%'.$search.'%')
                            ->orWhere('link', 'like', '%'.$search.'%')->get();
        if ($list_content_heads->count()) {
            foreach ($list_content_heads as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description),
                    'link'        => str_replace($search, $replace, $row->link)
                ]);
            }
        }

        $list_links = ListLink::where('value', 'like', '%'.$search.'%')->get();
        if ($list_links->count()) {
            foreach ($list_links as $row) {
                $row->update([
                    'value' => str_replace($search, $replace, $row->value)
                ]);
            }
        }

        $slider_items = SliderItem::where('link', 'like', '%'.$search.'%')->get();
        if ($slider_items->count()) {
            foreach ($slider_items as $row) {
                $row->update([
                    'link' => str_replace($search, $replace, $row->link)
                ]);
            }
        }

        $popups = Popup::where('description', 'like', '%'.$search.'%')
                    ->orWhere('external_link', 'like', '%'.$search.'%')->get();
        if ($popups->count()) {
            foreach ($popups as $row) {
                $row->update([
                    'description'   => str_replace($search, $replace, $row->description),
                    'external_link' => str_replace($search, $replace, $row->link)
                ]);
            }
        }
    }

    public static function change_for_general($search, $replace) 
    {
        $menus = Setting::whereIn('slug', ['desktop-menu-designs', 'mobile-menu-designs'])->get();
        if ($menus->count()) {
            foreach ($menus as $row) {
                $row->update([
                    'value' => str_replace($search, $replace, $row->value)
                ]);
            }
        }
    }

    public static function change_for_ecommerce($search, $replace) 
    {
        $brands = Brand::where('description', 'like', '%'.$search.'%')->get();
        if ($brands->count()) {
            foreach ($brands as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $category = Category::where('description', 'like', '%'.$search.'%')->get();
        if ($category->count()) {
            foreach ($category as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $collections = Collection::where('description', 'like', '%'.$search.'%')->get();
        if ($collections->count()) {
            foreach ($collections as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $offers = Offer::where('description', 'like', '%'.$search.'%')->get();
        if ($offers->count()) {
            foreach ($offers as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $products = Product::where('long_description', 'like', '%'.$search.'%')->get();
        if ($products->count()) {
            foreach ($products as $row) {
                $row->update([
                    'long_description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $products = Product::where('short_description', 'like', '%'.$search.'%')->get();
        if ($products->count()) {
            foreach ($products as $row) {
                $row->update([
                    'short_description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }

        $gift_vouchers = GiftVoucher::where('description', 'like', '%'.$search.'%')->get();
        if ($gift_vouchers->count()) {
            foreach ($gift_vouchers as $row) {
                $row->update([
                    'description' => str_replace($search, $replace, $row->description)
                ]);
            }
        }
    }
}