<?php

namespace Tests\Feature;

use App\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTest extends TestCase
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
        $response = $this->postJson(route('attributes.store'), [
            'label' => $this->faker->word,
            'type' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_attribute_can_be_updated()
    {
        $response = $this->patchJson(route('attributes.update', $this->attribute), [
            'label' => $this->faker->word,
            'type' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_attribute_can_be_deleted()
    {
        $response = $this->deleteJson(route('attributes.destroy', $this->attribute), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function attribute_has_attribute_sets_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attribute->attribute_sets);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attribute->attribute_sets());
    }

    /** @test */
    public function attribute_has_eavs_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attribute->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->attribute->eavs());
    }

    /** @test */
    public function attribute_has_entity_types_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attribute->entity_types);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attribute->entity_types());
    }

    /** @test */
    public function attribute_has_values_relation()
    {
        // Many to Many polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attribute->values);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->attribute->values());
    }
}
