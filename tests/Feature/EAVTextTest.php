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

    protected $eavText;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavText = factory(EAVText::class)->create();
    }

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
        $response = $this->patchJson(route('eavTexts.update', $this->eavText), [
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
        $response = $this->deleteJson(route('eavTexts.destroy', $this->eavText), [
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
    public function eav_text_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavText->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavText->eavs());
    }

    /** @test */
    public function eav_text_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavText->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavText->attributes());
    }
}