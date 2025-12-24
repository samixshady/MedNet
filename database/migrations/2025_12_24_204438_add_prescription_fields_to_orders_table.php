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
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('prescription_required')->default(false)->after('order_status');
            $table->string('prescription_status')->default('pending')->after('prescription_required'); // pending, approved, rejected
            $table->text('prescription_rejection_reason')->nullable()->after('prescription_status');
            $table->timestamp('prescription_reviewed_at')->nullable()->after('prescription_rejection_reason');
            $table->unsignedBigInteger('prescription_reviewed_by')->nullable()->after('prescription_reviewed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'prescription_required',
                'prescription_status',
                'prescription_rejection_reason',
                'prescription_reviewed_at',
                'prescription_reviewed_by'
            ]);
        });
    }
};
