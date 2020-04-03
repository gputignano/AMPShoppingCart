<?php

namespace Tests\Unit;

use App\Attribute;
use App\EAV;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_can_be_created()
    {
        $this->assertCount(0, EAV::all());

        factory(EAV::class)->create();

        $this->assertCount(1, EAV::all());
    }

    /** @test */
    public function an_eav_can_be_updated()
    {
        $eav = factory(EAV::class)->create();

        $eav->update([
            'attribute_id' => $attributeId = factory(Attribute::class)->create()->id,
            'product_id' => $productId = factory(Product::class)->create()->id,
            'valuable_type' => $valuableType = $this->faker->word,
            'valuable_id' => $valuableId = $this->faker->numberBetween(101, 200),
        ]);

        $this->assertEquals($attributeId, $eav->attribute_id);
        $this->assertEquals($productId, $eav->product_id);
        $this->assertEquals($valuableType, $eav->valuable_type);
        $this->assertEquals($valuableId, $eav->valuable_id);
    }

    /** @test */
    public function an_eav_can_be_deleted()
    {
        $eav = factory(EAV::class)->create();

        $eav->delete();

        $this->assertCount(0, EAV::all());
    }

    /**
     * RELATIONS
     */

     /** @test */
     public function eav_has_product_relation()
     {
         $eav = factory(EAV::class)->create();

         $this->assertInstanceOf(Product::class, $eav->product);
     }

     /** @test */
     public function eav_has_attribute_relation()
     {
         $eav = factory(EAV::class)->create();

         $this->assertInstanceOf(Attribute::class, $eav->attribute);
     }

     /** @test */
     public function eav_has_valuable_relation()
     {
        $eav = factory(EAV::class)->create();

         $this->assertInstanceOf($eav->valuable_type, $eav->valuable);
     }
}
