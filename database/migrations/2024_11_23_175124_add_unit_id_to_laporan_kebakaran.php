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
        Schema::table('laporan_kebakaran', function (Blueprint $table) {
            $table->foreignId('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('unit_pemadam')->onDelete('set null');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('no_hp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kebakaran', function (Blueprint $table) {
            $table->dropColumn('unit_id');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('no_hp');
        });
    }
};
