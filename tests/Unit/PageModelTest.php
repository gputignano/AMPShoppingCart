<?php

namespace Tests\Unit;

use App\Page;
use App\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_page_can_be_created()
    {
        $this->assertCount(0, Page::all());

        factory(Page::class)->create();

        $this->assertCount(1, Page::all());
    }

    /** @test */
    public function a_page_can_be_updated()
    {
        $page = factory(Page::class)->create();

        $page->update([
            'page_id' => factory(Page::class)->create(),
            'name' => $name = $this->faker->name,
        ]);

        $this->assertEquals($name, $page->name);
    }

    /** @test */
    public function a_page_can_be_deleted()
    {
        $page = factory(Page::class)->create();

        $page->delete();

        $this->assertCount(0, Page::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function page_has_parent_relation()
    {
        // Many to One
        $children = factory(Page::class)->create([
            'page_id' => factory(Page::class)->create(),
        ]);

        $this->assertCount(2, Page::all());
        $this->assertInstanceOf(Page::class, $children->parent);
    }

    /** @test */
    public function page_has_children_relation()
    {
        // One to Many
        $product = factory(Page::class)->create()->children()->save(factory(Page::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $product->children);
    }

    /** @test */
    public function page_has_rewrite_relation()
    {
        // One to One Polymorphic
        $page = factory(Page::class)->create();
        $page->rewrite()->save(factory(Rewrite::class)->make());

        $this->assertInstanceOf(Rewrite::class, $page->rewrite);
    }
}
