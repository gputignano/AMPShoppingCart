<?php

namespace Tests\Feature;

use App\Models\EAVText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVTextTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_text_can_be_created()
    {
        $response = $this->postJson(route('eavTexts.store'), [
            'value' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_text_can_be_updated()
    {
        $eavText = factory(EAVText::class)->create();

        $response = $this->patchJson(route('eavTexts.update', $eavText), [
            'value' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_text_can_be_deleted()
    {
        $eavText = factory(EAVText::class)->create();

        $response = $this->deleteJson(route('eavTexts.destroy', $eavText), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
