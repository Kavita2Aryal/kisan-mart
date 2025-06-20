<?php

namespace Database\Seeders\Ecommerce\Offer;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Offer\Offer;
use App\Models\Ecommerce\Offer\OfferProduct;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::factory(6)->create()
        ->each(function ($offer) {
            
            $offer->offer_products()
                ->saveMany(Offer::factory(rand(12, 60))->create([
                    'offer_id' => $offer->id,
                    'discount_type' => $offer->discount_type,
                    'discount' => rand(1, $offer->discount)
                ]));

        });
    }
}
