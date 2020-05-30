<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RewriteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $rewrite;

    protected function setUp(): void
    {
        parent::setUp();

        $entity = factory(Entity::class)->create();

        $this->rewrite = $entity->rewrite()->save(factory(Rewrite::class)->create());
    }

    /** @test */
    public function a_user_can_view_rewrite_index()
    {
        $response = $this->get(route('admin.rewrites.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.rewrite.index');

        $response->assertSee('<h1>All Rewrites</h1>', false);
    }

    /** @test */
    public function a_user_can_view_rewrite_create()
    {
        $response = $this->get(route('admin.rewrites.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.rewrite.create');

        $response->assertSee('<h1>Create Rewrite</h1>', false);
    }

    /** @test */
    public function a_user_can_view_rewrite_show()
    {
        $response = $this->get(route('admin.rewrites.show', $this->rewrite));

        $response->assertStatus(200);

        $response->assertViewIs('admin.rewrite.show');

        $response->assertSee('<h1>' . e($this->rewrite->meta_title) . '</h1>', false);
    }

    /** @test */
    public function a_user_can_view_rewrite_edit()
    {
        $response = $this->get(route('admin.rewrites.edit', $this->rewrite));

        $response->assertStatus(200);

        $response->assertViewIs('admin.rewrite.edit');

        $response->assertSee('<h1>' . e($this->rewrite->meta_title) . '</h1>', false);
    }

    /** @test */
    public function a_rewrite_can_be_created()
    {
        $meta_title = $this->faker->sentence;
        

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => 'present',
            // 'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create()->id,
            'is_active' => null,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function slug_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            // 'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'slug',
                    'message' => ['The slug field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function meta_title_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            // 'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'meta_title',
                    'message' => ['The meta title field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function meta_description_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            // 'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'meta_description',
                    'message' => ['The meta description field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function entity_id_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            // 'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'entity_id',
                    'message' => ['The entity id field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function a_rewrite_can_be_updated()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create()->id,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function slug_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            // 'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'slug',
                    'message' => ['The slug field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function meta_title_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            // 'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'meta_title',
                    'message' => ['The meta title field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function meta_description_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            // 'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'meta_description',
                    'message' => ['The meta description field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function entity_id_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'meta_robots' => null,
            'entity_type' => Entity::class,
            // 'entity_id' => factory(Entity::class)->create(),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'entity_id',
                    'message' => ['The entity id field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function a_rewrite_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.rewrites.destroy', $this->rewrite), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function rewrite_has_entity_relation()
    {
        $this->assertInstanceOf(Entity::class, $this->rewrite->entity()->withoutGlobalScopes()->first());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->rewrite->entity());
    }
}
