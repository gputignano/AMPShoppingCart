<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Database\Eloquent\Model;
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

        $this->rewrite = factory(Rewrite::class)->create();
    }

    /** @test */
    public function a_rewrite_can_be_created()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
    public function template_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            // 'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'template',
                    'message' => ['The template field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function rewritable_type_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'template' => $this->faker->word,
            // 'rewritable_type' => $this->faker->randomElement([
            //     Category::class,
            //     Page::class,
            //     Product::class,
            // ]),
            'rewritable_id' => $this->faker->randomDigit,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'rewritable_type',
                    'message' => ['The rewritable type field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function rewritable_id_is_required_when_creating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->postJson(route('admin.rewrites.store'), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            // 'rewritable_id' => $this->faker->randomDigit,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'rewritable_id',
                    'message' => ['The rewritable id field is required.'],
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
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
    public function template_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            // 'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            'rewritable_id' => $this->faker->randomDigit,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'template',
                    'message' => ['The template field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function rewritable_type_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'template' => $this->faker->word,
            // 'rewritable_type' => $this->faker->randomElement([
            //     Category::class,
            //     Page::class,
            //     Product::class,
            // ]),
            'rewritable_id' => $this->faker->randomDigit,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'rewritable_type',
                    'message' => ['The rewritable type field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function rewritable_id_is_required_when_updating_rewrite()
    {
        $meta_title = $this->faker->sentence;

        $response = $this->patchJson(route('admin.rewrites.update', $this->rewrite), [
            'slug' => Str::slug($meta_title),
            'meta_title' => $meta_title,
            'meta_description' => $this->faker->text,
            'template' => $this->faker->word,
            'rewritable_type' => $this->faker->randomElement([
                Category::class,
                Page::class,
                Product::class,
            ]),
            // 'rewritable_id' => $this->faker->randomDigit,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'rewritable_id',
                    'message' => ['The rewritable id field is required.'],
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
    public function rewrite_has_rewritable_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Model::class, $this->rewrite->rewritable);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $this->rewrite->rewritable());
    }
}
