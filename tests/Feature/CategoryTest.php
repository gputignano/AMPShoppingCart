<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->category = factory(Category::class)->create();

        $this->category->rewrite()->save(factory(Rewrite::class)->make());
    }

    /** @test */
    public function a_user_can_view_category_index()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.category.index');

        $response->assertSee('<h1>All Categories</h1>', false);
    }

    /** @test */
    public function a_user_can_view_category_create()
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.category.create');

        $response->assertSee('<h1>Create Category</h1>', false);
    }

    /** @test */
    public function a_user_can_view_category_edit()
    {
        $response = $this->get(route('admin.categories.edit', $this->category));

        $response->assertStatus(200);

        $response->assertViewIs('admin.category.edit');

        $response->assertSee('<h1>Edit ' . e($this->category->name) . '</h1>', false);
    }

    /** @test */
    public function a_category_can_be_created()
    {
        $response = $this->postJson(route('admin.categories.store'), [
            'parent_id' => '',
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_creating_a_new_category()
    {
        $response = $this->postJson(route('admin.categories.store'), [
            'parent_id' => '',
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'name',
                    'message' => ['The name field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $response = $this->patchJson(route('admin.categories.update', $this->category), [
            'name' => $this->faker->sentence,
            'description' => null,
            'parent_id' => null,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    // /** @test */
    // public function name_is_required_when_updating_a_category()
    // {
    //     $response = $this->patchJson(route('admin.categories.update', $this->category), [
    //         'parent_id' => '',
    //         // 'name' => $this->faker->sentence,
    //     ]);

    //     $response->assertExactJson([
    //         'errors' => [
    //             [
    //                 'name' => 'name',
    //                 'message' => ['The name field is required.'],
    //             ],
    //         ]
    //     ]);
    // }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.categories.destroy', $this->category), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_a_category_is_deleted_products_relation_is_detached()
    {
        $product = $this->category->products()->save(factory(Product::class)->make());

        $this->category->delete();

        $this->assertNotNull($product->fresh());

        $this->assertCount(0, $this->category->products);
    }

    /** @test */
    public function when_a_category_is_deleted_rewrite_is_deleted()
    {
        $rewrite = $this->category->rewrite()->save(factory(Rewrite::class)->make());

        $this->category->delete();

        $this->assertDeleted($this->category);

        $this->assertDeleted($rewrite);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function category_has_products_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->category->products);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->category->products());
    }

    /** @test */
    public function category_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Rewrite::class, $this->category->rewrite);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->category->rewrite());
    }
}
