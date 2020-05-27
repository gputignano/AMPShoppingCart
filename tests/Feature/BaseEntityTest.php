<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    protected $entity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->entity = factory(Entity::class)->create();
    }

    /**
     * @test
     *
     * @return void
     */
    /** @test */
    public function when_an_entity_is_deleted_attributable_is_deleted()
    {
        $this->entity->attributes()->attach(factory(Attribute::class)->create());

        $this->entity->delete();

        $this->assertDeleted($this->entity);

        $this->assertCount(0, $this->entity->attributes);
    }
}
