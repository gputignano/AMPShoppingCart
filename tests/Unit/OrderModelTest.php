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

    protected $order;

    protected function setUp(): void
    {
        parent::setUp();

        $this->order = factory(Order::class)->create();
    }

    /** @test */
    public function an_order_can_be_created()
    {
        $this->assertCount(1, Order::all());
        $this->assertInstanceOf(Order::class, $this->order);
    }

    /** @test */
    public function an_order_can_be_updated()
    {
        $updated = $this->order->update([
            'user_id' => $userId = factory(User::class)->create()->id,
        ]);

        $this->assertTrue($updated);
        $this->assertEquals($userId, $this->order->user_id);
    }

    /** @test */
    public function an_order_can_be_deleted()
    {
        $this->order->delete();

        $this->assertDeleted($this->order);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function order_has_user_relation()
    {
        // Many to One
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->order->user());
    }

    /** @test */
    public function order_has_order_details_telation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->order->orderDetails());
    }
}
