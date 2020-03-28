<?php

namespace Tests\Unit;

use App\AttributeSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeSetTest extends TestCase
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
}
