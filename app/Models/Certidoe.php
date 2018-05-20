<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certidoe extends Model {
	protected $fillable = [
		'cartorio_id',
		'certidao_type_id',
	];

	public function type() {
		return $this->hasOne('App\Models\CertidaoType');
	}
}
