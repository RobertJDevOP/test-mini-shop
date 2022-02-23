<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('requestId')->nullable();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->string('processUrl')->nullable();
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
            $table->dropColumn('user_id');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('requestId');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('processUrl');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
};
