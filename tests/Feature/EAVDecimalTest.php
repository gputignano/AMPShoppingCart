<?php

namespace Tests\Feature;

use App\Models\EAV;
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
    public function a_user_can_view_eav_decimal_index()
    {
        $response = $this->get(route('admin.eavDecimals.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavDecimal.index');
    }

    /** @test */
    public function a_user_can_view_eav_decimal_create()
    {
        $response = $this->get(route('admin.eavDecimals.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavDecimal.create');
    }

    /** @test */
    public function a_user_can_view_eav_decimal_show()
    {
        $response = $this->get(route('admin.eavDecimals.show', $this->eavDecimal));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavDecimal.show');
    }

    /** @test */
    public function a_user_can_view_eav_decimal_edit()
    {
        $response = $this->get(route('admin.eavDecimals.edit', $this->eavDecimal));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavDecimal.edit');
    }

    /** @test */
    public function an_eav_decimal_can_be_created()
    {
        $response = $this->postJson(route('admin.eavDecimals.store'), [
            'value' => $this->faker->randomFloat(5, 10, 100),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_creating_a_new_eav_decimal()
    {
        $response = $this->postJson(route('admin.eavDecimals.store'), [
            // 'value' => $this->faker->randomFloat(5, 10, 100),
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
    public function an_eav_decimal_can_be_updated()
    {
        $response = $this->patchJson(route('admin.eavDecimals.update', $this->eavDecimal), [
            'value' => $this->faker->randomFloat(5, 10, 100),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_updating_a_new_eav_decimal()
    {
        $response = $this->patchJson(route('admin.eavDecimals.update', $this->eavDecimal), [
            // 'value' => $this->faker->randomFloat(5, 10, 100),
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
    public function an_eav_decimal_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.eavDecimals.destroy', $this->eavDecimal), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_eav_decimal_is_deleted_eavs_relation_is_updated()
    {
        $eav = $this->eavDecimal->eavs()->save(factory(EAV::class)->make());

        $this->eavDecimal->delete();

        $this->assertDeleted($this->eavDecimal);

        $this->assertDeleted($eav);
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
