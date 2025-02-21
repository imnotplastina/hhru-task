<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::query()
            ->get();

        return view('orders.create', compact('products'));
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        $product = Product::query()
            ->find($validated['product_id']);
        $validated['total_price'] = $product->price * $validated['quantity'];

        Order::query()->create($validated);

        return redirect()->route('orders.index')->with('success', __('messages.order_created'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = Product::query()
            ->get();

        return view('orders.edit', compact('order', 'products'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validated = $request->validated();

        if (isset($validated['product_id']) || isset($validated['quantity'])) {
            $product = Product::query()->find($validated['product_id'] ?? $order->product_id);
            $validated['total_price'] = $product->price * ($validated['quantity'] ?? $order->quantity);
        }

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', __('messages.order_updated'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', __('messages.order_deleted'));
    }

    public function complete(Order $order)
    {
        $order->update([
            'status' => OrderStatus::COMPLETED
        ]);

        return redirect()->route('orders.show', $order)->with('success', __('messages.order_completed'));
    }
}
