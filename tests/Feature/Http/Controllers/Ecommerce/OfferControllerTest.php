<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Offer\Offer;
use App\Models\Ecommerce\Product\Product;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class OfferControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function offer_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('offer.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.offer.create');
    }

    /** @test */
    public function offer_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();    
        $name = $this->faker->unique()->word;    
        $response = $this->actingAs($user)->post(route('offer.store'), [
            'name'              => $name,
            'alias'             => Str::slug($name, '-'),
            'title'             => $this->faker->realText(rand(15, 30)),
            'description'       => $this->faker->realText(rand(800, 2000)),
            'image'             => rand(0, 9).'.jpg',
            'discount_type'     => Arr::random([1, 2]),
            'start_date'        => now()->toDateTimeString(),
            'end_date'          => now()->addDays(60)->toDateTimeString(),
            'is_active'         => 10
        ]);
        $offer = Offer::orderBy('id', 'DESC')->first();
        $response->assertRedirect(route('offer.manage', [$offer->uuid]));
    }

    /** @test */
    public function offer_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $offer = Offer::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('offer.edit', $offer->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.offer.edit');
    }

    /** @test */
    public function offer_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $offer = Offer::orderBy('id', 'DESC')->first();
        $discount_type = Arr::random([1, 2]);
        $discount = $discount_type == 1 ? Arr::random([5, 10, 12, 15, 20]) : Arr::random([50, 100, 125, 150, 200]);
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('offer.update', [$offer->uuid]), [
            'name'              => $name,
            'alias'             => Str::slug($name, '-'),
            'title'             => $offer->title,
            'description'       => $offer->description,
            'image'             => $offer->image,
            'discount_type'     => $offer->discount_type,
            'start_date'        => $offer->start_date,
            'end_date'          => $offer->end_date,
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('offer.index'));
        $this->assertDatabaseHas('offers', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function offer_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $offer = Offer::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('offer.change.status', [$offer->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function offer_manage()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $offer = Offer::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('offer.manage', [$offer->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.offer.manage');
    }

    /** @test */
    public function offer_manage_save()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $offer = Offer::orderBy('id', 'DESC')->first();
        $products = [];
        $product_ids = collect(Product::where('is_active', 10)->pluck('id'));
        for($i=0; $i<=5; $i++)
        {
            $products[$i]['index'] = $product_ids->random();
        }
        $response = $this->actingAs($user)->put(route('offer.manage.save', [$offer->uuid]), [
            'products' => $products,
            'discount'  => $offer->discount_type == 1 ? Arr::random([5, 10, 12, 15, 20]) : Arr::random([50, 100, 125, 150, 200])
        ]);
        $response->assertStatus(302);
    }
}
