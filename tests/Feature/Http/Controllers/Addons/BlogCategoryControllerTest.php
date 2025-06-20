<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Blog\BlogCategory;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogCategoryControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function blog_category_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('blog.category.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.blog-category.create');
    }

    /** @test */
    public function blog_category_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('blog.category.store'), [
            'name' => $this->faker->unique()->word,
            'is_active' => 10
        ]);
         $response->assertRedirect(route('blog.category.index'));
    }

    /** @test */
    public function blog_category_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog_category = BlogCategory::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('blog.category.edit', [$blog_category->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.blog-category.edit');
    }

    /** @test */
    public function blog_category_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog_category = BlogCategory::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->word;
        $response = $this->actingAs($user)->put(route('blog.category.update', [$blog_category->uuid]), [
            'name' => $name,
            'is_active' => $blog_category->is_active
        ]);
        $response->assertRedirect(route('blog.category.index'));
        $this->assertDatabaseHas('blog_categories', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function blog_category_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog_category = BlogCategory::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('blog.category.change.status', [$blog_category->uuid]));
        $response->assertStatus(200);
    }
}
