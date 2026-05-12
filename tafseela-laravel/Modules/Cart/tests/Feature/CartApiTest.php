<?php

namespace Modules\Cart\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Identity\Models\User;
use Modules\Product\Models\Product;
use Tests\TestCase;

class CartApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user and a product for testing
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

    public function test_can_get_cart(): void
    {
        $this->actingAs($this->user, 'sanctum');

        $response = $this->getJson('/api/v1/carts');

        $response->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'items',
                    'total',
                ]
            ]);
    }

    public function test_can_add_item_to_cart(): void
    {
        $this->actingAs($this->user, 'sanctum');

        $response = $this->postJson('/api/v1/carts', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(201) // Resource created status if handled by CartResource
            ->assertJsonPath('data.items.0.product_id', $this->product->id)
            ->assertJsonPath('data.items.0.quantity', 2)
            ->assertJsonPath('data.total', 200);
    }

    public function test_can_update_item_quantity(): void
    {
        $this->actingAs($this->user, 'sanctum');

        // Add item first
        $this->postJson('/api/v1/carts', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        // Update quantity
        $response = $this->putJson('/api/v1/carts/1', [
            'product_id' => $this->product->id,
            'quantity' => 5,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.items.0.quantity', 5)
            ->assertJsonPath('data.total', 500);
    }

    public function test_can_remove_item_from_cart(): void
    {
        $this->actingAs($this->user, 'sanctum');

        // Add item
        $this->postJson('/api/v1/carts', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        // Remove item
        $response = $this->deleteJson('/api/v1/carts/1', [
            'product_id' => $this->product->id,
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(0, 'data.items')
            ->assertJsonPath('data.total', 0);
    }

    public function test_can_clear_cart(): void
    {
        $this->actingAs($this->user, 'sanctum');

        // Add item
        $this->postJson('/api/v1/carts', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        // Clear cart
        $response = $this->deleteJson('/api/v1/carts/1');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Cart cleared successfully']);

        // Verify it's cleared
        $this->getJson('/api/v1/carts')
            ->assertJsonCount(0, 'data.items');
    }
}
