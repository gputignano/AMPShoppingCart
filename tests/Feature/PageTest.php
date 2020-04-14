<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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
    public function a_page_can_be_updated()
    {
        $page = factory(Page::class)->create();

        $response = $this->patch(route('pages.update', $page), [
            'updated' => true,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function a_page_can_be_deleted()
    {
        $page = factory(Page::class)->create();

        $response = $this->deleteJson(route('pages.destroy', $page), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
