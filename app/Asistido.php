<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistido extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="asistidos";
    protected $fillable = [
        'nombre','apellido','fechaNacimiento','dni','sexo','direccion','observaciones','foto', 'email','tipo','estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comunidad(){
        return $this->belongsTo('App\Comunidad');
    }

    public function ficha(){
        return $this->hasOne('App\Ficha');
    }

}
