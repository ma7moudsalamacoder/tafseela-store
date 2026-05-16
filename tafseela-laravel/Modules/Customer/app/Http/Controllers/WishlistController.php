<?php

namespace Modules\Customer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customer\Services\WishlistService;

class WishlistController extends Controller
{
    public function __construct(
        protected WishlistService $wishlistService
    ) {}

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $result = $this->wishlistService->toggle(
            auth()->id(),
            (int) $request->product_id
        );

        if ($request->expectsJson()) {
            return response()->json($result);
        }

        return redirect()->back();
    }
}
