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
        Schema::create('certidao_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->timestamps();
        });

        # array BASE DATA
        $data = [
            ['nome' => 'Cível'],
            ['nome' => 'Criminal'],
            ['nome' => 'Juizado Especial Cível'],
            ['nome' => 'Juizado Especial Criminal'],
            ['nome' => 'Nascimentos'],
            ['nome' => 'Casamentos'],
            ['nome' => 'Óbitos'],
            ['nome' => 'Interdições e Tutelas'],
            ['nome' => 'Notas'],
            ['nome' => 'Protesto de Títulos'],
            ['nome' => 'Registro de Imóveis'],
            ['nome' => 'Registro de Títulos e Documentos'],
            ['nome' => 'Registro Civil de Pessoas Jurídicas'],
            ['nome' => 'Registro de Contratos Marítimos'],
            ['nome' => 'Depositário Público'],
            ['nome' => 'Distribuidor Extrajudicial'],
            ['nome' => 'Distribuidor'],
            ['nome' => 'Infância e Juventude'],
            ['nome' => 'Família'],
            ['nome' => 'Execuções Penais'],
            ['nome' => 'Júri'],
            ['nome' => 'Acidentes de Tabalho'],
            ['nome' => 'Acidentes de Trânsito'],
            ['nome' => 'Registros Públicos'],
            ['nome' => 'Contador'],
            ['nome' => 'Partidor'],
            ['nome' => 'Fazenda Pública'],
            ['nome' => 'Avaliador'],
            ['nome' => 'Outras'],
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
