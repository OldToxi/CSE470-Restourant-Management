<?php

namespace Tests\Feature;

use App\Models\food;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected food $burger;
    protected food $pizza;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'usertype' => 'user'
        ]);
        $this->burger = food::create([
            'title' => 'Burger',
            'detail' => 'Delicious beef burger',
            'price' => 300,
            'image' => 'burger.jpg'
        ]);
        
        $this->pizza = food::create([
            'title' => 'Pizza',
            'detail' => 'Pepperoni pizza',
            'price' => 800,
            'image' => 'pizza.jpg'
        ]);
    }

    public function test_authenticated_user_can_add_food_to_cart(): void
    {
        $this->actingAs($this->user);
        $response = $this->post('/add_cart/'.$this->burger->id, [
            'qty' => 1
        ]);
        $response->assertRedirect();
        $this->assertDatabaseHas('carts', [
            'userid' => $this->user->id,
            'title' => 'Burger',
            'price' => 300 * 1,
            'quantity' => 1
        ]);
    }

    public function test_unauthenticated_user_cannot_add_to_cart(): void
    {
        $response = $this->post('/add_cart/'.$this->burger->id, [
            'qty' => 1
        ]);
        $response->assertRedirect('login');

        $this->assertEquals(0, Cart::count());
    }

    public function test_cart_calculates_total_price_correctly(): void
    {
        $this->actingAs($this->user);
        $this->post('/add_cart/'.$this->burger->id, ['qty' => 3]);
        $this->post('/add_cart/'.$this->pizza->id, ['qty' => 1]);
        $cartItems = Cart::where('userid', $this->user->id)->get();
        $total = $cartItems->sum('price');
        $this->assertEquals(1700, $total);
    }



    public function test_authenticated_user_can_remove_item_from_cart(): void
    {
        $this->actingAs($this->user);
        $this->post('/add_cart/'.$this->burger->id, ['qty' => 1]);
        $cartItem = Cart::where('userid', $this->user->id)->first();
        $this->assertNotNull($cartItem);
        $response = $this->get('/remove_cart/'.$cartItem->id);
        $response->assertRedirect();
        $this->assertDatabaseMissing('carts', ['id' => $cartItem->id]);
    }
}