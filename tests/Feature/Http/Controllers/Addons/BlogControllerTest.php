<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Author;
use App\Models\Addons\Blog\Blog;
use App\Models\Addons\Blog\BlogCategory;
use App\Models\Cms\ImageX;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function blog_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('blog.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.blog.create');
    }

    /** @test */
    public function blog_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $title = $this->faker->realText(rand(20, 30));
        $image = collect(ImageX::pluck('id'));
        $contents = [];
        $display_order = 0;
        for($i=0; $i<=2; $i++){
            $contents[$i] = [
                'display_order'     => $display_order++,
                'description'       => ($i%2 == 0) ? $this->faker->realText(rand(800, 1000)) : '',
                'image_gallery'     => ($i%2 != 0) ? [0 => $image->random(), 1 => $image->random()] : null,
            ];
        }
        $blog = [
            'title'                 => $title,
            'subtitle'              => $this->faker->realText(rand(100, 200)),
            'alias'                 => Str::slug($title, '-'),
            'category_id'           => collect(BlogCategory::where('is_active', 10)->pluck('id'))->random(),
            'author_id'             => collect(Author::where('is_active', 10)->pluck('id'))->random(),
            'keywords'              => join(',', $this->faker->words(rand(3, 5))),
            'intro_image_id'        => $image->random(),
            'banner_image_id'       => $image->random(),
            'is_active'             => 10,
            'published_at'          => now()->toDateString(),
            'seo'                   => [
                'meta_title'        => $title,
                'meta_description'  => $this->faker->realText(rand(800, 2000)),
                'meta_keywords'     => join(',', $this->faker->words(rand(3, 5))),
                'image_id'          => $image->random(),
                'image_alt'         => $title
            ],
            'contents'              => $contents
        ];
        $response = $this->actingAs($user)->post(route('blog.store'), $blog);
        $response->assertRedirect(route('blog.index'));
    }

    /** @test */
    public function blog_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog = Blog::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('blog.edit', $blog->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.blog.edit');
    }

    /** @test */
    public function blog_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_blog = Blog::orderBy('id', 'DESC')->first();
        $title = $this->faker->realText(rand(20, 30));
        $image = collect(ImageX::pluck('id'));
        $contents = [];
        $display_order = 0;
        for($i=0; $i<=2; $i++){
            $contents[$i] = [
                'display_order'     => $display_order++,
                'description'       => ($i%2 == 0) ? $this->faker->realText(rand(800, 1000)) : '',
                'image_gallery'     => ($i%2 != 0) ? [0 => $image->random(), 1 => $image->random()] : null,
            ];
        }
        $blog = [
            'title'                 => $title,
            'subtitle'              => $this->faker->realText(rand(100, 200)),
            'alias'                 => Str::slug($title, '-'),
            'category_id'           => $db_blog->category_id,
            'author_id'             => $db_blog->author_id,
            'keywords'              => $db_blog->keywords,
            'intro_image_id'        => $db_blog->intro_image_id,
            'banner_image_id'       => $db_blog->banner_image_id,
            'is_active'             => 10,
            'published_at'          => now()->toDateString(),
            'seo'                   => [
                'meta_title'        => $db_blog->seo->meta_title,
                'meta_description'  => $db_blog->seo->meta_description,
                'meta_keywords'     => $db_blog->seo->meta_keywords,
                'image_id'          => $db_blog->seo->image_id,
                'image_alt'         => $db_blog->seo->image_alt
            ],
            'contents'              => $contents
        ];
        $response = $this->actingAs($user)->put(route('blog.update', [$db_blog->uuid]), $blog);
        $response->assertRedirect(route('blog.index'));
        $this->assertDatabaseHas('blogs', [
            'title' => $title,
        ]);
    }

    /** @test */
    public function blog_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog = Blog::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('blog.change.status', [$blog->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function blog_soft_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog = Blog::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('blog.softdelete', [$blog->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function blog_trash()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog = Blog::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('blog.trash'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.blog.trash');
    }

    /** @test */
    public function blog_restore()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog = Blog::orderBy('id', 'DESC')->onlyTrashed()->first();
        $response = $this->actingAs($user)->put(route('blog.restore', [$blog->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function blog_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $blog = Blog::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('blog.destroy', [$blog->uuid]));
        $response->assertStatus(302);
    }
}
