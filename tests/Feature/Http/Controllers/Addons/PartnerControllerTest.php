<?php

namespace Tests\Feature\Http\Controllers\Addons;

use App\Models\Addons\Partner;
use App\Models\Cms\ImageX;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class PartnerControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    /** @test */
    public function partner_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('partner.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.partner.create');
    }

    /** @test */
    public function partner_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->post(route('partner.store'), [
            'name' => $this->faker->unique()->name,
            'description'  => $this->faker->realText(rand(800, 2000)),
            'image_id'   => collect(ImageX::pluck('id'))->random(),
            'is_active' => 10
        ]);
        $response->assertRedirect(route('partner.index'));
    }

    /** @test */
    public function partner_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $partner = Partner::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('partner.edit', [$partner->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.partner.edit');
    }

    /** @test */
    public function partner_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $partner = Partner::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->name;
        $response = $this->actingAs($user)->put(route('partner.update', [$partner->uuid]), [
            'name' => $name,
            'description'  => $partner->description,
            'image_id'   => $partner->image_id,
            'is_active' => $partner->is_active
        ]);
        $response->assertRedirect(route('partner.index'));
        $this->assertDatabaseHas('partners', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function partner_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $partner = Partner::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('partner.change.status', [$partner->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function partner_delete()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $partner = Partner::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->delete(route('partner.destroy', [$partner->uuid]));
        $response->assertStatus(302);
    }

    /** @test */
    public function partner_sort()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('partner.sort'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.addons.partner.sort');
    }

    /** @test */
    public function partner_manage_order()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $db_partners = Partner::pluck('id')->toArray();
        $count = count($db_partners);
        for($i=0; $i<$count; $i++)
        {
            $partner[$i] = $value = Arr::random($db_partners);
            unset($db_partners[array_search($value, $db_partners)]);
        }
        $response = $this->actingAs($user)->post(route('partner.manage.order'), [
            'partner' => $partner
        ]);
        $response->assertStatus(200);
    }
}
