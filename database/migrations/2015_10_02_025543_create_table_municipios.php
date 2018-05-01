<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMunicipios extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codigoibge');
            $table->string('nome');
            $table->integer('uf_id');
            $table->foreign('uf_id')->references('id')->on('ufs')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('municipios');
    }
}
