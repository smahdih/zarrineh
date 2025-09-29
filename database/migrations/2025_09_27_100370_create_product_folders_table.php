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
        Schema::create('product_folders', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();
            $table->text('avatar')->nullable();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->timestamps();

            $table
                ->foreign('folder_id')
                ->references('id')
                ->on('product_folders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_folders');
    }
};
