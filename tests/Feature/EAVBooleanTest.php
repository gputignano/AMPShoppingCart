<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\EAV;
use App\Models\EAVBoolean;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVBooleanTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavBoolean;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eavBoolean = factory(EAVBoolean::class)->create();
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_boolean_has_eav_relation()
    {
        $this->eavBoolean->eav()->save(factory(Attributable::class)->make());

        // One to One Polymorphic
        $this->assertInstanceOf(\App\Models\Attributable::class, $this->eavBoolean->eav);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->eavBoolean->eav());
    }

    /** @test */
    public function eav_boolean_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, EAVBoolean::all()->random()->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, EAVBoolean::all()->random()->attributes());
    }
}
