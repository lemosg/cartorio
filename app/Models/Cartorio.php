<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartorio extends Model {
	protected $fillable = [
		'nome_oficial',
		'nome_fantasia',
		'comarca',
		'entrancia',
		'cnpj',
		'cns',
		'endereco',
		'bairro',
		'municipio_id',
		'uf_id',
		'cep',
		'nome_titular',
		'nome_substituto',
		'nome_juiz',
		'homepage',
		'email',
		'telefone',
		'fax',
		'horario_funcionamento',
		'area_abrangencia',
		'atriuicoes',
		'observacao',
		'data_instalacao',
		'ultima_atualizacao',
	];

	public function municipio() {
		return $this->hasOne('App\Models\Municipio');
	}

	public function uf() {
		return $this->hasOne('App\Models\Uf');
	}

	public function certidoes() {
		return $this->belongsToMany('App\Models\CertidaoType', 'certidoes', 'cartorio_id', 'id', 'certidao_type_id');
	}

}
