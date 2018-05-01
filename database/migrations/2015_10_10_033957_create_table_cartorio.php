<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUfs extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cartorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_oficial');
            $table->string('nome_fantasia');
            $table->string('comarca');
            $table->string('entrancia');
            $table->string('cnpj');
            $table->string('cns')->nullable();
            
            $table->string('endereco');
            $table->string('bairro');
            $table->integer('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('uf_id');
            $table->foreign('uf_id')->references('id')->on('ufs')->onDelete('restrict')->onUpdate('cascade');
            $table->string('cep')->nullable();

            $table->string('nome_titular')->nullable();
            $table->string('nome_substituto')->nullable();
            $table->string('nome_juiz')->nullable();
            $table->string('homepage')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('fax')->nullable();
            $table->string('horario_funcionamento')->nullable();
            $table->string('area_abrangencia')->nullable();

            $table->string('atriuicoes')->nullable();
            $table->string('observacao')->nullable();

            $table->date('data_instalacao');
            $table->date('ultima_atualizacao');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('cartorios');
    }
}
