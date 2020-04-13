<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RewriteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function a_rewrite_can_be_updated()
    {
        $rewrite = factory(Rewrite::class)->create();

        $response = $this->patchJson(route('rewrites.update', $rewrite), [
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
        $rewrite = factory(Rewrite::class)->create();

        $response = $this->deleteJson(route('rewrites.destroy', $rewrite), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
