<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentService
{
    public function createSession(Order $order, string $ipAddress, string $userAgent): array
    {
        return [
            'auth' => $this->getAuth(),
            'buyer' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ],
            'payment' => [
                'reference' => $order->id,
                'description' => "ejemplo",
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total
                ]
            ],
            'expiration' => Carbon::now()->addHour(),
            'returnUrl' => route('orders.index', auth()->user()),
            'ipAddress' => $ipAddress,
            'userAgent' => $userAgent,
        ];
    }

    public function getAuth(): array
    {
        $nonce = Str::random();
        $seed = date('c');

        return [
            'login' => config('placetopay.login'),
            'tranKey' => base64_encode(
                hash(
                    'sha256',
                    $nonce . $seed . config('placetopay.tranKey'),
                    true
                )
            ),
            'nonce' => base64_encode($nonce),
            'seed' => $seed,
        ];
    }
    public function getRequestInformation(Order $order)
    {
        $result = Http::post(config('placetopay.url')."/api/session/$order->order_id", [
            'auth' => $this->getAuth()
        ]);
        if ($result->ok()) {
            $status = $result->json()['status']['status'];
            if ($status == 'APPROVED') {
                $order->status = 'confirmed';
                $order->save();
            } elseif ($status == 'REJECTED') {
                $order->status = 'unconfirmed';
                $order->save();
            }
            return 'Producto actualizado';
        }

        throw  new \Exception($result->body());
    }
}