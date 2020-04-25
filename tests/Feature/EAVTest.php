<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\EAV;
use App\Models\EAVBoolean;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eav;
    protected $entity;
    protected $attribute;
    protected $value;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eav = factory(EAV::class)->create();

        $this->entity = factory(Entity::class)->create();

        $this->attribute = factory(Attribute::class)->create();

        $this->value = ($this->attribute->type == 'App\Models\EAVBoolean') ? EAVBoolean::all()->random() : factory($this->attribute->type)->create();
    }

    /** @test */
    public function an_eav_can_be_created()
    {
        $response = $this->postJson(route('admin.eavs.store'), [
            'entity_id' => $this->entity->id,
            'attribute_id' => $this->attribute->id,
            'value_type' => get_class($this->value),
            'value_id' => $this->value->id,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_can_be_updated()
    {
        $response = $this->patchJson(route('admin.eavs.update', $this->eav), [
            'entity_id' => $this->entity->id,
            'attribute_id' => $this->attribute->id,
            'value_type' => get_class($this->value),
            'value_id' => $this->value->id,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.eavs.destroy', $this->eav), [
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
    public function eav_has_entity_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Entity::class, $this->eav->entity);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->eav->entity());
    }

    /** @test */
    public function eav_has_attribute_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Attribute::class, $this->eav->attribute);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->eav->attribute());
    }

    /** @test */
    public function eav_has_value_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Model::class, $this->eav->value);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $this->eav->value());
    }
}
