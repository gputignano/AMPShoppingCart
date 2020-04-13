<?php

namespace Tests\Feature;

use App\Models\EAVDecimal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVDecimalTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_decimal_can_be_created()
    {
        $response = $this->postJson(route('eavDecimals.store'), [
            'value' => $this->faker->randomFloat(5, 10, 100),
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_decimal_can_be_updated()
    {
        $eavDecimal = factory(EAVDecimal::class)->create();

        $response = $this->patchJson(route('eavDecimals.update', $eavDecimal), [
            'value' => $this->faker->randomFloat(5, 10, 100),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_decimal_can_be_deleted()
    {
        $eavDecimal = factory(EAVDecimal::class)->create();

        $response = $this->deleteJson(route('eavDecimals.destroy', $eavDecimal), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
