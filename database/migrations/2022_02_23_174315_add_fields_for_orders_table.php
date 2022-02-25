<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('qty');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('total');
        });

    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
};
