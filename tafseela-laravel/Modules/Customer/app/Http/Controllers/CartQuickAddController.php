<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\Services\CartService;

class CartQuickAddController extends Controller
{
    public function __invoke(Request $request, CartService $cartService)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        if (! auth()->check()) {
            session()->put('pending_cart_item', [
                'product_id' => (int) $request->product_id,
                'quantity' => (int) ($request->quantity ?? 1),
            ]);

            if ($request->expectsJson()) {
                return response()->json(['redirect' => route('auth.signin')]);
            }

            return redirect()->route('auth.signin');
        }

        $cartService->addItem(auth()->id(), [
            'product_id' => (int) $request->product_id,
            'quantity' => (int) ($request->quantity ?? 1),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Added to cart']);
        }

        return redirect()->back();
    }
}
