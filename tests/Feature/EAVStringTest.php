<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\EAVString;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVStringTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavString;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eavString = factory(EAVString::class)->create();
    }

    /** @test */
    public function when_an_eav_string_is_deleted_attributable_relation_is_updated()
    {
        $attributable = $this->eavString->attributable()->save(factory(Attributable::class)->make());

        $this->eavString->delete();

        $this->assertDeleted($this->eavString);

        $this->assertDeleted($attributable);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_string_has_attributable_relation()
    {
        $this->eavString->attributable()->save(factory(Attributable::class)->make());

        // One to One Polymorphic
        $this->assertInstanceOf(\App\Models\Attributable::class, $this->eavString->attributable);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->eavString->attributable());
    }

    /** @test */
    public function eav_string_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavString->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavString->attributes());
    }
}
