<?php

namespace Tests\Feature;

use App\Models\Attribute;
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

        $this->entityType = factory(EntityType::class)->create();
    }

    /** @test */
    public function an_entity_type_can_be_created()
    {
        $response = $this->postJson(route('admin.entityTypes.store'), [
            'label' => $this->faker->word,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function label_is_required_when_creating_a_new_entity_type()
    {
        $response = $this->postJson(route('admin.entityTypes.store'), [
            //'
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'label',
                    'message' => ['The label field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_entity_type_can_be_updated()
    {
        $response = $this->patchJson(route('admin.entityTypes.update', $this->entityType), [
            'label' => $this->faker->word,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function label_is_required_when_updating_a_new_entity_type()
    {
        $response = $this->patchJson(route('admin.entityTypes.update', $this->entityType), [
            //'
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'label',
                    'message' => ['The label field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_entity_type_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.entityTypes.destroy', $this->entityType), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_entity_type_is_deleted_attributes_relation_is_updated()
    {
        $attribute = $this->entityType->attributes()->save(factory(Attribute::class)->make());

        $this->entityType->delete();

        $this->assertDeleted($this->entityType);

        $this->assertNotNull($attribute->fresh());

        $this->assertCount(0, $this->entityType->attributes);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function entity_type_has_attributes_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->entityType->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->entityType->attributes());
    }
}
