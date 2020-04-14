<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\AttributeSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeSetTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $attributeSet;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributeSet = factory(AttributeSet::class)->create();
    }

    /** @test */
    public function an_attribute_set_can_be_created()
    {
        $response = $this->postJson(route('attributeSets.store'), [
            'label' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_attribute_set_can_be_updated()
    {
        $response = $this->patchJson(route('attributeSets.update', $this->attributeSet), [
            'label' => $this->faker->safeEmail,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_attribute_set_can_be_deleted()
    {
        $response = $this->deleteJson(route('attributeSets.destroy', $this->attributeSet), [
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
    public function attribute_set_has_attribute_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attributeSet->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attributeSet->attributes());
    }

    /** @test */
    public function attribute_set_has_products_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attributeSet->products);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attributeSet->products());
    }
}
