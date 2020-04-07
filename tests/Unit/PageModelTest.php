<?php

namespace Tests\Unit;

use App\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $page;

    protected function setUp(): void
    {
        parent::setUp();

        $this->page = factory(Page::class)->create();
    }

    /** @test */
    public function a_page_can_be_created()
    {
        $this->assertCount(1, Page::all());
        $this->assertInstanceOf(Page::class, $this->page);
    }

    /** @test */
    public function a_page_can_be_updated()
    {
        $updated = $this->page->update([
            'parent_id' => factory(Page::class)->create(),
            'name' => $name = $this->faker->name,
        ]);

        $this->assertTrue($updated);
        $this->assertEquals($name, $this->page->name);
    }

    /** @test */
    public function a_page_can_be_deleted()
    {
        $this->page->delete();

        $this->assertDeleted($this->page);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function page_has_parent_relation()
    {
        // Many to One
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->page->parent());
    }

    /** @test */
    public function page_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->page->children());
    }

    /** @test */
    public function page_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->page->eavs());
    }

    /** @test */
    public function page_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->page->rewrite());
    }
}
