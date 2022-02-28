<?php

namespace Tests\Feature\PaymentGateways;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlacetopayWebcheckout extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
