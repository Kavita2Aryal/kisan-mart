<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\City;
use App\Models\Ecommerce\Region;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function city_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('city.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.city.create');
    }

    /** @test */
    public function city_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('city.store'), [
            'name' => $this->faker->unique()->name,
            'region_id' => collect(Region::where('is_active', 10)->pluck('id'))->random(),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('city.index'));
    }

    /** @test */
    public function city_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $city = City::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('city.edit', [$city->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.city.edit');
    }

    /** @test */
    public function city_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $city = City::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('city.update', [$city->uuid]), [
            'name' => $name,
            'region_id' => $city->region_id,
            'is_active' => 10
        ]);
        $response->assertRedirect(route('city.index'));
        $this->assertDatabaseHas('cities', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function city_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $city = City::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('city.change.status', [$city->uuid]));
        $response->assertStatus(200);
    }
}
