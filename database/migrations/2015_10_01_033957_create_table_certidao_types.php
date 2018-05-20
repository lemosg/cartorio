<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCertidaoTypes extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('certidao_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->float('value');
            $table->timestamps();
        });

        # array BASE DATA
        $data = [
            ['nome' => 'Cível', 'value' => '192.10'],
            ['nome' => 'Criminal', 'value' => '192.10'],
            ['nome' => 'Juizado Especial Cível', 'value' => '192.10'],
            ['nome' => 'Juizado Especial Criminal', 'value' => '192.10'],
            ['nome' => 'Nascimentos', 'value' => '192.10'],
            ['nome' => 'Casamentos', 'value' => '192.10'],
            ['nome' => 'Óbitos', 'value' => '192.10'],
            ['nome' => 'Interdições e Tutelas', 'value' => '192.10'],
            ['nome' => 'Notas', 'value' => '192.10'],
            ['nome' => 'Protesto de Títulos', 'value' => '192.10'],
            ['nome' => 'Registro de Imóveis', 'value' => '192.10'],
            ['nome' => 'Registro de Títulos e Documentos', 'value' => '192.10'],
            ['nome' => 'Registro Civil de Pessoas Jurídicas', 'value' => '192.10'],
            ['nome' => 'Registro de Contratos Marítimos', 'value' => '192.10'],
            ['nome' => 'Depositário Público', 'value' => '192.10'],
            ['nome' => 'Distribuidor Extrajudicial', 'value' => '192.10'],
            ['nome' => 'Distribuidor', 'value' => '192.10'],
            ['nome' => 'Infância e Juventude', 'value' => '192.10'],
            ['nome' => 'Família', 'value' => '192.10'],
            ['nome' => 'Execuções Penais', 'value' => '192.10'],
            ['nome' => 'Júri', 'value' => '192.10'],
            ['nome' => 'Acidentes de Tabalho', 'value' => '192.10'],
            ['nome' => 'Acidentes de Trânsito', 'value' => '192.10'],
            ['nome' => 'Registros Públicos', 'value' => '192.10'],
            ['nome' => 'Contador', 'value' => '192.10'],
            ['nome' => 'Partidor', 'value' => '192.10'],
            ['nome' => 'Fazenda Pública', 'value' => '192.10'],
            ['nome' => 'Avaliador', 'value' => '192.10'],
            ['nome' => 'Outras', 'value' => '192.10'],
        ];

        # Insert DATA
        DB::table('certidao_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('certidao_types');
    }
}
