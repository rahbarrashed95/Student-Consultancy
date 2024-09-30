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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('sub_title',200)->nullable();
            $table->string('title',200)->nullable();
            $table->text('description')->nullable();
            $table->string('slider_image',200)->nullable();
            $table->string('human_image',200)->nullable();
            $table->string('layer1_image',200)->nullable();
            $table->string('layer2_image',200)->nullable();
            $table->string('layer3_image',200)->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
