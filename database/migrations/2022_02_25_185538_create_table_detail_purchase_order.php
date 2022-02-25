<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_purchase_order', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('qty');
            $table->unsignedBigInteger('price');
            $table->foreign('purchase_order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_purchase_order');
    }
};
