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
        Schema::create('log_status_laporan', function (Blueprint $table) {
            $table->foreignId('laporan_id')->references('id')->on('laporan_kebakaran')->onDelete('cascade');
            $table->enum('status_laporan', ['received','in_progress', 'dispatched', 'completed']);
            $table->foreignId('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_status_laporans');
    }
};
