<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function pay(Request $request,Order $order){
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
    private function createSession(Order $order, string $ipAddress, string $userAgent): array
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
            'returnUrl' => route('orders.index',auth()->user()),
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
            return view('orders.index',with('success',"tu orden por valor de $order->total fue $order->status") );
        }

        throw  new \Exception($result->body());
    }

    //
}
