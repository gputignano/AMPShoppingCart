<?php

namespace Tests\Unit;

use App\Attribute;
use App\EAV;
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
            'entity_eavable_type' => $entitableType = $this->faker->word,
            'entity_eavable_id' => $entitableId = 1,

            'attribute_id' => $attributeId = factory(Attribute::class)->create()->id,

            'value_eavable_type' => $valuableType = $this->faker->word,
            'value_eavable_id' => $valuableId = 1,
        ]);

        $this->assertEquals($entitableType, $eav->entity_eavable_type);
        $this->assertEquals($entitableId, $eav->entity_eavable_id);

        $this->assertEquals($attributeId, $eav->attribute_id);

        $this->assertEquals($valuableType, $eav->value_eavable_type);
        $this->assertEquals($valuableId, $eav->value_eavable_id);
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
     public function eav_has_entity_eavable_relation()
     {
         $eav = factory(EAV::class)->create();

         $this->assertInstanceOf($eav->entity_eavable_type, $eav->entity_eavable);
     }

     /** @test */
     public function eav_has_attribute_relation()
     {
         $eav = factory(EAV::class)->create();

         $this->assertInstanceOf(Attribute::class, $eav->attribute);
     }

     /** @test */
     public function eav_has_value_eavable_relation()
     {
        $eav = factory(EAV::class)->create();

         $this->assertInstanceOf($eav->value_eavable_type, $eav->value_eavable);
     }
}
