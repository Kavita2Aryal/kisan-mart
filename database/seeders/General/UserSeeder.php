<?php

namespace Database\Seeders\General;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'				=> 'Super Admin',
        	'role_id'			=> 1,
			'uuid'				=> Str::uuid()->toString(),
			'is_active'			=> 10,
			'email'				=> 'info@kisanmart.com',
			'email_verified_at'	=> NULL,
			'password'			=> '$2y$10$GLc5272vT/VALWDnmG44/umzZciWGHS5z/JOm/7W6o494ZUApR7vC', //123456789
			'remember_token'	=> NULL,
			'created_at'		=> now()->toDateTimeString(),
			'updated_at'		=> now()->toDateTimeString(),
        ]);
    }
}
