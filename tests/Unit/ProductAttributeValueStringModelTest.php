<?php

namespace Tests\Unit;

use App\ProductAttributeValueString;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAttributeValueStringModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_product_attribute_value_string_can_be_created()
    {
        $this->assertCount(0, ProductAttributeValueString::all());

        $productAttributeValueString = factory(ProductAttributeValueString::class)->create();

        $this->assertCount(1, ProductAttributeValueString::all());
    }

    /** @test */
    public function a_product_attribute_value_string_can_be_updated()
    {
        $productAttributeValueString = factory(ProductAttributeValueString::class)->create();

        $productAttributeValueString->update([
            'value' => $value = $this->faker->word,
        ]);

        $this->assertEquals($value, $productAttributeValueString->value);
    }

    /** @test */
    public function a_product_attribute_value_string_can_be_deleted()
    {
        $productAttributeValueString = factory(ProductAttributeValueString::class)->create();

        $productAttributeValueString->delete();

        $this->assertCount(0, ProductAttributeValueString::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function product_attribute_value_string_has_attribute_product_relation()
    {
        $productAttributeValueString = factory(ProductAttributeValueString::class)->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $productAttributeValueString->attribute_products);
    }
}
