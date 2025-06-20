<?php

namespace Database\Seeders\Ecommerce;

use App\Models\Cms\WebAlias;
use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Brand;
use DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory(1)->create()
            ->each(function ($brand) {
                DB::table('web_alias')->insert([
                    'alias' => $brand->slug,
                    'brand_id' => $brand->id
                ]);
            });
    }
}
