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
        Schema::table('carts', function (Blueprint $table) {
            // Rename prescription_file to prescription_file_path for consistency
            if (Schema::hasColumn('carts', 'prescription_file')) {
                $table->renameColumn('prescription_file', 'prescription_file_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'prescription_file_path')) {
                $table->renameColumn('prescription_file_path', 'prescription_file');
            }
        });
    }
};
