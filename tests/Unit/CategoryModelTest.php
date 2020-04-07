<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = factory(Category::class)->create();
    }

    /** @test */
    public function a_category_can_be_created()
    {
        $this->assertCount(1, Category::all());
        $this->assertInstanceOf(Category::class, $this->category);
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $update = $this->category->update([
            'parent_id' => factory(Category::class)->create(),
            'name' => $name = $this->faker->word,
        ]);

        $this->assertTrue($update);
        $this->assertEquals($name, $this->category->name);
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $this->category->delete();

        $this->assertDeleted($this->category);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function category_has_parent_relation()
    {
        // Many to One
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->category->parent());
    }

    /** @test */
    public function category_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->category->children());
    }

    /** @test */
    public function category_has_products_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->category->products());
    }

    /** @test */
    public function page_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->category->eavs());
    }

    /** @test */
    public function category_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->category->rewrite());
    }
}
