<?php

namespace Tests\Unit;

use App\EAVString;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVStringModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavString;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavString = factory(EAVString::class)->create();
    }

    /** @test */
    public function an_eav_string_can_be_created()
    {
        $this->assertCount(1, EAVString::all());
        $this->assertInstanceOf(EAVString::class, $this->eavString);
    }

    /** @test */
    public function an_eav_string_can_be_updated()
    {
        $this->eavString->update([
            'value' => $value = $this->faker->word,
        ]);

        $this->assertEquals($value, $this->eavString->value);
    }

    /** @test */
    public function an_eav_string_can_be_deleted()
    {
        $this->eavString->delete();

        $this->assertDeleted($this->eavString);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_string_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavString->eavs());
    }
}
