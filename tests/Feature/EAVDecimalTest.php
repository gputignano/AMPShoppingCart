<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\EAV;
use App\Models\EAVDecimal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVDecimalTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavDecimal;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eavDecimal = factory(EAVDecimal::class)->create();
    }

    /** @test */
    public function when_an_eav_decimal_is_deleted_attributable_relation_is_updated()
    {
        $attributable = $this->eavDecimal->attributable()->save(factory(Attributable::class)->make());

        $this->eavDecimal->delete();

        $this->assertDeleted($this->eavDecimal);

        $this->assertDeleted($attributable);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_decimal_has_attributable_relation()
    {
        $this->eavDecimal->attributable()->save(factory(Attributable::class)->make());

        // One to One Polymorphic
        $this->assertInstanceOf(\App\Models\Attributable::class, $this->eavDecimal->attributable);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->eavDecimal->attributable());
    }

    /** @test */
    public function eav_decimal_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavDecimal->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavDecimal->attributes());
    }
}
