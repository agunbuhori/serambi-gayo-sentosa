<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_gudang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan')->nullable();
            $table->integer('barang_id')->unsigned();
            $table->smallInteger('kategori_id')->unsigned();
            $table->integer('gudang_id')->unsigned();
            $table->string('jenis')->nullable();
            $table->date('tanggal')->nullable();
            $table->text('angka')->nullable();
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('gudang_id')->references('id')->on('gudang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_gudang');
    }
}
