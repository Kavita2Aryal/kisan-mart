<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(20)->create();
    }
}
