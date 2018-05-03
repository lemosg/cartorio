<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertidaoType extends Model {
	protected $fillable = [
		'nome',
	];

	public function certidoes() {
		return $this->belongsToMany('App\Models\Certidoe');
	}

}
