<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Category;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function category_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('category.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.category.create');
    }

    /** @test */
    public function category_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $name = $this->faker->unique()->word;
        $parents = Category::where('is_active', 10)->where('parent_id', 0)->pluck('id');
        $response = $this->actingAs($user)->post(route('category.store'), [
            'name'          => $name,
            'alias'         => Str::slug($name, '-'),
            'description'   => $this->faker->realText(rand(800, 2000)),
            'image'         => rand(1, 10) . '.jpg',
            'parent_id'     => $parents->count() > 0 ? collect($parents)->random() : 0,
            'is_active'     => 10
        ]);
        $response->assertRedirect(route('category.index'));
    }

    /** @test */
    public function category_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $category = Category::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('category.edit', [$category->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.category.edit');
    }

    /** @test */
    public function category_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $category = Category::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->word;
        $parents = Category::where('is_active', 10)->where('parent_id', 0)->pluck('id');
        $response = $this->actingAs($user)->put(route('category.update', [$category->uuid]), [
            'name' => $name,
            'alias' => Str::slug($name, '-'),
            'description' => $category->description,
            'image' => $category->image,
            'parent_id'     => $parents->count() > 0 ? collect($parents)->random() : 0,
            'is_active'     => 10
        ]);
        $response->assertRedirect(route('category.index'));
        $this->assertDatabaseHas('categories', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function category_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $category = Category::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('category.change.status', [$category->uuid]));
        $response->assertStatus(200);
    }
}
