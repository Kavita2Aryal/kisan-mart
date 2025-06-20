<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Size;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class SizeControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function size_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('size.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.size.create');
    }

    /** @test */
    public function size_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('size.store'), [
            'value' => 'Y',
            'is_active' => 10
        ]);
        $response->assertRedirect(route('size.index'));
    }

    /** @test */
    public function size_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $size = Size::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('size.edit', [$size->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.size.edit');
    }

    /** @test */
    public function size_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $size = Size::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('size.update', [$size->uuid]), [
            'value' => 'Z',
            'is_active' => $size->is_active
        ]);
        $response->assertRedirect(route('size.index'));
    }

    /** @test */
    public function size_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $size = Size::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('size.change.status', [$size->uuid]));
        $response->assertStatus(200);
    }
}
