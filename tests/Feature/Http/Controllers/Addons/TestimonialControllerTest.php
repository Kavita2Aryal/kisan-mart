<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Testimonial;
use App\Models\Cms\ImageX;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TestimonialControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function testimonial_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('testimonial.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.testimonial.create');
    }

    /** @test */
    public function testimonial_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('testimonial.store'), [
            'name'              => $this->faker->unique()->name,
            'position'          => $this->faker->unique()->word,
            'title'             => $this->faker->realText(rand(20, 50)),
            'description'       => $this->faker->realText(rand(800, 2000)),
            'published_at'      => now()->toDateString(),
            'image_id'          => collect(ImageX::pluck('id'))->random(),
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('testimonial.index'));
    }

    /** @test */
    public function testimonial_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $testimonial = Testimonial::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('testimonial.edit', [$testimonial->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.testimonial.edit');
    }

    /** @test */
    public function testimonial_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $testimonial = Testimonial::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('testimonial.update', [$testimonial->uuid]), [
            'name'              => $name,
            'title'             => $this->faker->realText(rand(20, 50)),
            'position'          => $testimonial->position,
            'description'       => $testimonial->description,
            'published_at'      => $testimonial->published_at,
            'image_id'          => $testimonial->image_id,
            'is_active'         => $testimonial->is_active
        ]);
        $response->assertRedirect(route('testimonial.index'));
        $this->assertDatabaseHas('testimonials', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function testimonial_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $testimonial = Testimonial::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('testimonial.change.status', [$testimonial->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function testimonial_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $testimonial = Testimonial::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('testimonial.destroy', [$testimonial->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function testimonial_sort()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('testimonial.sort'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.testimonial.sort');
    }

    /** @test */
    public function testimonial_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_testimonials = Testimonial::pluck('id')->toArray();
        $count = count($db_testimonials);
        for($i=0; $i<$count; $i++)
        {
            $testimonial[$i] = $value = Arr::random($db_testimonials);
            unset($db_testimonials[array_search($value, $db_testimonials)]);
        }
        $response = $this->actingAs($user)->post(route('testimonial.manage.order'), [
            'testimonial' => $testimonial
        ]);
        $response->assertStatus(200);
    }
}
