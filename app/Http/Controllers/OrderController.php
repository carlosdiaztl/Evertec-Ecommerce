<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PaymentService;

class OrderController extends Controller
{ 
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index(User $user){   
    $orders = $user->orders()->whereIn('status', ['unconfirmed', 'pending'])->get();
    if(count($orders)){
        foreach ($orders as $order) {
            $order->order_id?$this->paymentService->getRequestInformation($order):null;
        };
    }
        return view('orders.index', compact('user'));
    }
    //
}
