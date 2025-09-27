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
        Schema::create('recurring_holidays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rule');
            $table
                ->enum('type', ['national', 'company', 'custom'])
                ->default('national');
            $table
                ->foreignId('team_id')
                ->nullable()
                ->constrained('teams')
                ->nullOnDelete();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_holidays');
    }
};
