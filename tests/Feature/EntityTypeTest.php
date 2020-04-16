<?php

namespace Tests\Feature;

use App\Models\EntityType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntityTypeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $entityTpe;

    protected function setUp(): void
    {
        parent::setUp();

        $this->entityTpe = factory(EntityType::class)->create();
    }

    /** @test */
    public function an_entity_type_can_be_created()
    {
        $response = $this->postJson(route('entityTypes.store'), [
            'label' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_entity_type_can_be_updated()
    {
        $response = $this->patchJson(route('entityTypes.update', $this->entityTpe), [
            'label' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_entity_type_can_be_deleted()
    {
        $response = $this->deleteJson(route('entityTypes.destroy', $this->entityTpe), [
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
    public function entity_type_has_attributes_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->entityTpe->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->entityTpe->attributes());
    }
}
