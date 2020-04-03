<?php

namespace Tests\Unit;

use App\AttributeSet;
use App\Category;
use App\Product;
use App\Rewrite;
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
            'product_id' => $productId = factory(Product::class)->create()->id,
            'attribute_set_id' => $attributeSetId = factory(AttributeSet::class)->create()->id,
            'name' => $name = $this->faker->name,
            'code' => $code = Str::random(5),
            'price' => $price = $this->faker->randomFloat(null, 10, 4),
            'quantity' => $quantity = $this->faker->numberBetween(0, 100),
        ]);

        $this->assertEquals($productId, $product->product_id);
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

    /** @test */
    public function when_a_parent_product_is_deleted_all_children_products_are_deleted()
    {
        $product = factory(Product::class)->create();

        $product->children()->saveMany(factory(Product::class, 2)->make());

        $this->assertCount(3, Product::all());

        $product->delete();

        $this->assertCount(0, Product::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function product_has_parent_relation()
    {
        // Many to One
        $children = factory(Product::class)->create([
            'product_id' => factory(Product::class)->create(),
        ]);

        $this->assertCount(2, Product::all());
        $this->assertInstanceOf(Product::class, $children->parent);
    }

    /** @test */
    public function product_has_children_relation()
    {
        // One to Many
        $product = factory(Product::class)->create()->children()->save(factory(Product::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $product->children);
    }

    /** @test */
    public function product_has_attribute_set_relation()
    {
        // Many to One
        $attributeSet = factory(AttributeSet::class)->create();

        $product = factory(Product::class)->create([
            'attribute_set_id' => $attributeSet->id,
        ]);

        $this->assertInstanceOf(AttributeSet::class, $product->attribute_set);
    }

    /** @test */
    public function product_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $product->eavs);
    }

    /** @test */
    public function product_has_categories_relation()
    {
        // Many to Many
        $product = factory(Product::class)->create();
        $product->categories()->save(factory(Category::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $product->categories);
    }

    /** @test */
    public function product_has_rewrite_relation()
    {
        // One to One Polymorphic
        $product = factory(Product::class)->create();
        $product->rewrite()->save(factory(Rewrite::class)->make());

        $this->assertInstanceOf(Rewrite::class, $product->rewrite);
    }
}
