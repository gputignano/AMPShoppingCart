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

    protected $orderDetail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->orderDetail = factory(OrderDetail::class)->create();
    }

    /** @test */
    public function an_order_detail_can_be_created()
    {
        $this->assertCount(1, OrderDetail::all());
        $this->assertInstanceOf(OrderDetail::class, $this->orderDetail);
    }

    /** @test */
    public function an_order_detail_can_be_updated()
    {
        $orderId = factory(Order::class)->create()->id;
        $code = Str::random(5);
        $name = $this->faker->word;
        $price = $this->faker->randomFloat(null, 10, 4);
        $quantity = $this->faker->numberBetween(1, 10);

        $updated = $this->orderDetail->update([
            'order_id' => $orderId,
            'code' => $code,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        $this->assertTrue($updated);
        $this->assertEquals($orderId, $this->orderDetail->order_id);
        $this->assertEquals($code, $this->orderDetail->code);
        $this->assertEquals($name, $this->orderDetail->name);
        $this->assertEquals($price, $this->orderDetail->price);
        $this->assertEquals($quantity, $this->orderDetail->quantity);
    }

    /** @test */
    public function an_order_detail_can_be_deleted()
    {
        $this->orderDetail->delete();

        $this->assertDeleted($this->orderDetail);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function order_detail_has_order_relation()
    {
        // Many to One
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->orderDetail->order());
    }
}
