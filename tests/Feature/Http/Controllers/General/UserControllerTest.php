<?php

namespace Tests\Feature\Http\Controllers\General;

use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function user_create()
    {
        $super_admin = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($super_admin)->get(route('user.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.general.user.create');
    }

    /** @test */
    public function user_store()
    {
        $super_admin = User::where('email', 'info@kisanmart.com')->first();
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(9);

        $response = $this->actingAs($super_admin)->post(route('user.store'), [
            'uuid' => Str::uuid(),
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'role_id'   => 2,
            'permissions' => [
                0 => '101',
                1 => '102',
                2 => '103',
                3 => '104',
                4 => '105',
                5 => '106',
                6 => '107',
                7 => '108',
                8 => '109',
                9 => '110',
                10 => '111',
                11 => '112',
                12 => '113',
                13 => '114',
                14 => '115',
                15 => '116',
                16 => '117',
                17 => '118',
                18 => '119',
                19 => '120',
            ]
        ]);

        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
    }

    /** @test */
    public function user_edit()
    {
        $super_admin = User::where('email', 'info@kisanmart.com')->first();
        $user = User::where('role_id', '!=', 1)->orderBy('id', 'D')->first();
        $response = $this->actingAs($super_admin)->get(route('user.edit', [$user->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.general.user.edit');
    }

    /** @test */
    public function user_update()
    {
        $super_admin = User::where('email', 'info@kisanmart.com')->first();
        $user = User::where('role_id', '!=', 1)->orderBy('id', 'DESC')->first();
        $name = $this->faker->name;
        $password = $this->faker->password(9);
        $response = $this->actingAs($super_admin)->put(route('user.update', [$user->uuid]), [
            'name' => $name,
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password,
            'is_active' => 10,
            'role_id'   => 2,
            'permissions' => [
                0 => '101',
                1 => '102',
                2 => '103',
                3 => '104',
                4 => '105',
                5 => '106',
                6 => '107',
                7 => '108',
                8 => '109',
                9 => '110',
            ]
        ]);
        $response->assertRedirect(route('user.index'));
        $this->assertDatabaseHas('users', [
            'name' => $name
        ]);
    }

    /** @test */
    public function user_change_status()
    {
        $super_admin = User::where('email', 'info@kisanmart.com')->first();
        $user = User::where('role_id', '!=', 1)->orderBy('id', 'DESC')->first();
        $response = $this->actingAs($super_admin)->put(route('user.change.status', [$user->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function user_view_permission()
    {
        $super_admin = User::where('email', 'info@kisanmart.com')->first();
        $user = User::where('role_id', '!=', 1)->orderBy('id', 'DESC')->first();
        $response = $this->actingAs($super_admin)->put(route('user.view.permission', [$user->uuid]));
        $response->assertStatus(200);
    }
}
