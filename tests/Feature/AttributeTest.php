<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\EAV;
use App\Models\EntityType;
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
    public function label_is_required_when_creating_a_new_attribute()
    {
        $response = $this->postJson(route('attributes.store'), [
            'type' => $this->faker->word,
        ]);

        $response->assertJsonValidationErrors('label');
    }

    /** @test */
    public function type_is_required_when_creating_a_new_attribute()
    {
        $response = $this->postJson(route('attributes.store'), [
            'label' => $this->faker->word,
        ]);

        $response->assertJsonValidationErrors('type');
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
    public function label_is_required_when_updating_a_new_attribute()
    {
        $response = $this->patchJson(route('attributes.update', $this->attribute), [
            'type' => $this->faker->word,
        ]);

        $response->assertJsonValidationErrors('label');
    }

    /** @test */
    public function type_is_required_when_updating_a_new_attribute()
    {
        $response = $this->patchJson(route('attributes.update', $this->attribute), [
            'label' => $this->faker->word,
        ]);

        $response->assertJsonValidationErrors('type');
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

    /** @test */
    public function when_an_attribute_is_deleted_attribute_sets_relation_is_updated()
    {
        $attributeSet = $this->attribute->attribute_sets()->save(factory(AttributeSet::class)->make());

        $this->deleteJson(route('attributes.destroy', $this->attribute), [
            //
        ]);

        $this->assertDeleted($this->attribute);
        $this->assertDatabaseHas('attribute_sets', [
            'id' => $attributeSet->id,
        ]);
        $this->assertDatabaseMissing('attribute_attribute_set', [
            'attribute_id' => $this->attribute->id,
            'attribute_set_id' => $attributeSet->id,
        ]);
    }

    /** @test */
    public function when_an_attribute_is_deleted_eavs_relation_is_updated()
    {
        $eav = factory(EAV::class)->create([
            'attribute_id' => $this->attribute,
        ]);

        $this->deleteJson(route('attributes.destroy', $this->attribute), [
            //
        ]);

        $this->assertDeleted($this->attribute);
        $this->assertDeleted($eav);
    }

    /** @test */
    public function when_an_attribute_is_deleted_entity_types_relation_is_updated()
    {
        $entityTypes = $this->attribute->entity_types()->save(factory(EntityType::class)->make());

        $this->deleteJson(route('attributes.destroy', $this->attribute), [
            //
        ]);

        $this->assertDeleted($this->attribute);
        $this->assertDatabaseHas('entity_types', [
            'id' => $entityTypes->id,
        ]);
        $this->assertDatabaseMissing('attribute_entity_type', [
            'attribute_id' => $this->attribute->id,
            'entity_type_id' => $entityTypes->id,
        ]);
    }

    /** @test */
    public function when_an_attribute_is_deleted_values_relation_is_updated()
    {
        $value = $this->attribute->values()->save(factory($this->attribute->type)->make());

        $this->deleteJson(route('attributes.destroy', $this->attribute), [
            //
        ]);

        $this->assertDeleted($this->attribute);
        $this->assertDatabaseHas($value->getTable(), [
            'value' => $value->value,
        ]);
        $this->assertDatabaseMissing('attribute_value', [
            'attribute_id' => $this->attribute->id,
            'value_type' => get_class($value),
            'value_id' => $value->id,
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
