<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory(2)->create();
    }
}
