<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\PromoCode\PromoCode;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PromoCodeControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function promocode_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('promocode.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.promocode.create');
    }

    /** @test */
    public function promocode_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();        
        $discount_type = Arr::random([1, 2]);
        $discount = $discount_type == 1 ? Arr::random([5, 10, 12, 15, 20]) : Arr::random([50, 100, 125, 150, 200]);
        $response = $this->actingAs($user)->post(route('promocode.store'), [
            'code'                => Str::random(8),
            'type'                => rand(1,3),
            'minimum_purchase'    => rand(1000, 10000),
            'maximum_usage'       => rand(10, 20),
            'discount_type'       => $discount_type,
            'discount'            => $discount,
            'start_date'          => now()->toDateTimeString(),
            'end_date'            => now()->addDays(60)->toDateTimeString(),
            'used_count'          => 0,
            'is_active'           => 10,
        ]);
        $promocode = PromoCode::orderBy('id', 'DESC')->first();
        $response->assertRedirect(route('promocode.manage', [$promocode->uuid]));
    }

    /** @test */
    public function promocode_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $promocode = PromoCode::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('promocode.edit', $promocode->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.promocode.edit');
    }

    /** @test */
    public function promocode_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $promocode = PromoCode::orderBy('id', 'DESC')->first();
        $discount_type = Arr::random([1, 2]);
        $discount = $discount_type == 1 ? Arr::random([5, 10, 12, 15, 20]) : Arr::random([50, 100, 125, 150, 200]);
        $response = $this->actingAs($user)->put(route('promocode.update', [$promocode->uuid]), [
            'code'                => $promocode->code,
            'type'                => $promocode->type,
            'minimum_purchase'    => rand(1000, 10000),
            'maximum_usage'       => rand(10, 20),
            'discount_type'       => $discount_type,
            'discount'            => $discount,
            'start_date'          => $promocode->start_date,
            'end_date'            => $promocode->end_date,
            'used_count'          => 0,
            'is_active'           => 10,
        ]);
        $response->assertRedirect(route('promocode.index'));
        $this->assertDatabaseHas('promo_codes', [
            'code' => $promocode->code,
        ]);
    }

    /** @test */
    public function promocode_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $promocode = PromoCode::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('promocode.change.status', [$promocode->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function promocode_manage()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $promocode = PromoCode::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('promocode.manage', [$promocode->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.promocode.manage');
    }

    /** @test */
    public function promocode_manage_save()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $promocode = PromoCode::orderBy('id', 'DESC')->first();
        $products = [];
        $product_ids = collect(Product::where('is_active', 10)->pluck('id'));
        for($i=0; $i<=5; $i++)
        {
            $products[$i]['index'] = $product_ids->random();
        }
        $response = $this->actingAs($user)->put(route('promocode.manage.save', [$promocode->uuid]), [
            'products' => $products
        ]);
        $response->assertStatus(302);
    }
}
