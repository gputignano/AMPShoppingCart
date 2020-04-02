<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
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

    /**
     * RELATIONS
     */

    /** @test */
    public function order_has_user_relation()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $order->user);
    }

    /** @test */
    public function order_has_order_details_telation()
    {
        $order = factory(Order::class)->create();
        $order->orderDetails()->save(factory(OrderDetail::class)->make());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $order->orderDetails);
    }
}
