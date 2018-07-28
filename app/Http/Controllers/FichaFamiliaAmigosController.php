<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistido;
use App\Contacto;
use App\FichaFamiliaAmigos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FichaFamiliaAmigosController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaFamiliaAmigos=FichaFamiliaAmigos::where('asistido_id',$asistido_id)->first();
        $relaciones=array('Madre','Padre','Hijo/a','Cónyugue','Amigo');
        if(!empty($fichaFamiliaAmigos)){
            $contactos=Contacto::where('fichaFamiliaAmigos_id',$fichaFamiliaAmigos->id)->get();
            return view('altaFichas.fichaFamiliaAmigos')->with('asistido',$asistido)
                ->with('contactos',$contactos)
                ->with('relaciones',$relaciones)
                ->with('fichaFamiliaAmigos',$fichaFamiliaAmigos);
        }
        return view('altaFichas.fichaFamiliaAmigos')->with('asistido',$asistido)->with('relaciones',$relaciones);
    }

    public function storeContacto(Request $request, $asistido_id){
        $asistido=Asistido::find($asistido_id);
        $asistido->checkFichaFamiliaAmigos=1;
        $fichaFamiliaAmigos=$this->findFichaFamiliaAmigosByAsistidoId($asistido_id);
        $fichaFamiliaAmigos->checklistContactos=1;
        $contacto=new Contacto($request->all());
        $fichaFamiliaAmigos->contactos()->save($contacto);
        $contacto->save();
        $asistido->save();

        return redirect()->route('fichaFamiliaAmigos.create',['asistido_id'=>$asistido_id]);
    }

    public function destroyContacto(Request $request){
        $contacto_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $contacto=Contacto::find($contacto_id);
        $contacto->delete();
        return redirect()->route('fichaFamiliaAmigos.create',['asistido_id'=>$asistido_id]);

    }

    public function findFichaFamiliaAmigosByAsistidoId($asistido_id){
        $fichaFamiliaAmigos=FichaFamiliaAmigos::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaFamiliaAmigos)){
            $fichaFamiliaAmigos=new FichaFamiliaAmigos();
            $fichaFamiliaAmigos->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaFamiliaAmigos);
            $asistido->update(['checkFichaFamiliaAmigos' =>1]);
        }
        return $fichaFamiliaAmigos;

    }
}
