<?php

namespace Tests\Feature\PaymentGateways;

use App\Entities\Product;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\PaymentGateways\PlacetopayWebCheckout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PlacetopayWebcheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_get_a_redirect_url_as_response(): void
    {
        $purchaseOrder = $this->fakeHttpCreateRequest();
        Http::fake([
            'https://dev.placetopay.com/redirection/*' => Http::response($this->placetopayResponse(),200)
        ]);
        $obj = new PlacetopayWebCheckout($purchaseOrder,null);

        $response = $obj->createRequest();

        $this->assertNotNull($response['processUrl']);
    }

    public function fakeHttpCreateRequest()
    {
        Customer::factory()->create();

        return PurchaseOrder::factory()
            ->has(PurchaseOrderDetail::factory()->count(1), 'detailsOrder')
            ->create();
    }

    public function placetopayResponse(): array
    {
        return [
            'status' => [
                'status'=> 'OK',
                'reason'=> 'PC',
                'message'=> 'La petición se ha procesado correctamente',
                'date'=> '2021-11-30T15:08:27-05:00',
            ],
            'requestId'=> 123123,
            'processUrl'=> 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
        ];
    }



}
