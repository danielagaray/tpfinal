<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleo;
use App\FichaEmpleo;
use App\Direccion;
use App\Asistido;
use Illuminate\Support\Facades\Storage;

class FichaEmpleoController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }

    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaEmpleo=FichaEmpleo::where('asistido_id',$asistido_id)->first();
        if(!empty($fichaEmpleo)){
            $empleos=Empleo::where('fichaEmpleo_id',$fichaEmpleo->id)->get();
            return view('altaFichas.fichaEmpleo')->with('empleos',$empleos)
                ->with('asistido',$asistido)
                ->with('fichaEmpleo',$fichaEmpleo);
        }
        return view('altaFichas.fichaEmpleo')->with('asistido',$asistido)->with('fichaEmpleo',$fichaEmpleo);
    }

    
    public function storeEmpleo(Request $request, $asistido_id){

        Asistido::where('id',$asistido_id)->update(['checkFichaEmpleo' =>1]);
        $fichaEmpleo=$this->findFichaEmpleoByAsistidoId($asistido_id);
        $direccionInput=$request->only('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $direccion= new Direccion($direccionInput);
        $input=$request->except('calle','numero','piso','departamento','entreCalles','localidad','provincia','codigoPostal','pais');
        $empleo=new Empleo($input);
        $fichaEmpleo->empleos()->save($empleo);
        $empleo->save();
        $empleo->direccion()->save($direccion);
        return redirect()->route('fichaEmpleo.create',['asistido_id'=>$asistido_id]);
    
    }

    public function storeConsideraciones(Request $request, $asistido_id){

        if($request->input('checklistTieneEmpleo')=='on'){
            $value=1;
        }else{
            $value=0;
        }
        $fichaEmpleo=$this->findFichaEmpleoByAsistidoId($asistido_id);
        Asistido::where('id',$asistido_id)->update(['checkFichaEmpleo' =>1]);
        FichaEmpleo::where('asistido_id',$asistido_id)
        ->update(['checklistTieneEmpleo'=>$value]);
        return redirect()->route('asistido.show',['asistido_id'=>$asistido_id]);
    }


    public function findFichaEmpleoByAsistidoId($asistido_id){
        $fichaEmpleo=FichaEmpleo::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(empty($fichaEmpleo)){
            $fichaEmpleo=new FichaEmpleo();
            $asistido->ficha()->save($fichaEmpleo);
        }
        return $fichaEmpleo;
    }

    public function destroyEmpleo($id,$asistido_id){

        $empleo=Empleo::find($id);
        $direccion=Direccion::where('empleo_id',$id)->first();
        $direccion->delete();
        $empleo->delete();
        
        return redirect()->route('fichaEmpleo.create',['asistido_id'=>$asistido_id]);
    }

}

