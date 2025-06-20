<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Team;
use App\Models\Cms\ImageX;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TeamControllerTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function team_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('team.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.team.create');
    }

    /** @test */
    public function team_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $group = array_keys(get_list_group('team_groups'));
        $response = $this->actingAs($user)->post(route('team.store'), [
            'group_id'          => Arr::random($group),
            'name'              => $this->faker->unique()->name,
            'description'       => $this->faker->realText(rand(800, 2000)),
            'image_id'          => collect(ImageX::pluck('id'))->random(),
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('team.index'));
    }

    /** @test */
    public function team_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $team = Team::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('team.edit', [$team->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.team.edit');
    }

    /** @test */
    public function team_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $team = Team::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('team.update', [$team->uuid]), [
            'group_id'          => $team->group_id,
            'name'              => $name,
            'description'       => $team->description,
            'image_id'          => $team->image_id,
            'is_active'         => $team->is_active
        ]);
        $response->assertRedirect(route('team.index'));
        $this->assertDatabaseHas('teams', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function team_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $team = Team::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('team.change.status', [$team->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function team_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $team = Team::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('team.destroy', [$team->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function team_sort()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $team = Team::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('team.sort', [$team->group_id]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.team.sort');
    }

    /** @test */
    public function team_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $group = array_keys(get_list_group('team_groups'));
        $db_teams = Team::where('group_id', Arr::random($group))->pluck('id')->toArray();
        $count = count($db_teams);
        for($i=0; $i<$count; $i++)
        {
            $team[$i] = $value = Arr::random($db_teams);
            unset($db_teams[array_search($value, $db_teams)]);
        }
        $response = $this->actingAs($user)->post(route('team.manage.order'), [
            'team' => $team
        ]);
        $response->assertStatus(200);
    }
}
