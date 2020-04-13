<?php

namespace Tests\Feature;

use App\Models\EAVString;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVStringTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_string_can_be_created()
    {
        $response = $this->postJson(route('eavStrings.store'), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_string_can_be_updated()
    {
        $eavString = factory(EAVString::class)->create();

        $response = $this->patchJson(route('eavStrings.update', $eavString), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_string_can_be_deleted()
    {
        $eavString = factory(EAVString::class)->create();

        $response = $this->deleteJson(route('eavStrings.destroy', $eavString), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
