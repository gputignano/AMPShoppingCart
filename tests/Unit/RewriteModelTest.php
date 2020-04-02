<?php

namespace Tests\Unit;

use App\Product;
use App\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RewriteModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_rewrite_can_be_created()
    {
        $this->assertCount(0, Rewrite::all());

        factory(Rewrite::class)->create();

        $this->assertCount(1, Rewrite::all());
    }

    /** @test */
    public function a_rewrite_can_be_updated()
    {
        $rewrite = factory(Rewrite::class)->create();

        $rewrite->update([
            'slug' => $slug = Str::slug($title = $this->faker->sentence),
            'title' => $title,
            'description' => $description = $this->faker->paragraph,
            'robots' => $robots = 'index,follow',
            'template' => $template = $this->faker->word,
            'enabled' => $enabled = true,
            'rewritable_type' => $rewritableType = $this->faker->word,
            'rewritable_id' => $rewritableId = $this->faker->numberBetween(101, 200)
        ]);

        $this->assertEquals($slug, $rewrite->slug);
        $this->assertEquals($title, $rewrite->title);
        $this->assertEquals($description, $rewrite->description);
        $this->assertEquals($robots, $rewrite->robots);
        $this->assertEquals($template, $rewrite->template);
        $this->assertEquals($enabled, $rewrite->enabled);
        $this->assertEquals($rewritableType, $rewrite->rewritable_type);
        $this->assertEquals($rewritableId, $rewrite->rewritable_id);
    }

    /** @test */
    public function a_rewrite_can_be_deleted()
    {
        $rewrite = factory(Rewrite::class)->create();

        $rewrite->delete();

        $this->assertCount(0, Rewrite::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function rewrite_has_rewritable_relation()
    {
        $product = factory(Product::class)->create();
        $rewrite = factory(Rewrite::class)->create([
            'rewritable_type' => Product::class,
            'rewritable_id' => $product->id,
        ]);

        $this->assertInstanceOf(Product::class, $rewrite->rewritable);
    }
}
