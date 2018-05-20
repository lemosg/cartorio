<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFisico extends Model {
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cpf', 'rg', 'ddd', 'telefone',
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