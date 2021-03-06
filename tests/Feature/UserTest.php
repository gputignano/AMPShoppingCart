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
    public function a_user_can_view_user_index()
    {
        $response = $this->get(route('admin.users.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.user.index');

        $response->assertSee('<h1>All Users</h1>', false);
    }

    /** @test */
    public function a_user_can_view_user_create()
    {
        $response = $this->get(route('admin.users.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.user.create');

        $response->assertSee('<h1>Create User</h1>', false);
    }

    /** @test */
    public function a_user_can_view_user_show()
    {
        $response = $this->get(route('admin.users.show', $this->user));

        $response->assertStatus(200);

        $response->assertViewIs('admin.user.show');

        $response->assertSee('Show User', false);
    }

    /** @test */
    public function a_user_can_view_user_edit()
    {
        $response = $this->get(route('admin.users.edit', $this->user));

        $response->assertStatus(200);

        $response->assertViewIs('admin.user.edit');

        $response->assertSee('Edit User', false);
    }

    /** @test */
    public function a_user_can_be_stored()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'email' => $this->faker->safeEmail,
            'password' => Str::random(10),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function email_is_required_when_creating_a_new_user()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'password' => 'password',
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'email',
                    'message' => ['The email field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function email_must_have_the_right_format()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'email' => Str::random(10),
            'password' => Str::random(10),
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'email',
                    'message' => ['The email must be a valid email address.'],
                ],
            ]
        ]);
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

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'email',
                    'message' => ['The email has already been taken.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function password_is_required_when_creating_a_new_user()
    {
        $response = $this->postJson(route('admin.users.store'), [
            'email' => $this->faker->safeEmail,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'password',
                    'message' => ['The password field is required.'],
                ],
            ]
        ]);
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

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'password',
                    'message' => ['The password field is required.'],
                ],
            ]
        ]);
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
