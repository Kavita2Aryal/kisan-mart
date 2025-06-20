<?php

use Illuminate\Database\Seeder;

use Database\Seeders\General\UserSeeder;
use Database\Seeders\General\RoleSeeder;
use Database\Seeders\General\SettingSeeder;
use Database\Seeders\Build\ListGroupSeeder;

use Database\Seeders\Ecommerce\BrandSeeder;
use Database\Seeders\Ecommerce\CategorySeeder;
use Database\Seeders\Ecommerce\AreaSeeder;
use Database\Seeders\Ecommerce\CitySeeder;
use Database\Seeders\Ecommerce\RegionSeeder;
use Database\Seeders\Ecommerce\CountrySeeder;
use Database\Seeders\Ecommerce\SizeSeeder;
use Database\Seeders\Ecommerce\ColorGroupSeeder;
use Database\Seeders\Ecommerce\ColorSeeder;
use Database\Seeders\Ecommerce\CurrencySeeder;
use Database\Seeders\Ecommerce\ExchangeRateSeeder;
use Database\Seeders\Ecommerce\Product\ProductSeeder;
use Database\Seeders\Ecommerce\Collection\CollectionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SettingSeeder::class);
        // $this->call(ListGroupSeeder::class);

        // $this->call(BrandSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(RegionSeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(AreaSeeder::class);
        // $this->call(SizeSeeder::class);
        // $this->call(ColorGroupSeeder::class);
        // $this->call(ColorSeeder::class);
        // $this->call(CurrencySeeder::class);

        // $this->call(ProductSeeder::class);
        // $this->call(CollectionSeeder::class);
        
    }
}
