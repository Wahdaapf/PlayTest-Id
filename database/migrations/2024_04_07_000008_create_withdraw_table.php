<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('withdraw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_admin')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('point');
            $table->integer('rupiah');
            $table->string('metode'); // gopay, dana, ovo, bca
            $table->string('nomor_akun'); // nomor e-wallet / rekening
            $table->string('image')->nullable(); // bukti transfer dari admin
            $table->enum('status', ['pending', 'success', 'rejected'])->default('pending');
            $table->text('catatan')->nullable(); // catatan admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdraw');
    }
};
