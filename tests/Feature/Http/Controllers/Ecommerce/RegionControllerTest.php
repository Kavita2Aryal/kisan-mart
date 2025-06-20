<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Country;
use App\Models\Ecommerce\Region;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function region_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('region.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.region.create');
    }

    /** @test */
    public function region_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('region.store'), [
            'name' => $this->faker->unique()->name,
            'country_id' => collect(Country::where('is_active', 10)->pluck('id'))->random(),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('region.index'));
    }

    /** @test */
    public function region_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $region = Region::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('region.edit', [$region->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.region.edit');
    }

    /** @test */
    public function region_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $region = Region::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('region.update', [$region->uuid]), [
            'name' => $name,
            'country_id' => $region->country_id,
            'is_active' => 10
        ]);
        $response->assertRedirect(route('region.index'));
        $this->assertDatabaseHas('regions', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function region_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $region = Region::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('region.change.status', [$region->uuid]));
        $response->assertStatus(200);
    }
}
