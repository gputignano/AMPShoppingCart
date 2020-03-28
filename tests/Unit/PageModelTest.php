<?php

namespace Tests\Unit;

use App\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PageModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_page_can_be_created()
    {
        $this->assertCount(0, Page::all());

        factory(Page::class)->create();

        $this->assertCount(1, Page::all());
    }

    /** @test */
    public function a_page_can_be_updated()
    {
        $page = factory(Page::class)->create();

        $page->update([
            'name' => $name = $this->faker->name,
        ]);

        $this->assertEquals($name, $page->name);
    }

    /** @test */
    public function a_page_can_be_deleted()
    {
        $page = factory(Page::class)->create();

        $page->delete();

        $this->assertCount(0, Page::all());
    }
}
