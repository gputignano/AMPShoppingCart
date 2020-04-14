<?php

namespace Tests\Feature;

use App\Models\AttributeSet;
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
        $attributeSet = factory(AttributeSet::class)->create();

        $response = $this->patchJson(route('attributeSets.update', $attributeSet), [
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
        $attributeSet = factory(AttributeSet::class)->create();

        $response = $this->deleteJson(route('attributeSets.destroy', $attributeSet), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
