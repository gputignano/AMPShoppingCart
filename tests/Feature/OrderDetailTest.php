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

    /** @test */
    public function an_order_detail_can_be_created()
    {
        $response = $this->postJson(route('orderDetails.store'), [
            'order_id' => factory(Order::class)->create()->id,
            'code' => Str::random(5),
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(null, 10, 4),
            'quantity' => $this->faker->numberBetween(1, 10),
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_order_detail_can_be_updated()
    {
        $orderDetail = factory(OrderDetail::class)->create();

        $response = $this->patchJson(route('orderDetails.update', $orderDetail), [
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

        $response = $this->deleteJson(route('orderDetails.destroy', $orderDetail), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
