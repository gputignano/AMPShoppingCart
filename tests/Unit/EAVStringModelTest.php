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

    /** @test */
    public function an_eav_string_can_be_created()
    {
        $this->assertCount(0, EAVString::all());

        $eavString = factory(EAVString::class)->create();

        $this->assertCount(1, EAVString::all());
    }

    /** @test */
    public function an_eav_string_can_be_updated()
    {
        $eavString = factory(EAVString::class)->create();

        $eavString->update([
            'value' => $value = $this->faker->word,
        ]);

        $this->assertEquals($value, $eavString->value);
    }

    /** @test */
    public function an_eav_string_can_be_deleted()
    {
        $eavString = factory(EAVString::class)->create();

        $eavString->delete();

        $this->assertCount(0, EAVString::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_string_has_eavs_relation()
    {
        // Many to One
        $eavString = factory(EAVString::class)->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $eavString->eavs);
    }
}
