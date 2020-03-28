<?php

namespace Tests\Unit;

use App\Attribute;
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
            'attribute_id' => $attributeId = factory(Attribute::class)->create()->id,
            'value' => $value = $this->faker->word,
        ]);

        $this->assertEquals($attributeId, $productAttributeValueString->attribute_id);
        $this->assertEquals($value, $productAttributeValueString->value);
    }

    /** @test */
    public function a_product_attribute_value_string_can_be_deleted()
    {
        $productAttributeValueString = factory(ProductAttributeValueString::class)->create();

        $productAttributeValueString->delete();

        $this->assertCount(0, ProductAttributeValueString::all());
    }
}
