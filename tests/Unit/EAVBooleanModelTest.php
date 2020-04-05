<?php

namespace Tests\Unit;

use App\EAVBoolean;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVBooleanModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavBoolean;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavBoolean = factory(EAVBoolean::class)->create();
    }

    /** @test */
    public function an_eav_boolean_can_be_created()
    {
        $this->assertCount(1, EAVBoolean::all());
        $this->assertInstanceOf(EAVBoolean::class, $this->eavBoolean);
    }

    /** @test */
    public function an_eav_boolean_can_be_updated()
    {
        $this->eavBoolean->update([
            'value' => $value = $this->faker->boolean(50),
        ]);

        $this->assertEquals($value, $this->eavBoolean->value);
    }

    /** @test */
    public function an_eav_boolean_can_be_deleted()
    {
        $this->eavBoolean->delete();

        $this->assertDeleted($this->eavBoolean);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_boolean_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavBoolean->eavs());
    }
}
