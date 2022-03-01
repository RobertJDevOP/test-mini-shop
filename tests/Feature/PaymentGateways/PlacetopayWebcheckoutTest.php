<?php

namespace Tests\Feature\PaymentGateways;

use App\Constants\PlacetopayStatusResponses;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\PaymentGateways\PlacetopayWebCheckout;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PlacetopayWebcheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_get_a_redirect_url_as_response(): void
    {
        $purchaseOrder = $this->createPurchaseOrder();
        Http::fake([
            'https://dev.placetopay.com/redirection/*' => Http::response($this->placetopayResponse(),200)
        ]);
        $paymentGateway = new PlacetopayWebCheckout($purchaseOrder,null);

        $response = $paymentGateway->createRequest();

        $this->assertNotNull($response['processUrl']);
    }

    public function test_it_get_request_information(): void
    {
        $placeToPayResponse = $this->placetopayResponse();
        $purchaseOrder = $this->createPurchaseOrder();
        Http::fake([
            'https://checkout-co.placetopay.dev/api/session/123123' => Http::response($placeToPayResponse,200)
        ]);
        $paymentWallet = new PlacetopayWebCheckout($purchaseOrder->id,$placeToPayResponse['requestId']);

        $response= $paymentWallet->getRequestInformation();

        $this->assertEquals($placeToPayResponse['requestId'], $response['requestId']);
    }

    public function test_it_get_request_is_aprroved(): void
    {
        $placeToPayResponse = $this->placetopayResponse(PlacetopayStatusResponses::APPROVED);
        $purchaseOrder = $this->createPurchaseOrder();
        Http::fake([
            'https://checkout-co.placetopay.dev/api/session/123123' => Http::response($placeToPayResponse,200)
        ]);
        $paymentWallet = new PlacetopayWebCheckout($purchaseOrder->id,$placeToPayResponse['requestId']);

        $response= $paymentWallet->getRequestInformation();

        $this->assertEquals($placeToPayResponse['requestId'], $response['requestId']);
    }

    public function test_it_get_request_is_rejected(): void
    {
        $placeToPayResponse = $this->placetopayResponse(PlacetopayStatusResponses::REJECTED);
        $purchaseOrder = $this->createPurchaseOrder();
        Http::fake([
            'https://checkout-co.placetopay.dev/api/session/123123' => Http::response($placeToPayResponse,200)
        ]);
        $paymentWallet = new PlacetopayWebCheckout($purchaseOrder->id,$placeToPayResponse['requestId']);

        $response= $paymentWallet->getRequestInformation();

        $this->assertEquals($placeToPayResponse['requestId'], $response['requestId']);
    }

    public function createPurchaseOrder(): Model
    {
        Customer::factory()->create();

        return PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(1), 'detailsOrder')
            ->create();
    }

    public function placetopayResponse(string $status = PlacetopayStatusResponses::OK): array
    {
        return [
            'status' => [
                'status'=>  $status,
                'reason'=> 'PC',
                'message'=> 'La petición se ha procesado correctamente',
                'date'=> '2021-11-30T15:08:27-05:00',
            ],
            'requestId'=> 123123,
            'processUrl'=> 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
        ];
    }



}
