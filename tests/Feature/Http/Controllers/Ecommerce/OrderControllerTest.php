<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Order\Order;
use App\Models\Ecommerce\Order\OrderDetail;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function order_pending_list()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('order.pending'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.order.pending');
    }

    /** @test */
    public function order_confirmed_list()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('order.confirmed'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.order.confirmed');
    }

    /** @test */
    public function order_shipped_list()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('order.shipped'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.order.shipped');
    }

    /** @test */
    public function order_delivered_list()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('order.delivered'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.order.delivered');
    }

    /** @test */
    public function order_cancelled_list()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('order.cancelled'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.order.cancelled');
    }

    /** @test */
    public function order_confirmed()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::where('current_status', '1')->orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->post(route('order.confirm.save'), [
            'order_code' => $order->order_code 
        ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function order_shipped()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::where('current_status', '3')->orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->post(route('order.ship.save'), [
            'order_code' => $order->order_code 
        ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function order_delivered()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::where('current_status', '4')->orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->post(route('order.deliver.save'), [
            'order_code' => $order->order_code 
        ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function order_cancelled()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::where('current_status', '1')->orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->post(route('order.cancel.save'), [
            'order_code' => $order->order_code 
        ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function order_detail()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('order.detail', [$order->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.order.detail');
    }

    /** @test */
    public function order_detail_update_quantity()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::where('current_status', '1')->orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->post(route('order.detail.update'), [
            'order_id'  => $order->id,
            'order_detail_id'   => collect(OrderDetail::where('order_id', $order->id)->pluck('id'))->random(),
            'qty'   => rand(1, 5)
        ]);
        $response->assertStatus(200);
    }

    /** @test */
    public function order_detail_remove()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $order = Order::where('current_status', '1')->orderBy('created_at', 'DESC')->first();
        $response = $this->actingAs($user)->post(route('order.detail.remove'), [
            'order_id'  => $order->id,
            'order_detail_id'   => collect(OrderDetail::where('order_id', $order->id)->pluck('id'))->random(),
            'qty'   => rand(1, 5)
        ]);
        $response->assertStatus(200);
    }
}
