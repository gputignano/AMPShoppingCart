<?php

namespace Tests\Feature;

use App\Models\EAVInteger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVIntegerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_integer_can_be_created()
    {
        $eavInteger = factory(EAVInteger::class)->create();

        $response = $this->postJson(route('eavIntegers.store'), [
            'value' => $this->faker->randomDigit,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_integer_can_be_updated()
    {
        $eavInteger = factory(EAVInteger::class)->create();

        $response = $this->patchJson(route('eavIntegers.update', $eavInteger), [
            'value' => $this->faker->randomDigit,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_integer_can_be_deleted()
    {
        $eavInteger = factory(EAVInteger::class)->create();

        $response = $this->deleteJson(route('eavIntegers.destroy', $eavInteger), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
