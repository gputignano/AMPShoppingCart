<?php

namespace Tests\Unit;

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

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_user_can_be_created()
    {
        $this->assertCount(1, User::all());
        $this->assertInstanceOf(User::class, $this->user);
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $updated = $this->user->update([
            'email' => $email = $this->faker->unique()->safeEmail,
            'password' => $password = Str::random(10), // password is encrypted bu mutator in User model
        ]);

        $this->assertTrue($updated);
        $this->assertEquals($email, $this->user->email);
        $this->assertTrue(Hash::check($password, $this->user->password));
    }

    /** @test */
    public function a_user_can_be_deleted()
    {
        $this->user->delete();

        $this->assertDeleted($this->user);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function user_has_orders_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->user->orders());
    }
}
