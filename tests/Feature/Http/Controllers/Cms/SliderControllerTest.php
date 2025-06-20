<?php

namespace Tests\Feature\Http\Controllers\Cms;

use App\Models\Cms\Slider;
use App\Models\Cms\SliderItem;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class SliderControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function slider_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('slider.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.cms.slider.create');
    }

    /** @test */
    public function slider_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $items = [
            '0' => [
                'is_active'     => 10,
                'title'         => 'Slider Item Title1',
                'link'          => 'https://slider-test.com',
                'description'   => 'This slider description is just for testing',
                'image_id'      => rand(0, 9),
                'video_url'     => ''
            ],
            '1' => [
                'is_active'     => 10,
                'title'         => 'Slider Item Title2',
                'link'          => 'https://slider-test.com',
                'description'   => 'This slider description is just for testing',
                'image_id'      => '',
                'video_url'     => 'https://video-url-test.com'
            ]
        ];
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->post(route('slider.store'), [
            'name' => $name,
            'user_id' => $user->id,
            'items' => $items
        ]);
        $response->assertRedirect(route('slider.index'));
    }

    /** @test */
    public function slider_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $slider = Slider::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('slider.edit', [$slider->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.cms.slider.edit');
    }

    /** @test */
    public function slider_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $slider = Slider::orderBy('id', 'DESC')->first();
        $items = [
            '0' => [
                'is_active'     => 10,
                'title'         => 'Slider Item Title1 Update',
                'link'          => 'https://slider-test.com',
                'description'   => 'This slider description is just for testing',
                'image_id'      => rand(0, 9),
                'video_url'     => ''
            ],
            '1' => [
                'is_active'     => 10,
                'title'         => 'Slider Item Title2',
                'link'          => 'https://slider-test.com',
                'description'   => 'This slider description is just for testing',
                'image_id'      => '',
                'video_url'     => 'https://video-url-test.com'
            ]
        ];
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('slider.update', [$slider->uuid]), [
            'name' => $name,
            'items' => $items
        ]);
        $response->assertRedirect(route('slider.index'));
        $this->assertDatabaseHas('sliders', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function slider_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $slider = Slider::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('slider.destroy', [$slider->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function slider_sort()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $slider = Slider::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('slider.sort', [$slider->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.cms.slider.sort');
    }

    /** @test */
    public function slider_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_slider = Slider::orderBy('id', 'DESC')->first();
        $db_slider_items = SliderItem::where('slider_id', $db_slider->id)->pluck('id')->toArray();
        $count = count($db_slider_items);
        for($i=0; $i<$count; $i++)
        {
            $item[$i] = $value = Arr::random($db_slider_items);
            unset($db_slider_items[array_search($value, $db_slider_items)]);
        }
        $response = $this->actingAs($user)->post(route('slider.manage.order'), [
            'items' => $item
        ]);
        $response->assertStatus(200);
    }
}
