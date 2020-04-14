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

    protected $eavBoolean;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavBoolean = factory(EAVBoolean::class)->create();
    }

    /** @test */
    public function an_eav_boolean_can_be_created()
    {
        $response = $this->postJson(route('eavBooleans.store'), [
            'value' => $this->faker->boolean(50),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_boolean_can_be_updated()
    {
        $response = $this->patchJson(route('eavBooleans.update', $this->eavBoolean), [
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
        $response = $this->deleteJson(route('eavBooleans.destroy', $this->eavBoolean), [
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
    public function eav_boolean_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavBoolean->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavBoolean->eavs());
    }

    /** @test */
    public function eav_boolean_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavBoolean->attributes);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavBoolean->attributes());
    }
}
