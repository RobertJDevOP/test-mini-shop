<?php

namespace Database\Seeders;

use App\Constants\CustomerDocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $arrayDocumentType=(new CustomerDocumentType())->toArray();

        DB::table('document_types')->insert([
            ['type' => $arrayDocumentType[0]['type'], 'description' => $arrayDocumentType[0]['description']],
            ['type' => $arrayDocumentType[1]['type'], 'description' => $arrayDocumentType[1]['description']],
            ['type' => $arrayDocumentType[2]['type'], 'description' => $arrayDocumentType[2]['description']],
            ['type' => $arrayDocumentType[3]['type'], 'description' => $arrayDocumentType[3]['description']],
            ['type' => $arrayDocumentType[4]['type'], 'description' => $arrayDocumentType[4]['description']],
        ]);
    }
}
