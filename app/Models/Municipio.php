<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model {
	protected $fillable = [
		'name',
		'codigoibge',
		'uf_id'
	];

	public function uf() {
		return $this->belongsTo('App\Models\Uf');
	}

}
