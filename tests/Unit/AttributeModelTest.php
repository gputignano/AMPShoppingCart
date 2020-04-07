<?php

namespace Tests\Unit;

use App\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attribute;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attribute = factory(Attribute::class)->create();
    }

    /** @test */
    public function an_attribute_can_be_created()
    {
        $this->assertCount(1, Attribute::all());
        $this->assertInstanceOf(Attribute::class, $this->attribute);
    }

    /** @test */
    public function an_attribute_can_be_updated()
    {
        $updated = $this->attribute->update([
            'label' => $label = $this->faker->word,
            'type' => $type = $this->faker->word,
        ]);

        $this->assertTrue($updated);
        $this->assertEquals($label, $this->attribute->label);
        $this->assertEquals($type, $this->attribute->type);
    }

    /** @test */
    public function an_attribute_can_be_deleted()
    {
        $this->attribute->delete();

        $this->assertDeleted($this->attribute);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function attribute_has_attribute_sets_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attribute->attribute_sets());
    }

    /** @test */
    public function attribute_has_eavs_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->attribute->eavs());
    }

    /** @test */
    public function attribute_has_values_relation()
    {
        // Many to Many polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->attribute->values());
    }
}
