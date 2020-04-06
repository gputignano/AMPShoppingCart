<?php

namespace Tests\Unit;

use App\EAVInteger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVIntegerModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavInteger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavInteger = factory(EAVInteger::class)->create();
    }

    /** @test */
    public function an_eav_integer_can_be_created()
    {
        $this->assertCount(1, EAVInteger::all());
        $this->assertInstanceOf(EAVInteger::class, $this->eavInteger);
    }

    /** @test */
    public function an_eav_integer_can_be_updated()
    {
        $this->eavInteger->update([
            'value' => $value = $this->faker->word,
        ]);

        $this->assertEquals($value, $this->eavInteger->value);
    }

    /** @test */
    public function an_eav_integer_can_be_deleted()
    {
        $this->eavInteger->delete();

        $this->assertDeleted($this->eavInteger);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_integer_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavInteger->eavs());
    }
}
