<?php

namespace Tests\Unit;

use App\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTest extends TestCase
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
}
