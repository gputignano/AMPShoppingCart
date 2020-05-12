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

        $this->value = factory($this->attribute->type)->create();
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
