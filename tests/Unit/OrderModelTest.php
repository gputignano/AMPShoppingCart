<?php

namespace Tests\Unit;

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_order_can_be_created()
    {
        $this->assertCount(0, Order::all());

        factory(Order::class)->create();

        $this->assertCount(1, Order::all());
    }

    /** @test */
    public function an_order_can_be_updated()
    {
        $order = factory(Order::class)->create();

        $order->update([
            'user_id' => $userId = factory(User::class)->create()->id,
        ]);

        $this->assertEquals($userId, $order->user_id);
    }

    /** @test */
    public function an_order_can_be_deleted()
    {
        $order = factory(Order::class)->create();

        $order->delete();

        $this->assertCount(0, Order::all());
    }
}
