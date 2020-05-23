<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\BaseEntity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BaseEntityTest extends TestCase
{
    use RefreshDatabase;

    protected $baseEntity;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->baseEntity = factory(BaseEntity::class)->create();
    }

    /**
     * @test
     *
     * @return void
     */
    /** @test */
    public function when_an_entity_is_deleted_attributable_is_deleted()
    {
        $this->baseEntity->attributes()->attach(factory(Attribute::class)->create());

        $this->baseEntity->delete();

        $this->assertDeleted($this->baseEntity);

        $this->assertCount(0, $this->baseEntity->attributes);
    }
}
