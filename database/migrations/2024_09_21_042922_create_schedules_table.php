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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
            $table->integer('queue_number')->nullable();
            $table->string('complaint');
            $table->enum('payment', ['BPJS', 'tunai', 'asuransi']);
            $table->integer('doctor_id')->references('id')->on('doctors')->onDelete('set null');
            $table->datetime('consultation_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
