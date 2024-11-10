<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKebakaranTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_kebakaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wilayah_id')->constrained('wilayah')->onDelete('cascade');
            $table->enum('status_laporan', ['belum diproses', 'dalam penanganan', 'selesai']);
            $table->text('deskripsi_laporan')->nullable();
            $table->string('foto_bukti')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_kebakaran');
    }
}
