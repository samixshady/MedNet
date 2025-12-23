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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('alias_name'); // e.g., "Home", "Work"
            $table->text('address');
            $table->string('phone')->nullable();
            $table->boolean('is_inside_dhaka')->default(true); // true = inside dhaka, false = outside
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            // User can have up to 5 addresses
            $table->unique(['user_id', 'alias_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
