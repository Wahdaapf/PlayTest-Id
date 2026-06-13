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
        Schema::create('ai_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_misi');
            $table->integer('hari_ke')->nullable();
            $table->longText('result');
            $table->integer('feedback_count')->default(0);
            $table->timestamps();

            $table->foreign('id_misi')->references('id')->on('misi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_reports');
    }
};
