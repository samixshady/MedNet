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
            $table->string('name')->required();
            $table->text('description')->required();
            $table->integer('quantity')->required();
            $table->date('expiry_date')->required();
            $table->string('dosage')->required();
            $table->string('tag')->required(); // medicine, supplement, first_aid
            $table->decimal('price', 8, 2)->required();
            $table->boolean('prescription_required')->default(false);
            $table->string('manufacturer')->required();
            $table->text('side_effects')->nullable();
            $table->integer('low_stock_threshold')->default(10);
            $table->string('image_path')->nullable();
            $table->enum('stock_status', ['normal', 'low_stock', 'out_of_stock'])->default('normal');
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
