<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Currency;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function currency_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('currency.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.currency.create');
    }

    /** @test */
    public function currency_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();    
        $response = $this->actingAs($user)->post(route('currency.store'), [
            'currency'          => Arr::random(['USD', 'EUR']),
            'is_active'         => 10
        ]);
        $currency = Currency::orderBy('id', 'DESC')->first();
        $response->assertRedirect(route('currency.exchange.rate.edit', [$currency->uuid]));
    }

    /** @test */
    public function currency_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $currency = Currency::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('currency.edit', $currency->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.currency.edit');
    }

    /** @test */
    public function currency_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $currency = Currency::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('currency.update', [$currency->uuid]), [
            'currency'          => Arr::random(['USD', 'EUR']),
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('currency.index'));
    }

    /** @test */
    public function currency_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $currency = Currency::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('currency.change.status', [$currency->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function exchange_rate_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $currency = Currency::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('currency.exchange.rate.edit', [$currency->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.currency.exchange-rate');
    }

    /** @test */
    public function exchange_rate_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $currency = Currency::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('currency.exchange.rate.update', [$currency->uuid]), [
            'rate' => rand(50, 200)
        ]);
        $response->assertStatus(302);
    }
}
