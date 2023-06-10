<?php

namespace App\Services;

use App\Contracts\PaymentInterface;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PlaceToPayPayment
{
    public function pay(Request $request, Order $order): RedirectResponse
    {
        Log::info('[PAY]: Pago con PlaceToPay');
        $result = Http::post(config('placetopay.url').'/api/session',
        $this->createSession($order, $request->ip(), $request->userAgent()));

        if ($result->ok()) {
            $order->order_id = $result->json()['requestId'];
            $order->url = $result->json()['processUrl'];
            $order->save();
            return redirect()->to($order->url);
        }

        throw new \Exception($result->body());
    }

    public function sendNotification()
    {
        Log::info('[PAY]: Enviamos la notificacion PlaceToPay');
    }

    private function createSession(Order $order, string $ipAddress, string $userAgent): array
    {
        return [
            'auth' => $this->getAuth(),
            'buyer' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ],
            'payment' => [
                'reference' => $order->order_id,
                'description' => "ejemplo",
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total
                ]
            ],
            'expiration' => Carbon::now()->addHour(),
            'returnUrl' => route('orders.index'),
            'ipAddress' => $ipAddress,
            'userAgent' => $userAgent,
        ];
    }

    private function getAuth(): array
    {
        $nonce = Str::random();
        $seed = date('c');

        return [
            'login' => config('placetopay.login'),
            'tranKey' => base64_encode(
                hash(
                    'sha256',
                    $nonce.$seed.config('placetopay.tranKey'),
                    true
                )
            ),
            'nonce' => base64_encode($nonce),
            'seed' => $seed,
        ];
    }

    public function getRequestInformation(Order $order): View
    {
        $result = Http::post(config('placetopay.url')."/api/session/$order->order_id", [
            'auth' => $this->getAuth()
        ]);

        if ($result->ok()) {
            $status = $result->json()['status']['status'];
            if ($status == 'APPROVED') {
                $order->completed();
            } elseif ($status == 'REJECTED') {
                $order->canceled();
            }

            return view('orders.index', [
                'processor' => $order->provider,
                'status' => $order->status
            ]);
        }

        throw  new \Exception($result->body());
    }
}