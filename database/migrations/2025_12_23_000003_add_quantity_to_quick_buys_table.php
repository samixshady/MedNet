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
        Schema::table('quick_buys', function (Blueprint $table) {
            // Add quantity column (default 1 for existing records)
            $table->integer('quantity')->default(1)->after('product_id');
            
            // Add user details denormalization for faster queries
            $table->string('user_name')->nullable()->after('quantity');
            $table->string('user_email')->nullable()->after('user_name');
            
            // Add indexes for better query performance
            $table->index('user_id');
            $table->index('product_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quick_buys', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('user_name');
            $table->dropColumn('user_email');
            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['created_at']);
        });
    }
};
