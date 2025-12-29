<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_id')
                ->constrained()
                ->cascadeOnDelete();

            // Product & variation
            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_variation_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            // Snapshot price (VERY IMPORTANT)
            $table->decimal('price', 10, 2);

            $table->integer('quantity')->default(1);

            $table->timestamps();

            // Prevent duplicate same item in cart
            $table->unique([
                'cart_id',
                'product_id',
                'product_variation_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
