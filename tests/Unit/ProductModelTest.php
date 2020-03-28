<?php

namespace Tests\Unit;

use App\AttributeSet;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_product_can_be_created()
    {
        $this->assertCount(0, Product::all());

        $product = factory(Product::class)->create();

        $this->assertCount(1, Product::all());
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $product = factory(Product::class)->create();

        $product->update([
            'parent_id' => $productId = factory(Product::class)->create()->id,
            'attribute_set_id' => $attributeSetId = factory(AttributeSet::class)->create()->id,
            'name' => $name = $this->faker->name,
            'code' => $code = Str::random(5),
            'price' => $price = $this->faker->randomFloat(null, 10, 4),
            'quantity' => $quantity = $this->faker->numberBetween(0, 100),
        ]);

        $this->assertEquals($productId, $product->parent_id);
        $this->assertEquals($attributeSetId, $product->attribute_set_id);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($code, $product->code);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($quantity, $product->quantity);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $product = factory(Product::class)->create();

        $product->delete();

        $this->assertCount(0, Product::all());
    }
}
