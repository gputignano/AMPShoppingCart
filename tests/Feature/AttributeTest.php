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
        $attribute = factory(Attribute::class)->create();

        $response = $this->patchJson(route('attributes.update', $attribute), [
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
        $attribute = factory(Attribute::class)->create();

        $response = $this->deleteJson(route('attributes.destroy', $attribute), [
            //
        ]);
       

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
