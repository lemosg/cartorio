<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCertidoes extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('certidoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cartorio_id')->unsigned();
            $table->index('cartorio_id');
            $table->foreign('cartorio_id')->references('id')->on('cartorios')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('certidao_type_id')->unsigned();
            $table->index('certidao_type_id');
            $table->foreign('certidao_type_id')->references('id')->on('certidao_types')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('certidoes');
    }
}
