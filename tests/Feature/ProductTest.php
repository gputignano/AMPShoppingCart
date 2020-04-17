<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\EAV;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = factory(Product::class)->create([
            'parent_id' => factory(Product::class)->create(),
        ]);

        $this->product->rewrite()->save(factory(Rewrite::class)->make());
    }

    /** @test */
    public function a_product_can_be_created()
    {
        $response = $this->postJson(route('products.store'), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_creating_a_new_product()
    {
        $response = $this->postJson(route('products.store'), [
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $response = $this->patchJson(route('products.update', $this->product), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_updating_a_new_product()
    {
        $response = $this->patchJson(route('products.update', $this->product), [
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $response = $this->deleteJson(route('products.destroy', $this->product), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_a_parent_product_is_deleted_children_relation_is_deleted()
    {
        $children = $this->product->children()->save(factory(Product::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertDeleted($children);
    }

    /** @test */
    public function when_a_product_is_deleted_eavs_relation_is_deleted()
    {
        $eav = $this->product->eavs()->save(factory(Eav::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertDeleted($eav);
    }

    /** @test */
    public function when_a_product_is_deleted_categories_relation_is_detached()
    {
        $category = $this->product->categories()->save(factory(Category::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertNotNull($category->fresh());

        $this->assertCount(0, $this->product->categories);
    }

    /** @test */
    public function when_a_product_is_deleted_rewrite_relation_is_deleted()
    {
        $rewrite = $this->product->rewrite()->save(factory(Rewrite::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertDeleted($rewrite);
    }
    
    /**
     * RELATIONS
     */

    /** @test */
    public function product_has_parent_relation()
    {
        // Many to One
        $this->assertInstanceOf(Product::class, $this->product->parent);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->product->parent());
    }

    /** @test */
    public function product_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->product->children);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->product->children());
    }

    /** @test */
    public function product_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->product->eavs);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->product->eavs());
    }

    /** @test */
    public function product_has_categories_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->product->categories);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->product->categories());
    }

    /** @test */
    public function product_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Rewrite::class, $this->product->rewrite);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->product->rewrite());
    }
}
