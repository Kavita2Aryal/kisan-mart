<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\QuickLink;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class QuickLinkControllerTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function quick_link_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('quick.link.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.quick_link.create');
    }

    /** @test */
    public function quick_link_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $group = array_keys(get_list_group('quick_link_groups'));
        $links = collect([
            'https://youtu.be/fzGBRDpf5GU',
            'https://youtu.be/u4ydvYH4L18',
            'https://youtu.be/OFqRej80iIY',
        ]);
        $response = $this->actingAs($user)->post(route('quick.link.store'), [
            'group_id'          => Arr::random($group),
            'title'             => $this->faker->unique()->word,
            'link'              => $links->random(),
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('quick.link.index'));
    }

    /** @test */
    public function quick_link_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $quick_link = QuickLink::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('quick.link.edit', [$quick_link->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.quick_link.edit');
    }

    /** @test */
    public function quick_link_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $quick_link = QuickLink::orderBy('id', 'DESC')->first();
        $title = $this->faker->unique()->word;
        $response = $this->actingAs($user)->put(route('quick.link.update', [$quick_link->uuid]), [
            'group_id'          => $quick_link->group_id,
            'title'             => $title,
            'link'              => $quick_link->link,
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('quick.link.index'));
        $this->assertDatabaseHas('quick_links', [
            'title' => $title,
        ]);
    }

    /** @test */
    public function quick_link_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $quick_link = QuickLink::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('quick.link.change.status', [$quick_link->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function quick_link_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $quick_link = QuickLink::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('quick.link.destroy', [$quick_link->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function quick_link_sort()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $quick_link = QuickLink::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('quick.link.sort', [$quick_link->group_id]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.quick_link.sort');
    }

    /** @test */
    public function quick_link_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $group = array_keys(get_list_group('quick_link_groups'));
        $db_quick_links = QuickLink::where('group_id', Arr::random($group))->pluck('id')->toArray();
        $count = count($db_quick_links);
        for($i=0; $i<$count; $i++)
        {
            $quick_link[$i] = $value = Arr::random($db_quick_links);
            unset($db_quick_links[array_search($value, $db_quick_links)]);
        }
        $response = $this->actingAs($user)->post(route('quick.link.manage.order'), [
            'quick-link' => $quick_link
        ]);
        $response->assertStatus(200);
    }
}
