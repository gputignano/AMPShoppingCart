<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = factory(Product::class)->create();
    }

    /** @test */
    public function a_product_can_be_created()
    {
        $this->assertCount(1, Product::all());
        $this->assertInstanceOf(Product::class, $this->product);
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $updated = $this->product->update([
            'parent_id' => $productId = factory(Product::class)->create(),
            'name' => $name = $this->faker->name,
        ]);

        $this->assertTrue($updated);
        $this->assertEquals($productId, $this->product->parent_id);
        $this->assertEquals($name, $this->product->name);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $this->product->delete();

        $this->assertDeleted($this->product);
    }

    /** @test */
    public function when_a_parent_product_is_deleted_all_children_products_are_deleted()
    {
        $children = $this->product->children()->save(factory(Product::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);
        $this->assertDeleted($children);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function product_has_parent_relation()
    {
        // Many to One
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->product->parent());
    }

    /** @test */
    public function product_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->product->children());
    }

    /** @test */
    public function product_has_attribute_sets_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\database\Eloquent\Relations\BelongsToMany::class, $this->product->attribute_sets());
    }

    /** @test */
    public function product_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->product->eavs());
    }

    /** @test */
    public function product_has_categories_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->product->categories());
    }

    /** @test */
    public function product_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->product->rewrite());
    }
}
