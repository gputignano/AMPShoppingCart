<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_user_can_be_created()
    {
        $response = $this->postJson(route('users.store'), [
            'email' => 'user@user.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $user = factory(User::class)->create();

        $response = $this->patchJson(route('users.update', $user), [
            'email' => $this->faker->safeEmail,
            'password' => Str::random(10),
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $user = factory(User::class)->create();

        $response = $this->deleteJson(route('users.destroy', $user), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
