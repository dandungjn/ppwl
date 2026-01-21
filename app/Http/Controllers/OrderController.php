<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Order::datatable(null, [
                'extra_columns' => [
                    'status' => function ($row) {
                        $s = strtolower($row->status ?? 'pending');
                        $labelClass = 'bg-label-warning';
                        if ($s === 'paid') $labelClass = 'bg-label-success';
                        if ($s === 'cancelled') $labelClass = 'bg-label-danger';

                        $label = ucfirst($s);
                        return "<span class=\"badge {$labelClass} rounded-pill\">{$label}</span>";
                    },
                ],
                'raw_columns' => ['status'],
            ]);
        }

        return view('pages.orders.index');
    }

    public function create()
    {
        $furnitures = Furniture::pluck('name', 'id');
        $furniturePrices = Furniture::pluck('price', 'id');
        return view('pages.orders.create', compact('furnitures', 'furniturePrices'));
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $orderDetails = $data['order_details'];
            unset($data['order_details']);


            $order = Order::create($data);

            foreach ($orderDetails as $od) {
                $od['order_id'] = $order->id;
                OrderDetail::create($od);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $furnitures = Furniture::pluck('name', 'id');
        $furniturePrices = Furniture::pluck('price', 'id');
        $order->load('orderDetails');
        return view('pages.orders.edit', compact('order', 'furnitures', 'furniturePrices'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        $data = $request->validated();

        DB::transaction(function () use ($order, $data) {
            $orderDetails = $data['order_details'];
            unset($data['order_details']);

            $order->update($data);

            $order->orderDetails()->delete();
            foreach ($orderDetails as $od) {
                $od['order_id'] = $order->id;
                OrderDetail::create($od);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
