<?php

namespace Tests\Feature;

use App\Models\EAVBoolean;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVBooleanTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_boolean_can_be_created()
    {
        $response = $this->postJson(route('eavBooleans.store'), [
            'value' => $this->faker->boolean(50),
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_boolean_can_be_updated()
    {
        $eavBoolean = factory(EAVBoolean::class)->create();

        $response = $this->patchJson(route('eavBooleans.update', $eavBoolean), [
            'value' => $this->faker->boolean(50),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_boolean_can_be_deleted()
    {
        $eavBoolean = factory(EAVBoolean::class)->create();

        $response = $this->deleteJson(route('eavBooleans.destroy', $eavBoolean), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
