<?php

namespace Tests\Feature;

use App\Models\AttributeSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeSetTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attributeSet;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->attributeSet = factory(AttributeSet::class)->create();
    }

    /** @test */
    public function a_user_can_view_attribute_set_index()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('admin.attributeSets.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attributeSet.index');

        $response->assertSee('<h1>All Attribute Sets</h1>', false);
    }

    /** @test */
    public function a_user_can_view_attribute_set_create()
    {
        $response = $this->get(route('admin.attributeSets.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attributeSet.create');

        $response->assertSee('<h1>Create Attribute Set</h1>', false);
    }

    /** @test */
    public function a_user_can_view_attribute_set_edit()
    {
        $response = $this->get(route('admin.attributeSets.edit', $this->attributeSet));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attributeSet.edit');

        $response->assertSee('<h1>Edit Attribute Set</h1>', false);
    }

    /** @test */
    public function an_attribute_set_can_be_created()
    {
        $response = $this->postJson(route('admin.attributeSets.store'), [
            'label' => $label = $this->faker->unique()->word,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function label_is_required_when_creating_a_new_attribute_set()
    {
        $response = $this->postJson(route('admin.attributeSets.store'), [
            // 'label' => $this->faker->word,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'label',
                    'message' => ['The label field is required.'],
                ],
            ],
        ]);
    }

    /** @test */
    public function label_must_be_unique_when_creating_a_new_attribute_set()
    {
        $response = $this->postJson(route('admin.attributeSets.store'), [
            'label' => $this->attributeSet->label,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'label',
                    'message' => ['The label has already been taken.'],
                ],
            ],
        ]);
    }

    /** @test */
    public function an_attribute_set_can_be_updated()
    {
        $response = $this->patchJson(route('admin.attributeSets.update', $this->attributeSet), [
            'label' => $this->faker->unique()->word,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    // public function label_is_required_when_updating_a_new_attribute_set()
    // {
    //     $response = $this->patchJson(route('admin.attributeSets.update', $this->attributeSet), [
    //         // 'label' => $this->faker->unique()->word,
    //     ]);

    //     $response->assertExactJson([
    //         'errors' => [
    //             [
    //                 'name' => 'label',
    //                 'message' => ['The label field is required.'],
    //             ],
    //         ]
    //     ]);
    // }

    /** @test */
    public function label_must_be_unique_when_updaing_a_new_attribute_set()
    {
        $new_attribute_set = factory(AttributeSet::class)->create();

        $response = $this->patchJson(route('admin.attributeSets.update', $new_attribute_set), [
            'label' => $this->attributeSet->label,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'label',
                    'message' => ['The label has already been taken.'],
                ],
            ],
        ]);
    }

    /** @test */
    public function an_attribute_set_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.attributeSets.destroy', $this->attributeSet), [
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
    public function attribute_set_has_attributes_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attributeSet->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attributeSet->attributes());
    }
}
