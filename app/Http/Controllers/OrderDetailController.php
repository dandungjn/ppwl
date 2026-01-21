<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetailRequest;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return OrderDetail::datatable();
        }
        return view('pages.order_details.index');
    }

    public function create()
    {
        return view('pages.order_details.create');
    }

    public function store(OrderDetailRequest $request)
    {
        OrderDetail::create($request->validated());
        return redirect()->route('order_details.index')->with('success', 'Order Detail created successfully.');
    }

    public function edit(OrderDetail $orderDetail)
    {
        return view('pages.order_details.edit', compact('orderDetail'));
    }

    public function update(OrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->validated());
        return redirect()->route('order_details.index')->with('success', 'Order Detail updated successfully.');
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return redirect()->route('order_details.index')->with('success', 'Order Detail deleted successfully.');
    }
}
