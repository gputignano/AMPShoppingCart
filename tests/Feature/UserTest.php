<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_user_can_be_created()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'email' => $this->faker->safeEmail,
            'password' => Str::random(10),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function email_is_required_when_creating_a_new_user()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'password' => 'password',
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function email_must_have_the_right_format()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'email' => Str::random(10),
            'password' => Str::random(10),
        ]);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        $this->postJson(route('admin.users.store'), [
            'email' => $email = $this->faker->safeEmail,
            'password' => Str::random(19),
        ]);

        $response = $this->postJson(route('admin.users.store'), [
            'email' => $email,
            'password' => Str::random(10),
        ]);

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function password_is_required_when_creating_a_new_user()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'email' => $this->faker->safeEmail,
        ]);

        $response->assertJsonValidationErrors('password');
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $response = $this->patchJson(route('admin.users.update', $this->user), [
            'email' => $this->faker->safeEmail,
            'password' => Str::random(10),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function password_is_required_when_updating_a_new_user()
    {
        $response = $this->patchJson(route('admin.users.update', $this->user), [
            //
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.users.destroy', $this->user), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_a_user_is_deleted_related_orders_are_deleted()
    {
        $order = $this->user->orders()->save(factory(Order::class)->make());

        $this->user->delete();

        $this->assertDeleted($this->user);

        $this->assertDeleted($order);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function user_has_orders_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->user->orders);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->user->orders());
    }
}
