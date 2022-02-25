<?php

use App\Constants\CustomerDocumentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum("type", [CustomerDocumentType::CC,CustomerDocumentType::TI,
                                        CustomerDocumentType::CE,CustomerDocumentType::NIT,
                                        CustomerDocumentType::RUT,]);
            $table->string('description',60);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
