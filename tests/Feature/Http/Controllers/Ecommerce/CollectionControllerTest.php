<?php

namespace Tests\Feature\Http\Controllers\Ecommerce;

use App\Models\Ecommerce\Collection\Collection;
use App\Models\Ecommerce\Product\Product;
use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CollectionControllerTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function collection_create()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $response = $this->actingAs($user)->get(route('collection.create'));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.collection.create');
    }

    /** @test */
    public function collection_store()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $name = $this->faker->unique()->word;
        
        $response = $this->actingAs($user)->post(route('collection.store'), [
            'name'              => $name,
            'alias'             => Str::slug($name, '-'),
            'description'       => $this->faker->realText(rand(800, 2000)),
            'collection_type'   => rand(1, 4),
            'image'             => rand(1, 10) . '.jpg',
            'is_active'         => 10
        ]);
        $collection = Collection::orderBy('id', 'DESC')->first();
        $response->assertRedirect(route('collection.manage', [$collection->uuid]));
    }

    /** @test */
    public function collection_edit()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $collection = Collection::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('collection.edit', $collection->uuid));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.collection.edit');
    }

    /** @test */
    public function collection_update()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $collection = Collection::orderBy('id', 'DESC')->first();
        $name = $this->faker->unique()->word;
        $response = $this->actingAs($user)->put(route('collection.update', [$collection->uuid]), [
            'name'              => $name,
            'alias'             => Str::slug($name, '-'),
            'description'       => $collection->description,
            'collection_type'   => $collection->collection_type,
            'image'             => $collection->image,
            'is_active'         => 10
        ]);
        $response->assertRedirect(route('collection.index'));
        $this->assertDatabaseHas('collections', [
            'name' => $name,
        ]);
    }

    /** @test */
    public function collection_change_status()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $collection = Collection::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->put(route('collection.change.status', [$collection->uuid]));
        $response->assertStatus(200);
    }

    /** @test */
    public function collection_manage()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $collection = Collection::orderBy('id', 'DESC')->first();
        $response = $this->actingAs($user)->get(route('collection.manage', [$collection->uuid]));
        $response->assertStatus(200);
        $response->assertViewIs('modules.ecommerce.collection.manage');
    }

    /** @test */
    public function collection_manage_save()
    {
        $user = User::where('email', 'info@kisanmart.com')->first();
        $collection = Collection::orderBy('id', 'DESC')->first();
        $products = [];
        $product_ids = collect(Product::where('is_active', 10)->pluck('id'));
        for($i=0; $i<=5; $i++)
        {
            $products[$i]['index'] = $product_ids->random();
        }
        $response = $this->actingAs($user)->put(route('collection.manage.save', [$collection->uuid]), [
            'products' => $products
        ]);
        $response->assertStatus(302);
    }
}
