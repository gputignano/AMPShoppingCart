<?php

namespace Tests\Feature;

use App\Models\EAV;
use App\Models\EAVInteger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVIntegerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavInteger;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->eavInteger = factory(EAVInteger::class)->create();
    }

    /** @test */
    public function a_user_can_view_eav_integer_index()
    {
        $response = $this->get(route('admin.eavIntegers.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavInteger.index');

        $response->assertSee('<h1>All EAVIntegers</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_integer_create()
    {
        $response = $this->get(route('admin.eavIntegers.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavInteger.create');

        $response->assertSee('<h1>Create EAVInteger</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_integer_show()
    {
        $response = $this->get(route('admin.eavIntegers.show', $this->eavInteger));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavInteger.show');

        $response->assertSee('<h1>Show EAVInteger</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_integer_edit()
    {
        $response = $this->get(route('admin.eavIntegers.edit', $this->eavInteger));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavInteger.edit');

        $response->assertSee('<h1>Edit EAVInteger</h1>', false);
    }

    /** @test */
    public function an_eav_integer_can_be_created()
    {
        $response = $this->postJson(route('admin.eavIntegers.store'), [
            'value' => $this->faker->randomDigit,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_creating_a_new_eav_integer()
    {
        $response = $this->postJson(route('admin.eavIntegers.store'), [
            // 'value' => $this->faker->randomDigit,
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
    public function an_eav_integer_can_be_updated()
    {
        $response = $this->patchJson(route('admin.eavIntegers.update', $this->eavInteger), [
            'value' => $this->faker->randomDigit,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_updating_a_new_eav_integer()
    {
        $response = $this->patchJson(route('admin.eavIntegers.update', $this->eavInteger), [
            // 'value' => $this->faker->randomDigit,
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
    public function an_eav_integer_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.eavIntegers.destroy', $this->eavInteger), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_eav_integer_is_deleted_eavs_relation_is_updated()
    {
        $eav = $this->eavInteger->eavs()->save(factory(EAV::class)->make());

        $this->eavInteger->delete();

        $this->assertDeleted($this->eavInteger);

        $this->assertDeleted($eav);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_integer_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavInteger->eavs);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavInteger->eavs());
    }

    /** @test */
    public function eav_integer_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavInteger->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavInteger->attributes());
    }
}
