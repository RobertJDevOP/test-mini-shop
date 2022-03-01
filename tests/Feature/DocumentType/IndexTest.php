<?php

namespace Tests\Feature\DocumentType;

use App\Models\DocumentType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_document_type_return_json_structure(): void
    {
        DocumentType::factory()
            ->create();

        $response = $this->getJson('api/v1/documentType');

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'type',
                    'attributes' => [
                        'id' ,
                        'name' ,
                        'desc' ,
                    ]
                ]
            ]
        ]);
    }
}
