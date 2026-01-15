<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->applyResourcePermissions('orders');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Order::datatable();
        }
        return view('pages.orders.index');
    }

    public function create()
    {
        return view('pages.orders.create');
    }

    public function store(OrderRequest $request)
    {
        Order::create($request->validated());
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        return view('pages.orders.edit', compact('order'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
