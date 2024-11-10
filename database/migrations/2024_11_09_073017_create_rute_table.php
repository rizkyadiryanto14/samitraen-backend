<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuteTable extends Migration
{
    public function up()
    {
        Schema::create('rute', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan_kebakaran')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users')->onDelete('cascade');
            $table->text('rute_tercepat')->nullable(); // JSON array of coordinates
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rute');
    }
}
