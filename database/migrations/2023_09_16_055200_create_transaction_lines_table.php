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
        Schema::create('transaction_lines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->decimal('quantity', 4,2)->nullable()->default(0);
            $table->decimal('price', 8,2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_lines');
    }
};
