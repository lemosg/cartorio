<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUfs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ufs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sigla', 2);
            $table->string('nome');
            $table->timestamps();
        });

        # array BASE DATA
        $data = array(
            array('sigla' => 'AC', 'nome' => 'Acre'),
            array('sigla' => 'AL', 'nome' => 'Alagoas'),
            array('sigla' => 'AP', 'nome' => 'Amapá'),
            array('sigla' => 'AM', 'nome' => 'Amazonas'),
            array('sigla' => 'BA', 'nome' => 'Bahia'),
            array('sigla' => 'CE', 'nome' => 'Ceará'),
            array('sigla' => 'DF', 'nome' => 'Distrito Federal'),
            array('sigla' => 'ES', 'nome' => 'Espírito Santo'),
            array('sigla' => 'GO', 'nome' => 'Goiás'),
            array('sigla' => 'MA', 'nome' => 'Maranhão'),
            array('sigla' => 'MT', 'nome' => 'Mato Grosso'),
            array('sigla' => 'MS', 'nome' => 'Mato Grosso do Sul'),
            array('sigla' => 'MG', 'nome' => 'Minas Gerais'),
            array('sigla' => 'PA', 'nome' => 'Pará'),
            array('sigla' => 'PB', 'nome' => 'Paraíba'),
            array('sigla' => 'PR', 'nome' => 'Paraná'),
            array('sigla' => 'PE', 'nome' => 'Pernambuco'),
            array('sigla' => 'PI', 'nome' => 'Piauí'),
            array('sigla' => 'RJ', 'nome' => 'Rio de Janeiro'),
            array('sigla' => 'RN', 'nome' => 'Rio Grande do Norte'),
            array('sigla' => 'RS', 'nome' => 'Rio Grande do Sul'),
            array('sigla' => 'RO', 'nome' => 'Rondônia'),
            array('sigla' => 'RR', 'nome' => 'Roraima'),
            array('sigla' => 'SC', 'nome' => 'Santa Catarina'),
            array('sigla' => 'SP', 'nome' => 'São Paulo'),
            array('sigla' => 'SE', 'nome' => 'Sergipe'),
            array('sigla' => 'TO', 'nome' => 'Tocantins'),
        );

        # Insert DATA
        DB::table('ufs')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ufs');
    }
}
