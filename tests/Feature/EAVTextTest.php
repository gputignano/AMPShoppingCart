<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\EAVText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVTextTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavText;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eavText = factory(EAVText::class)->create();
    }

    /** @test */
    public function when_an_eav_text_is_deleted_attributable_relation_is_updated()
    {
        $attributable = $this->eavText->attributable()->save(factory(Attributable::class)->make());

        $this->eavText->delete();

        $this->assertDeleted($this->eavText);

        $this->assertDeleted($attributable);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_text_has_attributable_relation()
    {
        $this->eavText->attributable()->save(factory(Attributable::class)->make());

        // One to One Polymorphic
        $this->assertInstanceOf(\App\Models\Attributable::class, $this->eavText->attributable);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->eavText->attributable());
    }

    /** @test */
    public function eav_text_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavText->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavText->attributes());
    }
}
