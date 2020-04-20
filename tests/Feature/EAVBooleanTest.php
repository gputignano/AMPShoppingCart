<?php

namespace Tests\Feature;

use App\Models\EAV;
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
    public function a_user_can_view_eav_boolean_index()
    {
        $response = $this->get(route('admin.eavBooleans.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavBoolean.index');
    }

    /** @test */
    public function a_user_can_view_eav_boolean_create()
    {
        $response = $this->get(route('admin.eavBooleans.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavBoolean.create');
    }

    /** @test */
    public function a_user_can_view_eav_boolean_show()
    {
        $response = $this->get(route('admin.eavBooleans.show', $this->eavBoolean));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavBoolean.show');
    }

    /** @test */
    public function a_user_can_view_eav_boolean_edit()
    {
        $response = $this->get(route('admin.eavBooleans.edit', $this->eavBoolean));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavBoolean.edit');
    }

    /** @test */
    public function an_eav_boolean_can_be_created()
    {
        $response = $this->postJson(route('admin.eavBooleans.store'), [
            'value' => $this->faker->boolean(50),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_creating_a_new_eav_boolean()
    {
        $response = $this->postJson(route('admin.eavBooleans.store'), [
            // 'value' => $this->faker->boolean(50),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'value',
                    'message' => ['The value field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_eav_boolean_can_be_updated()
    {
        $response = $this->patchJson(route('admin.eavBooleans.update', $this->eavBoolean), [
            'value' => $this->faker->boolean(50),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_updating_a_new_eav_boolean()
    {
        $response = $this->patchJson(route('admin.eavBooleans.update', $this->eavBoolean), [
            // 'value' => $this->faker->boolean(50),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'value',
                    'message' => ['The value field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_eav_boolean_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.eavBooleans.destroy', $this->eavBoolean), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_eav_boolean_is_deleted_eavs_is_deleted()
    {
        $eav = $this->eavBoolean->eavs()->save(factory(EAV::class)->make());

        $this->eavBoolean->delete();

        $this->assertDeleted($this->eavBoolean);

        $this->assertDeleted($eav);
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
