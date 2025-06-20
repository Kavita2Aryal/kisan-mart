<?php

namespace Tests\Feature\Http\Controllers\Cms;

use App\Models\Cms\ImageX;
use App\Models\Cms\Page\Page;
use App\Models\Cms\Popup\Popup;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PopupControllerTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function popup_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('popup.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.cms.popup.create');
    }

    /** @test */
    public function popup_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $links = collect([
            'https://youtu.be/fzGBRDpf5GU',
            'https://youtu.be/u4ydvYH4L18',
            'https://youtu.be/OFqRej80iIY',
        ]);
        $pages = [];
        $db_pages = collect(Page::where('is_active', 10)->pluck('id'));
        $length = rand(1, 3);
        for($i=0; $i<=$length; $i++)
        {
            $pages[$i] = $db_pages->random();
        }
        $response = $this->actingAs($user)->post(route('popup.store'), [
            'title'         => $this->faker->unique()->name,
            'description'   => $this->faker->realText(rand(800, 1000)),
            'image_id'      => collect(ImageX::pluck('id'))->random(),
            'video_link'    => $links->random(),
            'external_link' => $links->random(),
            'is_active'     => 10,  
            'pages'         => $pages
        ]);
        $response->assertRedirect(route('popup.index'));
    }

    /** @test */
    public function popup_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $popup = Popup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('popup.edit', [$popup->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.cms.popup.edit');
    }

    /** @test */
    public function popup_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $popup = Popup::orderBy('id', 'DESC')->first();
        $title = $this->faker->unique()->name;
        $pages = [];
        $db_pages = collect(Page::where('is_active', 10)->pluck('id'));
        $length = rand(1, 3);
        for($i=0; $i<=$length; $i++)
        {
            $pages[$i] = $db_pages->random();
        }
        $response = $this->actingAs($user)->put(route('popup.update', [$popup->uuid]), [
            'title'         => $title,
            'description'   => $popup->description,
            'image_id'      => $popup->image_id,
            'video_link'    => $popup->video_link,
            'external_link' => $popup->external_link,
            'is_active'     => 10,  
            'pages'         => $pages
        ]);
        $response->assertRedirect(route('popup.index'));
        $this->assertDatabaseHas('popups', [
            'title' => $title,
        ]);
    }

    /** @test */
    public function popup_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $popup = Popup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('popup.change.status', [$popup->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function popup_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $popup = Popup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('popup.destroy', [$popup->uuid]));
        $response->assertStatus(302);
    }
}
