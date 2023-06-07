<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {

        $data = json_decode($request->getContent(), true);

    // Crear la orden
        $order = new Order();
        $order->user_id = $data['user_id'];
        $order->total = $data['total'];
        $order->status = $data['status'];
        $order->save();
        
        $total = 0;

        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $productOrder = new ProductOrder();
                $productOrder->order_id = $order->id;
                $productOrder->product_id = $value['id'];
                $productOrder->quantity = $value['cantidad'];
                $productOrder->save();
        
            }
        }
        return response()->json(['message' => 'Orden almacenada exitosamente'], 201);
    }
}
