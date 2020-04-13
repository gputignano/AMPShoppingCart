<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_product_can_be_created()
    {
        $response = $this->postJson(route('products.store'), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $product = factory(Product::class)->create();

        $response = $this->patchJson(route('products.update', $product), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $product = factory(Product::class)->create();

        $response = $this->deleteJson(route('products.destroy', $product), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
