<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKategoriMaterialAnak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kategori_material', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('kategori_id')->unsigned();
            $table->integer('material_id')->unsigned();

            $table->foreign('kategori_id')->references('id')->on('tb_kategori');
            $table->foreign('material_id')->references('id')->on('tb_material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_material');
    }
}
