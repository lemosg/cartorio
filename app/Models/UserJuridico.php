<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJuridico extends Model {
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cnpj', 'razao_social', 'nome_solicitante', 'cpf_solicitante', 'rg_solicitante', 'ddd', 'telefone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user() {
        return $this->hasOne('App\Models\User');
    }
}