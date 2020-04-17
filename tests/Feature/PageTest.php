<?php

namespace Tests\Feature;

use App\Models\EAV;
use App\Models\Page;
use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $page;

    protected function setUp(): void
    {
        parent::setUp();

        $this->page = factory(Page::class)->create([
            'parent_id' => factory(Page::class)->create(),
        ]);

        $this->page->rewrite()->save(factory(Rewrite::class)->make());
    }

    /** @test */
    public function a_page_can_be_created()
    {
        $response = $this->postJson(route('pages.store'), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_creating_a_new_page()
    {
        $response = $this->postJson(route('pages.store'), [
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_page_can_be_updated()
    {
        $response = $this->patch(route('pages.update', $this->page), [
            'name' => $this->faker->name,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_updating_a_new_page()
    {
        $response = $this->patchJson(route('pages.update', $this->page), [
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors('name');
    }

    /** @test */
    public function a_page_can_be_deleted()
    {
        $response = $this->deleteJson(route('pages.destroy', $this->page), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_a_parent_page_is_deleted_children_relation_is_updated()
    {
        $children = $this->page->children()->save(factory(Page::class)->make());

        $this->page->delete();

        $this->assertDeleted($this->page);
        $this->assertDeleted($children);
    }

    /** @test */
    public function when_a_parent_page_is_deleted_eavs_relation_is_updated()
    {
        $eav = $this->page->eavs()->save(factory(EAV::class)->make());

        $this->page->delete();

        $this->assertDeleted($this->page);
        $this->assertDeleted($eav);
    }

    /** @test */
    public function when_a_parent_page_is_deleted_rewrite_relation_is_updated()
    {
        $rewrite = $this->page->rewrite()->save(factory(Rewrite::class)->make());

        $this->page->delete();

        $this->assertDeleted($this->page);
        $this->assertDeleted($rewrite);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function page_has_parent_relation()
    {
        // Many to One
        $this->assertInstanceOf(Page::class, $this->page->parent);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->page->parent());
    }

    /** @test */
    public function page_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->page->children);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->page->children());
    }

    /** @test */
    public function page_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->page->eavs);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->page->eavs());
    }

    /** @test */
    public function page_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Rewrite::class, $this->page->rewrite);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $this->page->rewrite());
    }
}
