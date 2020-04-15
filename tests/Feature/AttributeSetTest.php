<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Product;
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
    public function label_is_required_when_creating_a_new_attribute_set()
    {
        $response = $this->postJson(route('attributeSets.store'), [
            //'
        ]);

        $response->assertJsonValidationErrors('label');
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
    public function label_is_required_when_updating_a_new_attribute_set()
    {
        $response = $this->patchJson(route('attributeSets.update', $this->attributeSet), [
            //'
        ]);

        $response->assertJsonValidationErrors('label');
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

    /** @test */
    public function when_an_attribute_set_is_deleted_attributes_relation_is_updated()
    {
        $attribute = $this->attributeSet->attributes()->save(factory(Attribute::class)->make());

        $this->deleteJson(route('attributeSets.destroy', $this->attributeSet), [
            //
        ]);

        $this->assertDeleted($this->attributeSet);
        $this->assertDatabaseHas('attributes', [
            'id' => $attribute->id,
        ]);
        $this->assertDatabaseMissing('attribute_attribute_set', [
            'attribute_id' => $attribute->id,
            'attribute_set_id' => $this->attributeSet->is,
        ]);
    }

    /** @test */
    public function when_an_attribute_set_is_deleted_products_relation_is_updated()
    {
        $product = $this->attributeSet->products()->save(factory(Product::class)->make());

        $this->deleteJson(route('attributeSets.destroy', $this->attributeSet), [
            //
        ]);

        $this->assertDeleted($this->attributeSet);
        $this->assertDatabaseHas('entities', [
            'id' => $product->id,
        ]);
        $this->assertDatabaseMissing('attribute_set_product', [
            'attribute_set_id' => $this->attributeSet->id,
            'product_id' => $product->id,
        ]);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function attribute_set_has_attributes_relation()
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
