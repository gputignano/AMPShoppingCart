<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_category_can_be_created()
    {
        $response = $this->postJson(route('categories.store'), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = factory(Category::class)->create();

        $response = $this->patchJson(route('categories.update', $category), [
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();

        $response = $this->deleteJson(route('categories.destroy', $category), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
