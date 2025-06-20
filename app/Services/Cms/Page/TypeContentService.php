<?php

namespace App\Services\Cms\Page;

use App\Models\Cms\Page\TypeContent;
use App\Models\Addons\Faq;
use App\Models\Addons\Team;
use App\Models\Addons\Testimonial;
use App\Models\Addons\Partner;
use App\Models\Addons\Popup;
use App\Models\Addons\QuickLink;
use App\Models\Addons\SocialMedia;
use App\Models\Travel\Package\Package;
use App\Models\Travel\Specialist;

class TypeContentService
{
    public static function _updating($contents, $section_id)
    { 
        if ($contents != null) { 
            foreach ($contents as $type_config_id => $content) {
                foreach ($content as $item) {
                    if (isset($item['id'])) {
                        $batch[] = [
                            'item_id'           => $item['id'], 
                            'type_config_id'    => $type_config_id,
                            'section_id'        => $section_id,
                            'display_order'     => $item['order']
                        ];
                    }
                }
            }

            if (isset($batch) && !empty($batch)) {
                TypeContent::insert($batch);
            }
        }
    }

    public static function _deleting($section_id)
    {
        TypeContent::where('section_id', $section_id)->delete();
    }

    public static function _get_type_contents($section_id, $type_config_id, $type_id)
    {
        $selected = [];
        $temp = TypeContent::select(['item_id', 'display_order'])
                        ->where(['section_id' => $section_id, 'type_config_id' => $type_config_id])
                        ->orderBy('display_order', 'ASC')
                        ->get()
                        ->toArray();
               
        if ($temp != null) {
            $selected = array_column($temp, 'item_id');
            $selected_display_order = array_column($temp, 'display_order', 'item_id');
        }
        
        $type = get_list_group('type_contents')[$type_id];
        
        switch ($type) {
            case 'team':
                $data['title']      = 'Team';
                $data['type_id']    = $type_id;
                
                $data['selected'] = Team::select(['teams.id', 'teams.name as main', 'teams.description as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'teams.id')
                                                    ->whereIn('teams.id', $selected)
                                                    ->where(['teams.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = Team::select(['id', 'name as main', 'description as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('name', 'ASC')
                                                    ->get();
                break;

            case 'testimonial':
                $data['title']      = 'Testimonial';
                $data['type_id']    = $type_id;

                $data['selected'] = Testimonial::select(['testimonials.id', 'testimonials.name as main', 'testimonials.description as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'testimonials.id')
                                                    ->whereIn('testimonials.id', $selected)
                                                    ->where(['testimonials.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = Testimonial::select(['id', 'name as main', 'description as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('name', 'ASC')
                                                    ->get();
                break;

            case 'faq':
                $data['title']      = 'Faq';
                $data['type_id']    = $type_id;

                $data['selected'] = Faq::select(['faqs.id', 'faqs.question as main', 'faqs.answer as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'faqs.id')
                                                    ->whereIn('faqs.id', $selected)
                                                    ->where(['faqs.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = Faq::select(['id', 'question as main', 'answer as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('question', 'ASC')
                                                    ->get();
                break;

            case 'packages':
                $data['title']      = 'Packages';
                $data['type_id']    = $type_id;

                $data['selected'] = Package::select(['packages.id', 'packages.name as main', 'packages.description as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'packages.id')
                                                    ->whereIn('packages.id', $selected)
                                                    ->where(['packages.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = Package::select(['id', 'name as main', 'description as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('created_at', 'ASC')
                                                    ->get();
                break;
            
            case 'specialists':
                $data['title']      = 'Specialists';
                $data['type_id']    = $type_id;
                
                $data['selected'] = Specialist::select(['specialists.id', 'specialists.name as main', 'specialists.description as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'specialists.id')
                                                    ->whereIn('specialists.id', $selected)
                                                    ->where(['specialists.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = Specialist::select(['id', 'name as main', 'description as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('name', 'ASC')
                                                    ->get();
                break;

            case 'partners':
                $data['title']      = 'Partners';
                $data['type_id']    = $type_id;

                $data['selected'] = Partner::select(['partners.id', 'partners.name as main', 'partners.description as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'partners.id')
                                                    ->whereIn('partners.id', $selected)
                                                    ->where(['partners.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = Partner::select(['id', 'name as main', 'description as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();
                break;

            case 'quick_links':
                $data['title']      = 'Quick Links';
                $data['type_id']    = $type_id;

                $data['selected'] = QuickLink::select(['quick_links.id', 'quick_links.title as main', 'quick_links.link as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'quick_links.id')
                                                    ->whereIn('quick_links.id', $selected)
                                                    ->where(['quick_links.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = QuickLink::select(['id', 'title as main', 'link as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('question', 'ASC')
                                                    ->get();
                break;

            case 'social_medias':
                $data['title']      = 'Social Medias';
                $data['type_id']    = $type_id;

                $data['selected'] = SocialMedia::select(['social_medias.id', 'social_medias.social as main', 'social_medias.link as body', 'tc.display_order'])
                                                    ->leftjoin('type_contents as tc','tc.item_id', '=', 'social_medias.id')
                                                    ->whereIn('social_medias.id', $selected)
                                                    ->where(['social_medias.is_active'=> 10])
                                                    ->where(['tc.section_id'=> $section_id, 'tc.type_config_id' => $type_config_id])
                                                    ->orderBy('display_order', 'ASC')
                                                    ->get();

                $data['all']      = SocialMedia::select(['id', 'social as main', 'link as body'])
                                                    ->whereNotIn('id', $selected)
                                                    ->where(['is_active'=> 10])
                                                    ->orderBy('question', 'ASC')
                                                    ->get();
                break;

            default:
                $data = ['title' => null, 'selected' => null, 'all' => null, 'type_id' => $type_id];
                break;
        }

        return $data;
    }
}
