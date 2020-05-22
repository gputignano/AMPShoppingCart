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

        $this->seed('InstallationTableSeeder');

        $this->page = factory(Page::class)->create();

        $this->page->rewrite()->save(factory(Rewrite::class)->make());
    }

    /** @test */
    public function a_user_can_view_page_index()
    {
        $response = $this->get(route('admin.pages.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.page.index');

        $response->assertSee('<h1>All Pages</h1>', false);
    }

    /** @test */
    public function a_user_can_view_page_create()
    {
        $response = $this->get(route('admin.pages.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.page.create');

        $response->assertSee('<h1>Create Page</h1>', false);
    }

    /** @test */
    public function a_user_can_view_page_show()
    {
        $response = $this->get(route('admin.pages.show', $this->page));

        $response->assertStatus(200);

        $response->assertViewIs('admin.page.show', $this->page);

        $response->assertSee('<h1>' . e($this->page->name) . '</h1>', false);
    }

    /** @test */
    public function a_user_can_view_page_edit()
    {
        $response = $this->get(route('admin.pages.edit', $this->page));

        $response->assertStatus(200);

        $response->assertViewIs('admin.page.edit', $this->page);

        $response->assertSee('<h1>Edit ' . e($this->page->name) . '</h1>', false);
    }

    /** @test */
    public function a_page_can_be_created()
    {
        $response = $this->postJson(route('admin.pages.store'), [
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
    public function name_is_required_when_creating_a_new_page()
    {
        $response = $this->postJson(route('admin.pages.store'), [
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
    public function a_page_can_be_updated()
    {
        $response = $this->patch(route('admin.pages.update', $this->page), [
            'parent_id' => '',
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_updating_a_new_page()
    {
        $response = $this->patchJson(route('admin.pages.update', $this->page), [
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
    public function a_page_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.pages.destroy', $this->page), [
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
    public function when_a_page_is_deleted_eavs_is_deleted()
    {
        $eav = $this->page->eavs()->save(factory(EAV::class)->make());

        $this->page->delete();

        $this->assertDeleted($this->page);

        $this->assertDeleted($eav);
    }

    /** @test */
    public function when_a_page_is_deleted_rewrite_is_deleted()
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
        $page = factory(Page::class)->create(['parent_id' => $this->page->id]);
        $this->assertInstanceOf(Page::class, $page->parent);

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

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->page->eavs());
    }

    /** @test */
    public function page_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Rewrite::class, $this->page->rewrite);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $this->page->rewrite());
    }
}
