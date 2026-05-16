<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cart\Http\Requests\CartRequest;
use Modules\Cart\Http\Resources\CartResource;
use Modules\Cart\Services\CartService;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the current user's cart.
     */
    public function index(): CartResource
    {
        $cart = $this->cartService->getCart(auth()->id());

        return new CartResource($cart);
    }

    /**
     * Add an item to the cart.
     */
    public function store(CartRequest $request): CartResource
    {
        $cart = $this->cartService->addItem(auth()->id(), $request->validated());

        return new CartResource($cart);
    }

    /**
     * Update an item's quantity in the cart.
     */
    public function update(CartRequest $request, $id): CartResource
    {
        // $id is ignored here as we use product_id from request,
        // but it's kept for route compatibility if needed.
        $cart = $this->cartService->updateItem(
            auth()->id(),
            $request->product_id,
            $request->product_detail_id,
            $request->quantity
        );

        return new CartResource($cart);
    }

    /**
     * Change the product detail (color/size) for an item.
     */
    public function changeDetail(Request $request): CartResource
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'old_product_detail_id' => 'nullable|integer|exists:product_details,id',
            'new_product_detail_id' => 'nullable|integer|exists:product_details,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->cartService->changeItemDetail(
            auth()->id(),
            (int) $request->product_id,
            $request->old_product_detail_id,
            $request->new_product_detail_id,
            (int) $request->quantity
        );

        return new CartResource($cart);
    }

    /**
     * Remove an item from the cart or clear it.
     */
    public function destroy(Request $request, $id): JsonResponse|CartResource
    {
        if ($request->has('product_id')) {
            $cart = $this->cartService->removeItem(
                auth()->id(),
                $request->product_id,
                $request->product_detail_id
            );

            return new CartResource($cart);
        }

        $this->cartService->clearCart(auth()->id());

        return response()->json(['message' => 'Cart cleared successfully']);
    }
}
