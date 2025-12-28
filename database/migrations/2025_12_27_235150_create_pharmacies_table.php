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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->string('owner_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->text('address');
            $table->string('trade_license_number')->unique();
            $table->date('trade_license_date');
            $table->date('license_expiry_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'banned'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
