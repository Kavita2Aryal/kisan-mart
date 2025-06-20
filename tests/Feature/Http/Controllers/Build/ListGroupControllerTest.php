<?php

namespace Tests\Feature\Http\Controllers\Build;

use App\Models\Build\ListGroup;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ListGroupControllerTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function list_group_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('list.group.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.build.list-group.create');
    }

    /** @test */
    public function list_group_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $items = [];
        $list_type = collect(array_keys(config('app.config.list_group_types')))->random();
        if($list_type == "title_value"){
            for($i=0; $i<=2; $i++)
            {
                $items[$i] = [
                    'title' => $i,
                    'value' => $this->faker->word
                ];
            }
        }else{
            for($i=0; $i<=2; $i++)
            {
                $items[$i] = [
                    'value' => $this->faker->word
                ];
            }
        }
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->post(route('list.group.store'), [
            'name'          => $name,
            'slug'          => Str::slug($name, '-'),
            'list_type'     => $list_type,
            'items'         => $items
        ]);
        $response->assertRedirect(route('list.group.index'));
    }

    /** @test */
    public function list_group_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $list_group = ListGroup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('list.group.edit', [$list_group->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.build.list-group.edit');
    }

    /** @test */
    public function list_group_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $list_group = ListGroup::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        if($list_group->list_type == "title_value"){
            for($i=0; $i<=2; $i++)
            {
                $items[$i] = [
                    'title' => $i,
                    'value' => $this->faker->word
                ];
            }
        }else{
            for($i=0; $i<=2; $i++)
            {
                $items[$i] = [
                    'value' => $this->faker->word
                ];
            }
        }
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('list.group.update', [$list_group->uuid]), [
            'name'          => $name,
            'slug'          => Str::slug($name, '-'),
            'list_type'     => $list_group->list_type,
            'items'         => $items
        ]);
        $response->assertRedirect(route('list.group.index'));
        $this->assertDatabaseHas('list_groups', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function list_group_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $list_group = ListGroup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('list.group.destroy', [$list_group->uuid]));
        $response->assertStatus(302);
    }
}
