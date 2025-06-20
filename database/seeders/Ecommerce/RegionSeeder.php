<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::factory(20)->create();
    }
}
