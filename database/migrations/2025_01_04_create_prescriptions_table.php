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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('notes')->nullable();
            $table->string('doctor_name')->nullable();
            $table->date('prescription_date');
            $table->date('next_visit_date')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('prescription_date');
            $table->index('next_visit_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
