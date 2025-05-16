<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function feedback_stores_for_delivered_order()
    {
        // Create a delivered order manually
        $order = new Order();
        $order->name = "Test User";
        $order->email = "test@example.com";
        $order->delivery_status = "Delivered";
        $order->title = "Pizza";
        $order->price = 9.99;
        $order->save();

        // Submit feedback
        $this->post("/submit_feedback/{$order->id}", [
            'feedback' => 'Great pizza!'
        ]);

        // Assert feedback was saved
        $this->assertEquals('Great pizza!', $order->fresh()->feedback);
    }

    /** @test */
    public function feedback_rejected_for_undelivered_order()
    {
        // Create an undelivered order
        $order = new Order();
        $order->name = "Test User";
        $order->email = "test@example.com";
        $order->delivery_status = "Processing";
        $order->title = "Burger";
        $order->price = 8.99;
        $order->save();

        // Attempt to submit feedback
        $this->post("/submit_feedback/{$order->id}", [
            'feedback' => 'Should not save!'
        ]);

        // Assert feedback was NOT saved
        $this->assertNull($order->fresh()->feedback);
    }

    /** @test */
    public function rating_stores_for_delivered_order()
    {
        // Create a delivered order
        $order = new Order();
        $order->name = "Test User";
        $order->email = "test@example.com";
        $order->delivery_status = "Delivered";
        $order->title = "Pasta";
        $order->price = 12.99;
        $order->save();

        // Submit rating
        $this->post("/rate_order/{$order->id}", [
            'rating' => 4
        ]);

        // Assert rating was saved
        $this->assertEquals(4, $order->fresh()->rating);
    }

    /** @test */
    public function rating_rejected_for_undelivered_order()
    {

        $order = new Order();
        $order->name = "Test User";
        $order->email = "test@example.com";
        $order->delivery_status = "Processing";
        $order->title = "Salad";
        $order->price = 7.99;
        $order->save();

        // Attempt to submit rating
        $this->post("/rate_order/{$order->id}", [
            'rating' => 5
        ]);

        // Assert rating was NOT saved
        $this->assertNull($order->fresh()->rating);
    }
}