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
        $response = $this->postJson(route('rewrites.store'), [
            'title' => $title = $this->faker->sentence,
            'slug' => Str::slug($title),
            'description' => $this->faker->text,
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
    public function a_rewrite_can_be_updated()
    {
        $response = $this->patchJson(route('rewrites.update', $this->rewrite), [
            'title' => $title = $this->faker->sentence,
            'slug' => Str::slug($title),
            'description' => $this->faker->text,
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
    public function a_rewrite_can_be_deleted()
    {
        $response = $this->deleteJson(route('rewrites.destroy', $this->rewrite), [
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
