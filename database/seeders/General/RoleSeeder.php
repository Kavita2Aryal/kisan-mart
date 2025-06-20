<?php

namespace Database\Seeders\General;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'role'		 => 'Super Admin',
			'uuid'		 => Str::uuid()->toString(),
			'is_active'	 => 10,
			'is_super'	 => 10,
            'user_id'    => 1,
            'created_at' => now()->toDateTimeString(),
			'updated_at' => now()->toDateTimeString(),
        ]);
    }
}