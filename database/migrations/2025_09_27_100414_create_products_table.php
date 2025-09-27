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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->foreignId('procedure_id')->constrained('procedures');
            $table->foreignId('product_group_id')->nullable()->constrained('product_groups');
            $table->foreignId('folder_id')->nullable()->constrained('product_folders');
            $table->enum('type', ['TEST', 'ORDER', 'PRODUCT']);
            $table->enum('state', ['DRAFT', 'ACTIVE', 'ARCHIVED']);
            $table->text('description')->nullable();
            $table->json('timeline')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
