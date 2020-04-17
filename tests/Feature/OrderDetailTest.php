<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;

class OrderDetailTest extends TestCase
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
        $response = $this->postJson(route('admin.orderDetails.store'), [
            'order_id' => factory(Order::class)->create()->id,
            'code' => Str::random(5),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(null, 10, 4),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_order_detail_can_be_updated()
    {
        $response = $this->patchJson(route('admin.orderDetails.update', $this->orderDetail), [
            'order_id' => factory(Order::class)->create()->id,
            'code' => Str::random(5),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(null, 10, 4),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_order_detail_can_be_deleted()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->deleteJson(route('admin.orderDetails.destroy', $this->orderDetail), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function order_detail_has_order_relation()
    {
        // Many to One
        $this->assertInstanceOf(Order::class, $this->orderDetail->order);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->orderDetail->order());
    }
}
