<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table="tiposUsuarios";
    protected $fillable=[
        'descripcion',
    ];
    
    public function users(){
        return $this->hasMany('App\Users','tipoUsuario_id');
    }
}
