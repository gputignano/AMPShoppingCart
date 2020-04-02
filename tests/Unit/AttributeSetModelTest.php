<?php

namespace Tests\Unit;

use App\Attribute;
use App\AttributeSet;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeSetModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_attribute_set_can_be_created()
    {
        $this->assertCount(0, AttributeSet::all());

        $attributeSet = factory(AttributeSet::class)->create();

        $this->assertCount(1, AttributeSet::all());
    }

    /** @test */
    public function an_attribute_set_can_be_updated()
    {
        $attributeSet = factory(AttributeSet::class)->create();

        $attributeSet->update([
            'label' => $label = $this->faker->word,
        ]);

        $this->assertEquals($label, $attributeSet->label);
    }

    /** @test */
    public function an_attribute_set_can_be_deleted()
    {
        $attributeSet = factory(AttributeSet::class)->create();

        $attributeSet->delete();

        $this->assertCount(0, AttributeSet::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function attribute_set_has_attribute_relation()
    {
        $attributeSet = factory(AttributeSet::class)->create();

        $attributeSet->attributes()->saveMany(factory(Attribute::class, 2)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $attributeSet->attributes);
    }

    /** @test */
    public function attribute_set_has_products_relation()
    {
        $attributeSet = factory(AttributeSet::class)->create();

        $attributeSet->products()->saveMany(factory(Product::class, 2)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $attributeSet->products);
    }
}
