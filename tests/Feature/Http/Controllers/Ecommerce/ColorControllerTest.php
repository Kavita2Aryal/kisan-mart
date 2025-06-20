<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Color;
use App\Models\Ecommerce\ColorGroup;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ColorControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function color_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('color.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.color.create');
    }

    /** @test */
    public function color_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('color.store'), [
            'name' => $this->faker->unique()->name,
            'value' => $this->faker->unique()->name,
            'color_group' => collect(ColorGroup::where('is_active', 10)->pluck('id'))->random(),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('color.index'));
    }

    /** @test */
    public function color_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $color = Color::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('color.edit', [$color->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.color.edit');
    }

    /** @test */
    public function color_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $color = Color::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('color.update', [$color->uuid]), [
            'name' => $name,
            'value' => $color->value,
            'color_group' => $color->color_group_id,
            'is_active' => 10
        ]);
        $response->assertRedirect(route('color.index'));
        $this->assertDatabaseHas('colors', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function color_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $color = Color::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('color.change.status', [$color->uuid]));
        $response->assertStatus(200);
    }
}
