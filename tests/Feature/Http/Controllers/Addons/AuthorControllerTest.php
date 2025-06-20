<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Author;
use App\Models\Cms\ImageX;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function author_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('author.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.author.create');
    }

    /** @test */
    public function author_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('author.store'), [
            'name' => $this->faker->unique()->name,
            'profession' => $this->faker->unique()->word,
            'description'  => $this->faker->realText(rand(800, 2000)),
            'image_id'   => collect(ImageX::pluck('id'))->random(),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('author.index'));
    }

    /** @test */
    public function author_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $author = Author::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('author.edit', [$author->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.author.edit');
    }

    /** @test */
    public function author_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $author = Author::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('author.update', [$author->uuid]), [
            'name' => $name,
            'profession' => $author->profession,
            'description'  => $author->description,
            'image_id'   => $author->image_id,
            'is_active' => $author->is_active
        ]);
        $response->assertRedirect(route('author.index'));
        $this->assertDatabaseHas('authors', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function author_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $author = Author::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('author.change.status', [$author->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function author_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $author = Author::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('author.destroy', [$author->uuid]));
        $response->assertStatus(302);
    }
}
