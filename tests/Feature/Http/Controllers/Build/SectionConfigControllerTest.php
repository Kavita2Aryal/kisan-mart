<?php

namespace Tests\Feature\Http\Controllers\Build;

use App\Models\Build\SectionConfigBuild;
use App\Models\Cms\Page\Page;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SectionConfigControllerTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function section_config_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('section.config.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.build.section-config.create');
    }

    /** @test */
    public function section_config_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $website_scripts = array_keys(get_list_group('website_scripts'));
        $website_styles = array_keys(get_list_group('website_styles'));
        $type_config_groups = array_keys(get_list_group('type_contents'));
        $script_config = [];
        $style_config = [];
        $type_config = [];
        $list_config = [];
        for($i=1; $i<=2; $i++)
        {
            array_push($script_config, Arr::random($website_scripts));
            array_push($style_config, Arr::random($website_styles));
            array_push($type_config, Arr::random($type_config_groups));

            $list_config[$i] = [
                'head' => [
                    'title'         => Arr::random([0, 1]),
                    'subtitle'      => Arr::random([0, 1]),
                    'description'   => Arr::random([0, 1]),
                    'link'          => Arr::random([0, 1]),
                    'image'         => $image = Arr::random([0, 1]),
                    'no_of_images'  => ($image == 1) ? rand(1, 5) : 0,
                ],
                'body' => [
                    'icon'          => Arr::random([0, 1]),
                    'title'         => Arr::random([0, 1]),
                    'subtitle'      => Arr::random([0, 1]),
                    'description'   => Arr::random([0, 1]),
                    'link'          => Arr::random([0, 1]),
                    'image'         => $image = Arr::random([0, 1]),
                    'no_of_images'  => ($image == 1) ? rand(1, 5) : 0,
                ],
            ];
        }
        $filename = 'section_test'.rand(1,4).'.jpg';
        $config[0] = [
            'filename'      => $filename,
            'script'       => $script = Arr::random([0, 1]),
            'script_config'  => ($script == 1) ? $script_config : null,
            'style'        => $style = Arr::random([0, 1]),
            'style_config'  => ($style == 1) ? $style_config : null,
            'title'         => Arr::random([0, 1]),
            'subtitle'      => Arr::random([0, 1]),
            'description'   => Arr::random([0, 1]),
            'link'          => Arr::random([0, 1]),
            'image'         => $image = Arr::random([0, 1]),
            'no_of_images'  => ($image == 1) ? rand(1, 5) : 0,
            'slider'        => $slider = Arr::random([0, 1]),
            'no_of_sliders' => ($slider == 1) ? rand(1, 5) : 0,
            'video'         => $video = Arr::random([0, 1]),
            'no_of_videos'  => ($video == 1) ? rand(1, 5) : 0,
            'list'          => $list = Arr::random([0, 1]),
            'type'          => $type = Arr::random([0, 1]),
            'list_config'   => ($list == 1) ?  $list_config : null,
            'type_config'   => ($type == 1) ? $type_config : null
        ];
        // $response1 = $this->actingAs($user)->post(route('section.config.upload.image'), [
        //     'image' => UploadedFile::fake()->image($filename, 100, 100)->size(100)
        // ]);
        // Storage::disk('public/cms/section')->assertExists($response1->filename);
        $response = $this->actingAs($user)->post(route('section.config.store'), [
            'config'        => $config,
        ]);
        $response->assertRedirect(route('section.config.index'));
    }

    /** @test */
    public function section_config_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_section_config = SectionConfigBuild::orderBy('id', 'DESC')->first();
        $website_scripts = array_keys(get_list_group('website_scripts'));
        $website_styles = array_keys(get_list_group('website_styles'));
        $type_config_groups = array_keys(get_list_group('type_contents'));
        $script_config = [];
        $style_config = [];
        $type_config = [];
        $list_config = [];
        for($i=1; $i<=2; $i++)
        {
            array_push($script_config, Arr::random($website_scripts));
            array_push($style_config, Arr::random($website_styles));
            array_push($type_config, Arr::random($type_config_groups));

            $list_config[$i] = [
                'head' => [
                    'title'         => Arr::random([0, 1]),
                    'subtitle'      => Arr::random([0, 1]),
                    'description'   => Arr::random([0, 1]),
                    'link'          => Arr::random([0, 1]),
                    'image'         => $image = Arr::random([0, 1]),
                    'no_of_images'  => ($image == 1) ? rand(1, 5) : 0,
                ],
                'body' => [
                    'icon'          => Arr::random([0, 1]),
                    'title'         => Arr::random([0, 1]),
                    'subtitle'      => Arr::random([0, 1]),
                    'description'   => Arr::random([0, 1]),
                    'link'          => Arr::random([0, 1]),
                    'image'         => $image = Arr::random([0, 1]),
                    'no_of_images'  => ($image == 1) ? rand(1, 5) : 0,
                ],
            ];
        }
        $config[0] = [
            'filename'      => $db_section_config->filename,
            'script'       => $script = Arr::random([0, 1]),
            'script_config'  => ($script == 1) ? $script_config : null,
            'style'        => $style = Arr::random([0, 1]),
            'style_config'  => ($style == 1) ? $style_config : null,
            'title'         => Arr::random([0, 1]),
            'subtitle'      => Arr::random([0, 1]),
            'description'   => Arr::random([0, 1]),
            'link'          => Arr::random([0, 1]),
            'image'         => $image = Arr::random([0, 1]),
            'no_of_images'  => ($image == 1) ? rand(1, 5) : 0,
            'slider'        => $slider = Arr::random([0, 1]),
            'no_of_sliders' => ($slider == 1) ? rand(1, 5) : 0,
            'video'         => $video = Arr::random([0, 1]),
            'no_of_videos'  => ($video == 1) ? rand(1, 5) : 0,
            'list'          => $list = Arr::random([0, 1]),
            'type'          => $type = Arr::random([0, 1]),
            'list_config'   => ($list == 1) ?  $list_config : null,
            'type_config'   => ($type == 1) ? $type_config : null
        ];
        $response = $this->actingAs($user)->put(route('section.config.update', [$db_section_config->uuid]), [
            'config'        => $config,
        ]);
        $response->assertStatus(302);
    }
    /** @test */
    public function section_config_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_section_config = SectionConfigBuild::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('section.config.destroy', [$db_section_config->uuid]));
        $response->assertStatus(302);
    }
}
