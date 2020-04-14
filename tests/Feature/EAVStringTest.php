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

    protected $eavString;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavString = factory(EAVString::class)->create();
    }

    /** @test */
    public function an_eav_string_can_be_created()
    {
        $response = $this->postJson(route('eavStrings.store'), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_string_can_be_updated()
    {
        $response = $this->patchJson(route('eavStrings.update', $this->eavString), [
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
        $response = $this->deleteJson(route('eavStrings.destroy', $this->eavString), [
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
    public function eav_string_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavString->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavString->eavs());
    }

    /** @test */
    public function eav_string_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavString->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavString->attributes());
    }
}
