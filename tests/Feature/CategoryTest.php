<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\EAV;
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

        $this->category = factory(Category::class)->create([
            'parent_id' => factory(Category::class)->create(),
        ]);

        $this->category->rewrite()->save(factory(Rewrite::class)->make());
    }

    /** @test */
    public function a_category_can_be_created()
    {
        $response = $this->postJson(route('categories.store'), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_creating_a_new_category()
    {
        $response = $this->postJson(route('categories.store'), [
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $response = $this->patchJson(route('categories.update', $this->category), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_updating_a_category()
    {
        $response = $this->patchJson(route('categories.update', $this->category), [
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $response = $this->deleteJson(route('categories.destroy', $this->category), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_a_parent_category_is_deleted_children_is_deleted()
    {
        $children = $this->category->children()->save(factory(Category::class)->make());

        $this->category->delete();

        $this->assertDeleted($this->category);

        $this->assertDeleted($children);
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
    public function when_a_category_is_deleted_eavs_is_deleted()
    {
        $eav = $this->category->eavs()->save(factory(EAV::class)->make());

        $this->category->delete();

        $this->assertDeleted($this->category);

        $this->assertDeleted($eav);
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
    public function category_has_parent_relation()
    {
        // Many to One
        $this->assertInstanceOf(Category::class, $this->category->parent);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->category->parent());
    }

    /** @test */
    public function category_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->category->children);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->category->children());
    }

    /** @test */
    public function category_has_products_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->category->products);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->category->products());
    }

    /** @test */
    public function page_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->category->eavs);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->category->eavs());
    }

    /** @test */
    public function category_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Rewrite::class, $this->category->rewrite);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->category->rewrite());
    }
}
