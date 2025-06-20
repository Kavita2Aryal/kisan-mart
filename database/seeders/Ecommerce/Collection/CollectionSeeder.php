<?php

namespace Database\Seeders\Ecommerce\Collection;

use Illuminate\Database\Seeder;
use App\Models\Ecommerce\Collection\Collection;
use App\Models\Ecommerce\Collection\CollectionProduct;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collection::factory(6)->create()
        ->each(function ($collection) {
            
            $collection->collection_products()
                ->saveMany(Offer::factory(rand(12, 60))->create([
                    'collection_id' => $collection->id
                ]));

        });
    }
}
