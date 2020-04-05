<?php

namespace Tests\Unit;

use App\EAV;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eav;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eav = factory(EAV::class)->create();
    }

    /** @test */
    public function an_eav_can_be_created()
    {
        $this->assertCount(1, EAV::all());
        $this->assertInstanceOf(EAV::class, $this->eav);
    }

    /** @test */
    public function an_eav_can_be_updated()
    {
        $valuable = factory($this->eav->value_eavable_type)->create();

        // Can be updated only the id, the type doesn't change
        $updated = $this->eav->update([
            'value_eavable_id' => $valuable->id,
        ]);

        $this->asserttrue($updated);

        $this->assertEquals($valuable->id, $this->eav->value_eavable_id);
    }

    /** @test */
    public function an_eav_can_be_deleted()
    {
        $this->eav->delete();

        $this->assertDeleted($this->eav);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_has_entity_eavable_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $this->eav->entity_eavable());
    }

    /** @test */
    public function eav_has_attribute_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->eav->attribute());
    }

    /** @test */
    public function eav_has_value_eavable_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $this->eav->value_eavable());
    }
}
