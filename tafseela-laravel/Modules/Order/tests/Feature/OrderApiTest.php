<?php

namespace Modules\Order\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Cart\Services\CartService;
use Modules\Identity\Models\User;
use Modules\Product\Models\Product;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $this->product = Product::create([
            'name' => 'Test Product',
            'price' => 100.00,
            'status' => 'show',
        ]);
    }

    public function test_can_place_order_from_cart(): void
    {
        $this->actingAs($this->user, 'sanctum');

        // Add item to cart first
        $cartService = app(CartService::class);
        $cartService->addItem($this->user->id, [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $response = $this->postJson('/api/v1/orders');

        $response->assertStatus(201)
            ->assertJsonPath('data.grand_total', '200.00')
            ->assertJsonCount(1, 'data.details')
            ->assertJsonPath('data.details.0.product', 'Test Product');

        // Verify cart is cleared
        $this->getJson('/api/v1/carts')
            ->assertJsonCount(0, 'data.items');
    }

    public function test_cannot_place_order_with_empty_cart(): void
    {
        $this->actingAs($this->user, 'sanctum');

        $response = $this->postJson('/api/v1/orders');

        $response->assertStatus(500); // Because of the exception thrown
    }

    public function test_can_list_orders(): void
    {
        $this->actingAs($this->user, 'sanctum');

        // Place an order
        $cartService = app(CartService::class);
        $cartService->addItem($this->user->id, [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);
        $this->postJson('/api/v1/orders');

        $response = $this->getJson('/api/v1/orders');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_can_show_order(): void
    {
        $this->actingAs($this->user, 'sanctum');

        // Place an order
        $cartService = app(CartService::class);
        $cartService->addItem($this->user->id, [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);
        $orderResponse = $this->postJson('/api/v1/orders');
        $orderId = $orderResponse->json('data.id');

        $response = $this->getJson("/api/v1/orders/{$orderId}");

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $orderId)
            ->assertJsonPath('data.grand_total', '200.00');
    }
}
