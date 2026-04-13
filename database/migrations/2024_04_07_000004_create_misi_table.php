<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('misi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_paket')->constrained('paket')->cascadeOnDelete();
            $table->string('nama_aplikasi');
            $table->string('link_aplikasi')->nullable();
            $table->text('instruksi')->nullable();
            $table->string('status')->default('pending');
            $table->integer('point')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('misi');
    }
};
