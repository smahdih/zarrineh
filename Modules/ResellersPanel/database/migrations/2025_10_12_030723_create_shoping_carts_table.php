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
        Schema::create('shoping_carts', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('created_by')
                ->nullable()
                ->constrained('shop_users')
                ->cascadeOnDelete();
            $table
                ->foreignId('customer_id')
                ->nullable()
                ->constrained('shop_customers')
                ->cascadeOnDelete();
            $table->string('serial')->unique()->nullable();
            $table->boolean('active')->nullable()->default(1);
            $table->boolean('store')->nullable()->default(0);
            $table->date('delivery_at')->nullable();
            $table->unsignedBigInteger('total_price')->nullable();
            $table->unsignedBigInteger('total_area')->nullable();
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('shoping_carts');
    }
};
