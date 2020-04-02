<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class OrderDetailModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_order_detail_can_be_created()
    {
        $this->assertCount(0, OrderDetail::all());

        factory(OrderDetail::class)->create();

        $this->assertCount(1, OrderDetail::all());
    }

    /** @test */
    public function an_order_detail_can_be_updated()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $orderDetail->update([
            'order_id' => $orderId = factory(Order::class)->create()->id,
            'code' => $code = Str::random(5),
            'name' => $name = $this->faker->word,
            'price' => $price = $this->faker->randomFloat(null, 10, 4),
            'quantity' => $quantity = $this->faker->numberBetween(1, 10),
        ]);

        $this->assertEquals($orderId, $orderDetail->order_id);
        $this->assertEquals($code, $orderDetail->code);
        $this->assertEquals($name, $orderDetail->name);
        $this->assertEquals($price, $orderDetail->price);
        $this->assertEquals($quantity, $orderDetail->quantity);
    }

    /** @test */
    public function an_order_detail_can_be_deleted()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $orderDetail->delete();

        $this->assertCount(0, OrderDetail::all());
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function order_detail_has_order_relation()
    {
        $order = factory(Order::class)->create();
        $orderDetail = factory(OrderDetail::class)->create([
            'order_id' => $order->id,
        ]);

        $this->assertInstanceOf(Order::class, $orderDetail->order);
    }
}
