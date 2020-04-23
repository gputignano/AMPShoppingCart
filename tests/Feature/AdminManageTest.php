<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminManageTest extends TestCase
{
    /** @test */
    public function a_user_can_view_home()
    {
        $response = $this->get(route('admin.home'));

        $response->assertStatus(200);
    }
}
