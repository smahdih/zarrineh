<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('cart_id')
                ->nullable()
                ->constrained('shopping_carts')
                ->cascadeOnDelete();
            $table
                ->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete();
            $table->string('serial')->unique()->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('delivered_at')->nullable();
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('quantity')->nullable();
            $table->float('total_area')->nullable();
            $table->text('description')->nullable();
            $table->json('timeline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_orders');
    }
};
