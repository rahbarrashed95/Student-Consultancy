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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no',50);
            $table->string('type',50);
            $table->smallInteger('customer_id');
            $table->smallInteger('user_id');
            $table->date('date')->nullable();
            $table->decimal('discount_amount')->nullable()->default(0);
            $table->decimal('amount')->nullable()->default(0);
            $table->text('note')->nullable();
            $table->string('status',30)->nullable()->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
