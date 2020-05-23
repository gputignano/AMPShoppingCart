<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\Attribute;
use App\Models\EntityType;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class AttributeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attribute;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->attribute = factory(Attribute::class)->create();
    }

    /** @test */
    public function a_user_can_view_attribute_index()
    {
        $response = $this->get(route('admin.attributes.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attribute.index');

        $response->assertSee('<h1>All Attributes</h1>', false);
    }

    /** @test */
    public function a_user_can_view_attribute_create()
    {
        $response = $this->get(route('admin.attributes.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attribute.create');

        $response->assertSee('<h1>Create Attribute</h1>', false);
    }

    /** @test */
    public function a_user_can_view_attribute_show()
    {
        $response = $this->get(route('admin.attributes.show', $this->attribute));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attribute.show');

        $response->assertSee('<h1>Show Attribute</h1>', false);
    }

    /** @test */
    public function a_user_can_view_attribute_edit()
    {
        $response = $this->get(route('admin.attributes.edit', $this->attribute));

        $response->assertStatus(200);

        $response->assertViewIs('admin.attribute.edit');

        $response->assertSee('<h1>Edit Attribute</h1>', false);
    }

    /** @test */
    public function an_attribute_can_be_created()
    {
        $response = $this->postJson(route('admin.attributes.store'), [
            'label' => $label = $this->faker->unique()->word,
            'code' => Str::slug($label),
            'type' => $this->faker->randomElement([
                \App\Models\EAVBoolean::class,
                \App\Models\EAVDecimal::class,
                \App\Models\EAVInteger::class,
                \App\Models\EAVString::class,
                \App\Models\EAVText::class,
            ]),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function label_is_required_when_creating_a_new_attribute()
    {
        $response = $this->postJson(route('admin.attributes.store'), [
            'type' => $this->faker->randomElement([
                \App\Models\EAVBoolean::class,
                \App\Models\EAVDecimal::class,
                \App\Models\EAVInteger::class,
                \App\Models\EAVString::class,
                \App\Models\EAVText::class,
            ]),
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
    public function label_must_be_unique_when_creating_a_new_attribute()
    {
        $response = $this->postJson(route('admin.attributes.store'), [
            'label' => $this->attribute->label,
            'type' => $this->faker->randomElement([
                \App\Models\EAVBoolean::class,
                \App\Models\EAVDecimal::class,
                \App\Models\EAVInteger::class,
                \App\Models\EAVString::class,
                \App\Models\EAVText::class,
            ]),
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
    public function type_is_required_when_creating_a_new_attribute()
    {
        $response = $this->postJson(route('admin.attributes.store'), [
            'label' => $this->faker->unique()->word,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'type',
                    'message' => ['The type field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_attribute_can_be_updated()
    {
        $response = $this->patchJson(route('admin.attributes.update', $this->attribute), [
            'label' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement([
                \App\Models\EAVBoolean::class,
                \App\Models\EAVDecimal::class,
                \App\Models\EAVInteger::class,
                \App\Models\EAVString::class,
                \App\Models\EAVText::class,
            ]),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function label_is_required_when_updating_a_new_attribute()
    {
        $response = $this->patchJson(route('admin.attributes.update', $this->attribute), [
            // 'label' => $this->faker->unique()->word,
            'type' => $this->faker->randomElement([
                \App\Models\EAVBoolean::class,
                \App\Models\EAVDecimal::class,
                \App\Models\EAVInteger::class,
                \App\Models\EAVString::class,
                \App\Models\EAVText::class,
            ]),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'label',
                    'message' => ['The label field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    // public function type_is_required_when_updating_a_new_attribute()
    // {
    //     $response = $this->patchJson(route('admin.attributes.update', $this->attribute), [
    //         'label' => $this->faker->unique()->word,
    //         // 'type' => $this->faker->word,
    //     ]);

    //     $response->assertExactJson([
    //         'errors' => [
    //             [
    //                 'name' => 'type',
    //                 'message' => ['The type field is required.'],
    //             ],
    //         ]
    //     ]);
    // }

    /** @test */
    public function an_attribute_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.attributes.destroy', $this->attribute), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_attribute_is_deleted_attributable_is_deleted()
    {
        $this->attribute->products()->attach(factory(Product::class)->create());

        $this->attribute->delete();

        $this->assertDeleted($this->attribute);

        $this->assertCount(0, $this->attribute->products);
    }

    /** @test */
    public function when_an_attribute_is_deleted_entity_types_relation_is_detached()
    {
        $entityTypes = $this->attribute->entity_types()->save(EntityType::all()->random());

        $this->attribute->delete();

        $this->assertDeleted($this->attribute);

        $this->assertNotNull($entityTypes->fresh());

        $this->assertCount(0, $this->attribute->entity_types);
    }

    /** @test */
    public function when_an_attribute_is_deleted_values_relation_is_detached()
    {
        $value = $this->attribute->values()->save(factory($this->attribute->type)->make());

        $this->attribute->delete();

        $this->assertDeleted($this->attribute);

        $this->assertNotNull($value->fresh());

        $this->assertCount(0, $this->attribute->values);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function attribute_has_entity_types_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attribute->entity_types);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->attribute->entity_types());
    }

    /** @test */
    public function attribute_has_values_relation()
    {
        // Many to Many polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->attribute->values);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->attribute->values());
    }
}
