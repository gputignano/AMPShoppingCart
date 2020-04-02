<?php

namespace Tests\Unit;

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function a_user_can_be_created()
    {
        $this->assertCount(0, User::all());

        factory(User::class)->create();

        $this->assertCount(1, User::all());
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $user = factory(User::class)->create();

        $user->update([
            'email' => $email = $this->faker->unique()->safeEmail,
            'password' => bcrypt($password = Str::random(10)),
        ]);

        $this->assertEquals($email, $user->email);
        $this->assertTrue(Hash::check($password, $user->password));
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $user = factory(User::class)->create();

        $user->delete();

        $this->assertCount(0, User::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function user_has_orders_relation()
    {
        $user = factory(User::class)->create();

        $user->orders()->save(factory(Order::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $user->orders);
    }
}
