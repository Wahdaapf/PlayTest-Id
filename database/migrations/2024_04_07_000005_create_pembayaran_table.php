<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_admin')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_paket')->nullable()->constrained('paket')->nullOnDelete();
            $table->foreignId('id_misi')->nullable()->constrained('misi')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
