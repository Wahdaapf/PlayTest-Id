<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 15, 2);
            $table->decimal('fee', 15, 2);
            $table->text('desc')->nullable();
            $table->boolean('most_popular')->default(false);
            $table->integer('point')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
