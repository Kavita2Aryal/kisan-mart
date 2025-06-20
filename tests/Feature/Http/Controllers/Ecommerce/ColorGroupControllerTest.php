<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\ColorGroup;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ColorGroupControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function color_group_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('color.group.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.color-group.create');
    }

    /** @test */
    public function color_group_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $name = $this->faker->unique()->word;
        $response = $this->actingAs($user)->post(route('color.group.store'), [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'value' => $this->faker->unique()->word,
            'is_active' => 10
        ]);
        $response->assertRedirect(route('color.group.index'));
    }

    /** @test */
    public function color_group_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $color_group = ColorGroup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('color.group.edit', [$color_group->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.color-group.edit');
    }

    /** @test */
    public function color_group_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $color_group = ColorGroup::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->word;
        $response = $this->actingAs($user)->put(route('color.group.update', [$color_group->uuid]), [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'value' => $color_group->value,
            'is_active' => $color_group->is_active
        ]);
        $response->assertRedirect(route('color.group.index'));
        $this->assertDatabaseHas('color_groups', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function color_group_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $color_group = ColorGroup::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('color.group.change.status', [$color_group->uuid]));
        $response->assertStatus(200);
    }
}
