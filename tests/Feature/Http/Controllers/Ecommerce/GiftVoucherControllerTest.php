<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\GiftVoucher\GiftVoucher;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class GiftVoucherControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function gift_voucher_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('gift.voucher.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.gift-voucher.create');
    }

    /** @test */
    public function gift_voucher_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();    
        $title = $this->faker->realText(rand(15, 30));    
        $response = $this->actingAs($user)->post(route('gift.voucher.store'), [
            'code'              => Str::random(8),
            'title'             => $title,
            'alias'             => Str::slug($title, '-'),
            'description'       => $this->faker->realText(rand(800, 2000)),
            'image'             => rand(0, 9).'.jpg',
            'value'             => Arr::random([1000, 2000, 3000]),
            'price'             => Arr::random([1000, 2000, 3000]),
            'start_date'        => now()->toDateTimeString(),
            'end_date'          => now()->addDays(60)->toDateTimeString(),
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('gift.voucher.index'));
    }

    /** @test */
    public function gift_voucher_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $gift_voucher = GiftVoucher::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('gift.voucher.edit', $gift_voucher->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.gift-voucher.edit');
    }

    /** @test */
    public function gift_voucher_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $gift_voucher = GiftVoucher::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('gift.voucher.update', [$gift_voucher->uuid]), [
            'code'              => $gift_voucher->code,
            'title'             => $gift_voucher->title,
            'description'       => $gift_voucher->description,
            'image'             => $gift_voucher->image,
            'value'             => $gift_voucher->value,
            'price'             => $gift_voucher->price,
            'start_date'        => $gift_voucher->start_date,
            'end_date'          => $gift_voucher->end_date,
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('gift.voucher.index'));
    }

    /** @test */
    public function gift_voucher_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $gift_voucher = GiftVoucher::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('gift.voucher.change.status', [$gift_voucher->uuid]));
        $response->assertStatus(200);
    }
}
