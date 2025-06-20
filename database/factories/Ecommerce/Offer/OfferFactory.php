<?php

namespace Database\Factories\Ecommerce\Collection;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

use App\Models\Ecommerce\Collection\Offer;
use App\Models\General\User;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $discount_type = Arr::random([1, 2]);
        $discount = $discount_type == 1 ? Arr::random([5, 10, 12, 15, 20]) : Arr::random([50, 100, 125, 150, 200]);

        return [
            'uuid'              => $this->faker->uuid,
            'name'              => $this->faker->realText(rand(15, 30)),
            'title'             => $this->faker->realText(rand(15, 30)),
            'description'       => $this->faker->realText(rand(800, 2000)),
            'start_date'        => now()->toDateTimeString(),
            'end_date'          => now()->addDays(60)->toDateTimeString(),
            'discount_type'     => $discount_type,
            'discount'          => $discount,
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}