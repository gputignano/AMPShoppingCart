<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_order_can_be_created()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson(route('orders.store'), [
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_order_can_be_updated()
    {
        $order = factory(Order::class)->create();

        $response = $this->patchJson(route('orders.update', $order), [
            'user_id' => factory(User::class)->create()->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_order_can_be_deleted()
    {
        $order = factory(Order::class)->create();

        $response = $this->deleteJson(route('orders.destroy', $order), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
