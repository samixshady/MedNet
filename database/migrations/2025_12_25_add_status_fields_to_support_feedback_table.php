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
        Schema::table('support_feedback', function (Blueprint $table) {
            $table->enum('status', ['pending', 'resolved'])->default('pending')->after('message');
            $table->boolean('is_pinned')->default(false)->after('status');
            $table->boolean('is_urgent')->default(false)->after('is_pinned');
            $table->timestamp('resolved_at')->nullable()->after('is_urgent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('support_feedback', function (Blueprint $table) {
            $table->dropColumn(['status', 'is_pinned', 'is_urgent', 'resolved_at']);
        });
    }
};
