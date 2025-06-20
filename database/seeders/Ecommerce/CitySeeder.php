<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory(20)->create();
    }
}
