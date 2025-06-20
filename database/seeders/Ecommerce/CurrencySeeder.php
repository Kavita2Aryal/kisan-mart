<?php

namespace Database\Seeders\Ecommerce;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Currency;
use App\Models\Ecommerce\ExchangeRate;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::factory(2)->create()
        ->each(function ($currency) {

            $currency->exchangeRate()
                ->saveMany(ExchangeRate::factory(1)->create([
                    'currency_id' => $currency->id
                ]));
        });
    }
}
