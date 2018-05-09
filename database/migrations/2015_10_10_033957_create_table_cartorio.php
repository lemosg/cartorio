<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCartorio extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cartorios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nome_oficial');
            $table->text('nome_fantasia');
            $table->string('comarca');
            $table->string('entrancia');
            $table->string('cnpj')->unique();
            $table->string('cns')->nullable();
            
            $table->text('endereco');
            $table->text('bairro');
            
            $table->integer('municipio_id')->unsigned();
            $table->index('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('restrict')->onUpdate('cascade');
            
            $table->integer('uf_id')->unsigned();
            $table->index('uf_id');
            $table->foreign('uf_id')->references('id')->on('ufs')->onDelete('restrict')->onUpdate('cascade');
            
            $table->string('cep')->nullable();
            $table->string('nome_titular')->nullable();
            $table->string('nome_substituto')->nullable();
            $table->string('nome_juiz')->nullable();
            $table->string('homepage')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('fax')->nullable();
            $table->longText('horario_funcionamento')->nullable();
            $table->longText('area_abrangencia')->nullable();

            $table->longText('atriuicoes')->nullable();
            $table->longText('observacao')->nullable();

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
