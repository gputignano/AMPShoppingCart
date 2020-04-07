<?php

namespace Tests\Unit;

use App\EAVDecimal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVDecimalModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavDecimal;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavDecimal = factory(EAVDecimal::class)->create();
    }

    /** @test */
    public function an_eav_decimal_can_be_created()
    {
        $this->assertCount(1, EAVDecimal::all());
        $this->assertInstanceOf(EAVDecimal::class, $this->eavDecimal);
    }

    /** @test */
    public function an_eav_decimal_can_be_updated()
    {
        $this->eavDecimal->update([
            'value' => $value = $this->faker->word,
        ]);

        $this->assertEquals($value, $this->eavDecimal->value);
    }

    /** @test */
    public function an_eav_decimal_can_be_deleted()
    {
        $this->eavDecimal->delete();

        $this->assertDeleted($this->eavDecimal);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_decimal_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavDecimal->eavs());
    }

    /** @test */
    public function eav_decimal_has_attribute_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavDecimal->attribute());
    }
}
