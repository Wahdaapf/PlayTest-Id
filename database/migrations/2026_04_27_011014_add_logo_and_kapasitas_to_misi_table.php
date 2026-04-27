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
        Schema::table('misi', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('nama_aplikasi');
            $table->integer('kapasitas')->default(0)->after('point');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('misi', function (Blueprint $table) {
            $table->dropColumn(['logo', 'kapasitas']);
        });
    }
};
