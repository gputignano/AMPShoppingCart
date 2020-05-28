<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\EAVInteger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVIntegerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavInteger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eavInteger = factory(EAVInteger::class)->create();
    }

    /** @test */
    public function when_an_eav_integer_is_deleted_attributable_relation_is_updated()
    {
        $attributable = $this->eavInteger->attributable()->save(factory(Attributable::class)->make());

        $this->eavInteger->delete();

        $this->assertDeleted($this->eavInteger);

        $this->assertDeleted($attributable);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_integer_has_attributable_relation()
    {
        $this->eavInteger->attributable()->save(factory(Attributable::class)->make());

        // One to One Polymorphic
        $this->assertInstanceOf(\App\Models\Attributable::class, $this->eavInteger->attributable);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->eavInteger->attributable());
    }

    /** @test */
    public function eav_integer_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavInteger->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavInteger->attributes());
    }
}
