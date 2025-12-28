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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'category')) {
                $table->enum('category', ['medicine', 'supplement', 'first_aid'])->default('medicine')->after('tag');
            }
            if (!Schema::hasColumn('products', 'requires_prescription')) {
                $table->boolean('requires_prescription')->default(false)->after('prescription_required');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('products', 'requires_prescription')) {
                $table->dropColumn('requires_prescription');
            }
        });
    }
};
