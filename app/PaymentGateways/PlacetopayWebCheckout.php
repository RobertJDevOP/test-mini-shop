<?php

namespace App\PaymentGateways;

use App\Entities\Product;
use App\Models\PurchaseOrder;
use App\PaymentGateways\Responses\PlacetopayResponse;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PlacetopayWebCheckout implements IGatewayApiWallet
{
    private ?string $requestId;
    private PurchaseOrder|int $purchaseOrder;
    private array $messageError;

    public function __construct(PurchaseOrder|int $purchaseOrder,?string $requestId)
    {
        $this->requestId = $requestId;
        $this->purchaseOrder = $purchaseOrder;
        $this->messageError = ['status' => ['message' => 'Ocurrio un error inesperado con la pasarela de pagos , por favor contactar a sistemas','status' => 500]];
    }

    public function createRequest(): array
    {
        $request = $this->makeRequest();
        $response = Http::post(config('app.placetopay_uri').'/api/session', $request);

        if($response->failed()){
            return $this->messageError;
        }else{
            $placetoPayResponse = new PlacetopayResponse(json_decode($response->body(),true),$this->purchaseOrder->id);
            return $placetoPayResponse->getResponse();
        }
    }

    public function getRequestInformation(): array
    {
        $response = Http::post(config('app.placetopay_uri').'/api/session/'.$this->requestId,$this->makeAuth());
        $placetoPayResponse = new PlacetopayResponse(json_decode($response->body(),true),$this->purchaseOrder);

        return $placetoPayResponse->getResponse();
    }

    public function makeRequest(): array
    {
        return [ ...$this->makeAuth(), ...$this->makePayment(), ...$this->makeBuyer(), ...$this->extraAttributes()];
    }

    public function makeAuth(): array
    {
        $nonce = Str::random();
        $seed = Carbon::now(new DateTimeZone('America/Bogota'))->toIso8601String();

        return [
            'locale' => config('app.placetopay_locale'),
            'auth'=>[
                'login' => config('app.placetopay_login'),
                'tranKey' => base64_encode(sha1($nonce.$seed.config('app.placetopay_tranKey'), true)),
                'nonce' => base64_encode($nonce),
                'seed' => $seed,
            ],
        ];
    }

    public function makePayment(): array
    {
        $product = new Product();
        $items=array();

        foreach ($this->purchaseOrder->detailsOrder as  $row){
            $items [] =['name'=>$product->getName(),'qty'=>$row['qty'],'price'=>$row['price'],'category'=>'physical'];
        }

        return [
            'payment' => [
                'reference' => $this->purchaseOrder->id,
                'description' => 'PAGO COMPRA SHOP ONLINE',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $this->purchaseOrder->total,
                ],
                'items'  =>[
                    'item' => $items,
                ]
            ]
        ];
    }

    public function makeBuyer(): array
    {
       return [
           'buyer' => [
                'document' => $this->purchaseOrder->customer->document_number,
                'documentType' => $this->purchaseOrder->customer->documentType->type,
                'name' => $this->purchaseOrder->customer_name,
                'surname' =>$this->purchaseOrder->customer_name,
                'company' => 'PlaceToPay Evertec INC',
                'email' => $this->purchaseOrder->customer_email,
                'mobile' => $this->purchaseOrder->customer_mobile,
                'address' => [
                    'street'=>  $this->purchaseOrder->customer->address,
                    'city'=>  'FLORIDABLANCA',
                    'state'=> 'SANTANDER',
                    'postalCode'=> '681001',
                    'country'=> 'COLOMBIA',
                ],
            ]
        ];
    }

    public function extraAttributes(): array
    {
        return [
            'expiration' => Carbon::now(new DateTimeZone('America/Bogota'))->addHour()->toIso8601String(),
            'returnUrl' => route('payment.checkout', $this->purchaseOrder->id),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->userAgent()
        ];
    }
}
