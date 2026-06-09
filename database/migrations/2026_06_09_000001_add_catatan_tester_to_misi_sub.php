<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('misi_sub', function (Blueprint $table) {
            $table->text('catatan_tester')->nullable()->after('desc');
            $table->text('alasan_tolak')->nullable()->after('catatan_tester');
        });
    }

    public function down(): void
    {
        Schema::table('misi_sub', function (Blueprint $table) {
            $table->dropColumn(['catatan_tester', 'alasan_tolak']);
        });
    }
};
