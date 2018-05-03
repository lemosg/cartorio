<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model {
	protected $fillable = [
		'name',
		'sigla',
	];

	public function municipios() {
		return $this->hasMany('App\Models\Municipio');
	}

}
