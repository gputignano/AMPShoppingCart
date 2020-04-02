<?php

namespace Tests\Unit;

use App\Category;
use App\Product;
use App\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_category_can_be_created()
    {
        $this->assertCount(0, Category::all());

        $category = factory(Category::class)->create();

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = factory(Category::class)->create();

        $category->update([
            'category_id' => factory(Category::class)->create(),
            'name' => $name = $this->faker->word,
        ]);

        $this->assertEquals($name, $category->name);
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();

        $category->delete();

        $this->assertCount(0, Category::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function category_has_parent_relation()
    {
        // Many to One
        $children = factory(Category::class)->create([
            'category_id' => factory(Category::class)->create(),
        ]);

        $this->assertCount(2, Category::all());
        $this->assertInstanceOf(Category::class, $children->parent);
    }

    /** @test */
    public function category_has_children_relation()
    {
        // One to Many
        $product = factory(Category::class)->create()->children()->save(factory(Category::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $product->children);
    }

    /** @test */
    public function category_has_products_relation()
    {
        // Many to Many
        $category = factory(Category::class)->create();
        $category->products()->save(factory(Product::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $category->products);
    }

    /** @test */
    public function category_has_rewrite_relation()
    {
        $page = factory(Category::class)->create();
        $page->rewrite()->save(factory(Rewrite::class)->make());

        $this->assertInstanceOf(Rewrite::class, $page->rewrite);
    }
}
