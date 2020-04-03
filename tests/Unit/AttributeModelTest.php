<?php

namespace Tests\Unit;

use App\Attribute;
use App\EAV;
use App\AttributeSet;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use SebastianBergmann\Type\ObjectType;
use Tests\TestCase;

class AttributeModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_attribute_can_be_created()
    {
        $this->assertCount(0, Attribute::all());

        $attribute = factory(Attribute::class)->create();

        $this->assertCount(1, Attribute::all());
    }

    /** @test */
    public function an_attribute_can_be_updated()
    {
        $attribute = factory(Attribute::class)->create();

        $attribute->update([
            'label' => $label = $this->faker->word,
            'type' => $type = $this->faker->word,
        ]);

        $this->assertEquals($label, $attribute->label);
        $this->assertEquals($type, $attribute->type);
    }

    /** @test */
    public function an_attribute_can_be_deleted()
    {
        $attribute = factory(Attribute::class)->create();

        $attribute->delete();

        $this->assertCount(0, Attribute::all());
    }

    /**
     * RELATIONS
     */

     /** @test */
     public function attribute_has_attribute_set_relation()
     {
         // Many to Many
         $attribute = factory(Attribute::class)->create();
         $attribute->attribute_sets()->save(factory(AttributeSet::class)->make());
         $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $attribute->attribute_sets);
         $this->assertCount(1, $attribute->attribute_sets()->get());
     }

    /** @test */
    public function attribute_has_eavs_relation()
    {
        $eav = factory(EAV::class)->create();
        $attribute = Attribute::find($eav->attribute_id);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $attribute->eavs);
    }

    /** @test */
    // public function attribute_has_products_relation()
    // {
    //     // I'm not sure this relation is really useful
    //     $eav = factory(EAV::class)->create();
    //     $attribute = Attribute::find($eav->attribute_id);

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $attribute->products);
    //     $this->assertCount(1, EAV::all());
    // }
}
