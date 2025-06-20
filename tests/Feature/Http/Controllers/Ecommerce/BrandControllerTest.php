<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Brand;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function brand_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('brand.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.brand.create');
    }

    /** @test */
    public function brand_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->post(route('brand.store'), [
            'name' => $name,
            'alias' => Str::slug($name, '-'),
            'description' => $this->faker->realText(rand(800, 2000)),
            'image' => 'brand-image.jpg',
        ]);
        $response->assertRedirect(route('brand.index'));
    }

    /** @test */
    public function brand_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $brand = Brand::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('brand.edit', [$brand->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.brand.edit');
    }

    /** @test */
    public function brand_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $brand = Brand::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('brand.update', [$brand->uuid]), [
            'name' => $name,
            'alias' => Str::slug($name, '-'),
            'description' => $brand->description,
            'image' => $brand->image,
        ]);
        $response->assertRedirect(route('brand.index'));
        $this->assertDatabaseHas('brands', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function brand_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $brand = Brand::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('brand.change.status', [$brand->uuid]));
        $response->assertStatus(200);
    }
}
