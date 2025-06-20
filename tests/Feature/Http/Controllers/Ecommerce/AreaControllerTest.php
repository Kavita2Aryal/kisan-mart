<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Area;
use App\Models\Ecommerce\City;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class AreaControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function area_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('area.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.area.create');
    }

    /** @test */
    public function area_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('area.store'), [
            'name' => $this->faker->unique()->name,
            'city_id' => collect(City::where('is_active', 10)->pluck('id'))->random(),
            'condition_amount'  => Arr::random(['2000', '5000', '10000']),
            'delivery_charge'   => Arr::random(['0', '100', '200']),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('area.index'));
    }

    /** @test */
    public function area_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $area = Area::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('area.edit', [$area->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.area.edit');
    }

    /** @test */
    public function area_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $area = Area::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('area.update', [$area->uuid]), [
            'name' => $name,
            'city_id' => $area->city_id,
            'condition_amount'  => $area->condition_amount,
            'delivery_charge'   => $area->delivery_charge,
            'is_active' => 10
        ]);
        $response->assertRedirect(route('area.index'));
        $this->assertDatabaseHas('areas', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function area_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $area = Area::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('area.change.status', [$area->uuid]));
        $response->assertStatus(200);
    }
}
