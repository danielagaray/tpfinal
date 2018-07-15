<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table='profesionales';
    protected $fillable=[
        'nombre',
        'apellido',
        'especialidad', 
        'cargo',       
    ];

    public function medicacion(){
        return $this->hasMany('App\Medicacion','profesional_id');
    }
    public function tratamientos(){
        return $this->hasMany('App\Tratamiento');
    }
    public function consultas(){
        return $this->hasMany('App\Consulta');
    }
    public function consultasMedicas(){
        return $this->hasMany('App\ConsultaMedica','profesional_id');
    }
    public function intervenciones(){
        return $this->hasMany('App\Intervencion');
    }
    //Medico de Cabecera en Ficha Medica
    public function fichaMedica(){
        return $this->hasMany('App\FichaMedica','profesional_id');
    }

}
