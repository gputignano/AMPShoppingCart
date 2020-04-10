<?php

namespace Tests\Unit;

use App\Models\AttributeSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeSetModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attributeSet;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributeSet = factory(AttributeSet::class)->create();
    }

    /** @test */
    public function an_attribute_set_can_be_created()
    {
        $this->assertCount(1, AttributeSet::all());
        $this->assertInstanceOf(AttributeSet::class, $this->attributeSet);
    }

    /** @test */
    public function an_attribute_set_can_be_updated()
    {
        $update = $this->attributeSet->update([
            'label' => $label = $this->faker->word,
        ]);

        $this->assertTrue($update);
        $this->assertEquals($label, $this->attributeSet->label);
    }

    /** @test */
    public function an_attribute_set_can_be_deleted()
    {
        $this->attributeSet->delete();

        $this->assertDeleted($this->attributeSet);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function attribute_set_has_attribute_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attributeSet->attributes());
    }

    /** @test */
    public function attribute_set_has_products_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attributeSet->products());
    }
}
