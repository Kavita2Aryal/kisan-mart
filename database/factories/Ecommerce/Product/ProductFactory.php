<?php

namespace Database\Factories\Ecommerce\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Brand;
use App\Models\General\User;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $videos = collect([
            'https://youtu.be/fzGBRDpf5GU',
            'https://youtu.be/u4ydvYH4L18',
            'https://youtu.be/OFqRej80iIY',
            'https://youtu.be/BFuiy-688zg',
            'https://youtu.be/NsRLOV4pHyk',
            'https://youtu.be/Sy8nPI85Ih4'
        ]);

        $name = $this->faker->unique()->userName . ' ' . $this->faker->unique()->userName;
        return [
            'name'              => $name,
            'slug'              => Str::slug($name, '-'),
            'uuid'              => $this->faker->uuid,
            'short_description' => $this->faker->realText(rand(800, 2000)),
            'long_description'  => $this->faker->realText(rand(800, 2000)),
            'keywords'          => join(',', $this->faker->words(rand(3, 5))),
            'type'              => Arr::random([1, 2]),
            'video_url'         => $videos->random(),
            'has_variant'       => Arr::random([0, 10]),
            'show_qty'          => Arr::random([0, 10]),
            'hit_count'         => 0,
            'purchase_count'    => 0,
            'category_id'       => collect(Category::where('is_active', 10)->pluck('id'))->random(),
            'brand_id'          => collect(Brand::where('is_active', 10)->pluck('id'))->random(),
            'user_id'           => collect(User::where('is_active', 10)->pluck('id'))->random(),
            'is_active'         => 10
        ];
    }
}
