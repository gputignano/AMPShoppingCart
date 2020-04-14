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

    protected $eavDecimal;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavDecimal = factory(EAVDecimal::class)->create();
    }

    /** @test */
    public function an_eav_decimal_can_be_created()
    {
        $response = $this->postJson(route('eavDecimals.store'), [
            'value' => $this->faker->randomFloat(5, 10, 100),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_decimal_can_be_updated()
    {
        $response = $this->patchJson(route('eavDecimals.update', $this->eavDecimal), [
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
        $response = $this->deleteJson(route('eavDecimals.destroy', $this->eavDecimal), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_decimal_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavDecimal->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavDecimal->eavs());
    }

    /** @test */
    public function eav_decimal_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavDecimal->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavDecimal->attributes());
    }
}
