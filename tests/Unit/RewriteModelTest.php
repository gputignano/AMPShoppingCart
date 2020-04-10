<?php

namespace Tests\Unit;

use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class RewriteModelTest extends TestCase
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
        $this->assertCount(1, Rewrite::all());
        $this->assertInstanceOf(Rewrite::class, $this->rewrite);
    }

    /** @test */
    public function a_rewrite_can_be_updated()
    {
        $slug = Str::slug($title = $this->faker->sentence);
        $description = $this->faker->paragraph;
        $robots = 'index,follow';
        $template = $this->faker->word;
        $enabled = true;
        $rewritableType = $this->faker->word;
        $rewritableId = $this->faker->numberBetween(101, 200);

        $updated = $this->rewrite->update([
            'slug' => $slug,
            'title' => $title,
            'description' => $description,
            'robots' => $robots,
            'template' => $template,
            'enabled' => $enabled,
            'rewritable_type' => $rewritableType,
            'rewritable_id' => $rewritableId,
        ]);

        $this->asserttrue($updated);
        $this->assertEquals($slug, $this->rewrite->slug);
        $this->assertEquals($title, $this->rewrite->title);
        $this->assertEquals($description, $this->rewrite->description);
        $this->assertEquals($robots, $this->rewrite->robots);
        $this->assertEquals($template, $this->rewrite->template);
        $this->assertEquals($enabled, $this->rewrite->enabled);
        $this->assertEquals($rewritableType, $this->rewrite->rewritable_type);
        $this->assertEquals($rewritableId, $this->rewrite->rewritable_id);
    }

    /** @test */
    public function a_rewrite_can_be_deleted()
    {
        $this->rewrite->delete();

        $this->assertDeleted($this->rewrite);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function rewrite_has_rewritable_relation()
    {
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphTo::class, $this->rewrite->rewritable());
    }
}
