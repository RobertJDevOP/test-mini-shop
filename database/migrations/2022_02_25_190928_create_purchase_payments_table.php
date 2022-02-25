<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('purchase_payment', function (Blueprint $table) {
            $table->bigIncrements('id_purchase_payment');
            $table->unsignedBigInteger('id_purchase_order');
            $table->string('status');
            $table->integer('requestId')->nullable();
            $table->string('processUrl')->nullable();
            $table->foreign('id_purchase_order')->references('id')->on('orders');;
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_payment');
    }
};
