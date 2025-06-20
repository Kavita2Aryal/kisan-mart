<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Country;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function country_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('country.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.country.create');
    }

    /** @test */
    public function country_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('country.store'), [
            'name' => $this->faker->unique()->name,
            'country_code' => Str::random(3),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('country.index'));
    }

    /** @test */
    public function country_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $country = Country::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('country.edit', [$country->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.country.edit');
    }

    /** @test */
    public function country_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $country = Country::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('country.update', [$country->uuid]), [
            'name' => $name,
            'country_code' => Str::random(3),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('country.index'));
        $this->assertDatabaseHas('countries', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function country_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $country = Country::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('country.change.status', [$country->uuid]));
        $response->assertStatus(200);
    }
}
