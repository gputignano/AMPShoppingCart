<?php

namespace Tests\Feature;

use App\Models\EAV;
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

        $this->seed('InstallationTableSeeder');

        $this->eavString = factory(EAVString::class)->create();
    }

    /** @test */
    public function a_user_can_view_eav_string_index()
    {
        $response = $this->get(route('admin.eavStrings.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavString.index');

        $response->assertSee('<h1>All EAVStrings</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_string_create()
    {
        $response = $this->get(route('admin.eavStrings.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavString.create');

        $response->assertSee('<h1>Create EAVString</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_string_show()
    {
        $response = $this->get(route('admin.eavStrings.show', $this->eavString));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavString.show');

        $response->assertSee('<h1>Show EAVString</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_string_edit()
    {
        $response = $this->get(route('admin.eavStrings.edit', $this->eavString));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavString.edit');

        $response->assertSee('<h1>Edit EAVString</h1>', false);
    }

    /** @test */
    public function an_eav_string_can_be_created()
    {
        $response = $this->postJson(route('admin.eavStrings.store'), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_creating_a_new_eav_string()
    {
        $response = $this->postJson(route('admin.eavStrings.store'), [
            // 'value' => $this->faker->word,
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
    public function an_eav_string_can_be_updated()
    {
        $response = $this->patchJson(route('admin.eavStrings.update', $this->eavString), [
            'value' => $this->faker->word,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_updating_a_new_eav_string()
    {
        $response = $this->patchJson(route('admin.eavStrings.update', $this->eavString), [
            // 'value' => $this->faker->word,
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
    public function an_eav_string_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.eavStrings.destroy', $this->eavString), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_eav_string_is_deleted_eav_relation_is_updated()
    {
        $eav = $this->eavString->eav()->save(factory(EAV::class)->make());

        $this->eavString->delete();

        $this->assertDeleted($this->eavString);

        $this->assertDeleted($eav);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_string_has_eav_relation()
    {
        $this->eavString->eav()->save(factory(EAV::class)->make());

        // One to One Polymorphic
        $this->assertInstanceOf(\App\Models\EAV::class, $this->eavString->eav);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->eavString->eav());
    }

    /** @test */
    public function eav_string_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavString->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavString->attributes());
    }
}
