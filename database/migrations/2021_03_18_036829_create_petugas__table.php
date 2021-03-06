<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('petugas', function (Blueprint $table) {
        $table->increments('id_petugas');
        $table->string('username', 25)->unique();
        $table->string('password', 255);
        $table->string('nama_petugas', 35);
        $table->enum('level', ['admin', 'petugas']);
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petugas');
    }
}
