<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\SocialMedia;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SocialMediaControllerTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function social_media_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('social.media.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.social_media.create');
    }

    /** @test */
    public function social_media_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $group = get_list_group('social_media');
        $key = array_keys($group);
        $links = collect([
            'https://youtu.be/fzGBRDpf5GU',
            'https://youtu.be/u4ydvYH4L18',
            'https://youtu.be/OFqRej80iIY',
        ]);
        $response = $this->actingAs($user)->post(route('social.media.store'), [
            'social'            => $group[Arr::random($key)],
            'link'              => $links->random(),
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('social.media.index'));
    }

    /** @test */
    public function social_media_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $social_media = SocialMedia::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('social.media.edit', [$social_media->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.social_media.edit');
    }

    /** @test */
    public function social_media_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $social_media = SocialMedia::orderBy('id', 'DESC')->first();
        $links = collect([
            'https://youtu.be/fzGBRDpf5GU',
            'https://youtu.be/u4ydvYH4L18',
            'https://youtu.be/OFqRej80iIY',
        ]);
        $link = $links->random();
        $response = $this->actingAs($user)->put(route('social.media.update', [$social_media->uuid]), [
            'social'            => $social_media->social,
            'link'              => $link,
            'is_active'         => $social_media->is_active
        ]);
        $response->assertRedirect(route('social.media.index'));
        $this->assertDatabaseHas('social_medias', [
            'link' => $link,
        ]);
    }

    /** @test */
    public function social_media_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $social_media = SocialMedia::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('social.media.change.status', [$social_media->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function social_media_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $social_media = SocialMedia::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('social.media.destroy', [$social_media->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function social_media_sort()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('social.media.sort'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.social_media.sort');
    }

    /** @test */
    public function social_media_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_social_medias = SocialMedia::pluck('id')->toArray();
        $count = count($db_social_medias);
        for($i=0; $i<$count; $i++)
        {
            $social_media[$i] = $value = Arr::random($db_social_medias);
            unset($db_social_medias[array_search($value, $db_social_medias)]);
        }
        $response = $this->actingAs($user)->post(route('social.media.manage.order'), [
            'social-media' => $social_media
        ]);
        $response->assertStatus(200);
    }
}
