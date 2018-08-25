<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSatuanMaterialAnak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satuan_material', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('satuan_id')->unsigned();
            $table->integer('material_id')->unsigned();

            $table->foreign('satuan_id')->references('id')->on('satuan');
            $table->foreign('material_id')->references('id')->on('material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('satuan_material');
    }
}
