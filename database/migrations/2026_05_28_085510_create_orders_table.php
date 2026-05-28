<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // pembeli
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // total semua harga
            $table->integer('total_price');

            // pending, paid, completed, dll
            $table->string('status')
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};