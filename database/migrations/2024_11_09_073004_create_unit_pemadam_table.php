<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitPemadamTable extends Migration
{
    public function up()
    {
        Schema::create('unit_pemadam', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit');
            $table->foreignId('wilayah_id')->constrained('wilayah')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_pemadam');
    }
}
