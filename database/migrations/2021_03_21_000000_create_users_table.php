<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('id_petugas')->nullable()->unsigned();
            $table->char('nisn')->nullable();
            $table->string('username', 25);
            $table->string('password', 255);
            $table->enum('level', ['admin', 'petugas', 'siswa']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
            $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
