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

    protected $order;

    protected function setUp(): void
    {
        parent::setUp();

        $this->order = factory(Order::class)->create();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_order_can_be_created()
    {
        $response = $this->postJson(route('orders.store'), [
            'user_id' => $this->user->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_order_can_be_updated()
    {
        $response = $this->patchJson(route('orders.update', $this->order), [
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
        $response = $this->deleteJson(route('orders.destroy', $this->order), [
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
    public function order_has_user_relation()
    {
        // Many to One
        $this->assertInstanceOf(User::class, $this->order->user);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->order->user());
    }

    /** @test */
    public function order_has_order_details_telation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->order->orderDetails);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->order->orderDetails());
    }
}
