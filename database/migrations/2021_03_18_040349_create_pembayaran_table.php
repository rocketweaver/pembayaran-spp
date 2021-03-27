<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->integer('id_petugas')->unsigned()->nullable();
            $table->char('nisn', 10)->nullable();
            $table->date('tgl_bayar');
            $table->string('bulan_dibayar', 8);
            $table->string('tahun_dibayar', 4);
            $table->integer('id_spp')->unsigned()->nullable();
            $table->unsignedInteger('jumlah_bayar');
        });

        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign('nisn')->references('nisn')->on('siswa')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('id_spp')->references('id_spp')->on('siswa')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
