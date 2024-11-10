<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistikKebakaranTable extends Migration
{
    public function up()
    {
        Schema::create('statistik_kebakaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->onDelete('cascade');
            $table->integer('jumlah_kebakaran')->default(0);
            $table->string('periode'); // e.g., "2024-11" for monthly stats
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('statistik_kebakaran');
    }
}
