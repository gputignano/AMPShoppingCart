<?php

namespace Tests\Unit;

use App\Attribute;
use App\AttributeProduct;
use App\Product;
use App\ProductAttributeValueString;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeProductModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_attribute_product_can_be_created()
    {
        $this->assertCount(0, AttributeProduct::all());

        factory(AttributeProduct::class)->create();

        $this->assertCount(1, AttributeProduct::all());
    }

    /** @test */
    public function an_attribute_product_can_be_updated()
    {
        $attributeProduct = factory(AttributeProduct::class)->create();

        $attributeProduct->update([
            'attribute_id' => $attributeId = factory(Attribute::class)->create()->id,
            'product_id' => $productId = factory(Product::class)->create()->id,
            'valuable_type' => $valuableType = $this->faker->word,
            'valuable_id' => $valuableId = $this->faker->numberBetween(101, 200),
        ]);

        $this->assertEquals($attributeId, $attributeProduct->attribute_id);
        $this->assertEquals($productId, $attributeProduct->product_id);
        $this->assertEquals($valuableType, $attributeProduct->valuable_type);
        $this->assertEquals($valuableId, $attributeProduct->valuable_id);
    }

    /** @test */
    public function an_attribute_product_can_be_deleted()
    {
        $attributeProduct = factory(AttributeProduct::class)->create();

        $attributeProduct->delete();

        $this->assertCount(0, AttributeProduct::all());
    }

    /**
     * RELATIONS
     */

     /** @test */
     public function attribute_product_has_product_relation()
     {
         $attributeProduct = factory(AttributeProduct::class)->create();

         $this->assertInstanceOf(Product::class, $attributeProduct->product);
     }

     /** @test */
     public function attribute_product_has_attribute_relation()
     {
         $attributeProduct = factory(AttributeProduct::class)->create();

         $this->assertInstanceOf(Attribute::class, $attributeProduct->attribute);
     }

     /** @test */
     public function attribute_product_has_valuable_relation()
     {
         $productAttributeValueString = factory(ProductAttributeValueString::class)->create();
         $attributeProduct = factory(AttributeProduct::class)->create([
             'valuable_type' => ProductAttributeValueString::class,
             'valuable_id' => $productAttributeValueString->id,
         ]);

         $this->assertInstanceOf(ProductAttributeValueString::class, $attributeProduct->valuable);
     }
}
