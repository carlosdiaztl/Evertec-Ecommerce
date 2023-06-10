<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function pay(Request $request, Order $order)
    {
        $result = Http::post(config('placetopay.url') . '/api/session',
            $this->paymentService->createSession($order, $request->ip(), $request->userAgent()));
        if ($result->ok()) {
            $order->order_id = $result->json()['requestId'];
            $order->url = $result->json()['processUrl'];
            $order->status= "pending";
            $order->save();
            return redirect()->to($order->url);
        }
        throw new \Exception($result->body());
    }
    

    //
}
