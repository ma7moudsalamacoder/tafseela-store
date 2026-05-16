<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Order\Http\Requests\OrderRequest;
use Modules\Order\Http\Resources\OrderResource;
use Modules\Order\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the user's orders.
     */
    public function index(): AnonymousResourceCollection
    {
        $orders = $this->orderService->getUserOrders(auth()->id());

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created order from cart.
     */
    public function store(OrderRequest $request): OrderResource
    {
        $order = $this->orderService->placeOrder(auth()->id(), $request->validated());

        return new OrderResource($order->load('details'));
    }

    /**
     * Show the specified order.
     */
    public function show($id): OrderResource
    {
        $order = $this->orderService->getOrder($id, auth()->id());

        if (! $order) {
            abort(404, 'Order not found.');
        }

        return new OrderResource($order->load('details'));
    }
}
