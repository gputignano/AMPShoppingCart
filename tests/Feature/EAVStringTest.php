<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\EAV;
use App\Models\EAVString;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVStringTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavString;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavString = factory(EAVString::class)->create();
    }

    /** @test */
    public function an_eav_string_can_be_created()
    {
        $response = $this->postJson(route('eavStrings.store'), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_creating_a_new_eav_string()
    {
        $response = $this->postJson(route('eavStrings.store'), [
            // 'value' => $this->faker->word,
        ]);

        $response->assertJsonValidationErrors('value');
    }

    /** @test */
    public function an_eav_string_can_be_updated()
    {
        $response = $this->patchJson(route('eavStrings.update', $this->eavString), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_updating_a_new_eav_string()
    {
        $response = $this->patchJson(route('eavStrings.update', $this->eavString), [
            // 'value' => $this->faker->word,
        ]);

        $response->assertJsonValidationErrors('value');
    }

    /** @test */
    public function an_eav_string_can_be_deleted()
    {
        $response = $this->deleteJson(route('eavStrings.destroy', $this->eavString), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_eav_string_is_deleted_eavs_relation_is_updated()
    {
        $eav = factory(EAV::class)->create([
            'value_type' => get_class($this->eavString),
            'value_id' => $this->eavString->id,
        ]);

        $this->deleteJson(route('eavStrings.destroy', $this->eavString), [
            //
        ]);

        $this->assertDeleted($this->eavString);
        $this->assertDeleted($eav);
    }

    /** @test */
    public function when_an_eav_string_is_deleted_attributes_relation_is_updated()
    {
        $attribute = $this->eavString->attributes()->save(factory(Attribute::class)->make(['type' => get_class($this->eavString),]));

        $this->deleteJson(route('eavStrings.destroy', $this->eavString), [
            //
        ]);

        $this->assertDeleted($this->eavString);
        $this->assertDatabaseMissing('attribute_value', [
            'attribute_id' => $attribute->id,
            'value_type' => get_class($this->eavString),
            'value_id' => $this->eavString->id,
        ]);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_string_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavString->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavString->eavs());
    }

    /** @test */
    public function eav_string_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavString->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavString->attributes());
    }
}
