<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            // order induk
            $table->foreignId('order_id')
                  ->constrained()
                  ->onDelete('cascade');

            // buku yang dibeli
            $table->foreignId('book_id')
                  ->constrained()
                  ->onDelete('cascade');

            // harga saat checkout
            $table->integer('price');

            // jumlah beli
            $table->integer('quantity');

            // total per item
            $table->integer('subtotal');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};