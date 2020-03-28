<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_category_can_be_created()
    {
        $this->assertCount(0, Category::all());

        $category = factory(Category::class)->create();

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = factory(Category::class)->create();

        $category->update([
            'name' => $name = $this->faker->word,
        ]);

        $this->assertEquals($name, $category->name);
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();

        $category->delete();

        $this->assertCount(0, Category::all());
    }
}
