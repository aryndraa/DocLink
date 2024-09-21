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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->integer('number');
            $table->integer('specialist_id');
            $table->foreign('specialist_id')->references('id')->on('specialists')->onDelete('set null');
            $table->enum('working_days', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggun']);     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
