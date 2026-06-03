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
        Schema::table('withdraw', function (Blueprint $table) {
            $table->string('xendit_payout_id')->nullable()->after('nomor_akun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withdraw', function (Blueprint $table) {
            $table->dropColumn('xendit_payout_id');
        });
    }
};
