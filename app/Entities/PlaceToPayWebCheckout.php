<?php

namespace App\Entities;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PlaceToPayWebCheckout implements IGatewayApiWallet
{
    private ?string $requestId;

    public function __construct(?string $requestId)
    {
        $this->requestId = $requestId;
    }

    public function createRequest(): object
    {
        $request = $this->makeRequest();
        $response = Http::post(config('placetopay_uri').'/api/session', $request);

        return new PlacetopayResponse($response->json());
    }

    public function getSession()
    {
        return '';
    }

    public function makeRequest(): array
    {
        return [ ...$this->makeAuth(), ... $this->makeBuyer(), ... $this->makePayment(), ...$this->extraAttributes()];
    }

    public function makeAuth(): array
    {
        $nonce = Str::random();
        $seed = Carbon::now(new DateTimeZone('America/Bogota'))->toIso8601String();

        return [
            'locale' => config('placetopay_locale'),
            'auth'=>[
                'login' => config('placetopay_login'),
                'tranKey' => base64_encode(sha1($nonce.$seed.config('placetopay_tranKey'), true)),
                'nonce' => base64_encode($nonce),
                'seed' => $seed,
            ],
        ];
    }

    public function makePayment($purchaseOrder): array
    {
        return [
            'payment' => [
                'reference' => $purchaseOrder->id,
                'description' => 'PAGO COMPRA SHOP ONLINE',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $purchaseOrder->total,
                ],
                'items'  =>[
                    'item' => ['name'=>$purchaseOrder->detailsOrder['product_name'],'qty'=>$purchaseOrder->detailsOrder
                    ['qty'],'price'=>$purchaseOrder->detailsOrder['price'],'category'=>'physical']
                ]
            ],
        ];
    }

    public function makeBuyer($purchaseOrder): array
    {
       return [
           'buyer' => [
                'document' => $purchaseOrder->user->number_document,
                'documentType' => $purchaseOrder->user->document_type,
                'name' => $purchaseOrder->user->name,
                'surname' => $purchaseOrder->user->surnames,
                'company' => null,
                'email' => $purchaseOrder->user->email,
                'mobile' => $purchaseOrder->user->cell_phone,
                'address' => [
                    'street'=>  $purchaseOrder->user->user_street,
                    'city'=>  'FLORIDABLANCA',
                    'state'=> 'SANTANDER',
                    'postalCode'=> '681001',
                    'country'=> 'COLOMBIA',
                ],
            ]
        ];
    }

    public function extraAttributes($purchaseOrder): array
    {
        return [
            'expiration' => Carbon::now(new DateTimeZone('America/Bogota'))->addHour()->toIso8601String(),
            'returnUrl' => route('payment.checkout', $purchaseOrder->id),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->userAgent()
        ];
    }
}
