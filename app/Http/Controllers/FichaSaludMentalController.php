<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patologia;
use App\FichaSaludMental;
use App\Tratamiento;
use App\Institucion;
use App\EpisodioAgresivo;
use App\Medicacion;
use App\Asistido;
use App\Profesional;
use Illuminate\Support\Facades\Auth;

class FichaSaludMentalController extends Controller
{
    public function __construct () {

        $this->middleware('auth');

    }
    
    public function create($asistido_id){
        $asistido=Asistido::find($asistido_id);
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        $descripciones=array('Esquizofrenia','Paranoia','Bipolaridad','Retraso mental','Autismo','Adicción','Depresión','Otros con causa orgánica');
        
        if(isset($fichaSaludMental)){
            $patologias=Patologia::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $episodiosAgresivos=EpisodioAgresivo::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $tratamientos=Tratamiento::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $medicaciones=Medicacion::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $asistido=Asistido::find($asistido_id);
            return view('altaFichas.fichaSaludMental')
                ->with('asistido',$asistido)
                ->with('patologias',$patologias)
                ->with('episodiosAgresivos',$episodiosAgresivos)
                ->with('fichaSaludMental',$fichaSaludMental)
                ->with('medicaciones',$medicaciones)
                ->with('tratamientos',$tratamientos)
                ->with('descripciones',$descripciones);
        }
        return view('altaFichas.fichaSaludMental')->with('asistido',$asistido)->with('descripciones',$descripciones);
    }

    public function get($asistido_id){

        $asistido=Asistido::find($asistido_id);
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        $descripciones=array('Esquizofrenia','Paranoia','Bipolaridad','Retraso mental','Autismo','Adicción','Depresión','Otros con causa orgánica');

        //En este metodo, traer las colecciones de tratamientos, episodios y adicciones, si existe la ficha
        if(isset($fichaSaludMental)){
            
            $patologias=Patologia::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $episodiosAgresivos=EpisodioAgresivo::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $tratamientos=Tratamiento::where('fichaSaludMental_id',$fichaSaludMental->id)->get();
            $medicaciones=Medicacion::where('fichaSaludMental_id',$fichaSaludMental->id)->get();

            $view = view('altaFichas.fichaSaludMental2')
                ->with('asistido',$asistido)
                ->with('patologias',$patologias)
                ->with('episodiosAgresivos',$episodiosAgresivos)
                ->with('fichaSaludMental',$fichaSaludMental)
                ->with('medicaciones',$medicaciones)
                ->with('tratamientos',$tratamientos)
                ->with('descripciones',$descripciones)
                ->render();
        } else {
            $view = view('altaFichas.fichaSaludMental2')->with('asistido',$asistido)->with('descripciones',$descripciones)->render();
        }
        
        return response()->json([
            'status' => true,
            'view' => $view,
        ]);

    }

    public function storePatologia(Request $request, $asistido_id){
        //falta obtener lo que esta dentro del dropdown , no lo esta agarrando
        //Con update me aseguro de no generar duplicados y solo actualizar el registro existente
        Asistido::where('id',$asistido_id)->update(['checkFichaSaludMental' =>1]);
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        FichaSaludMental::where('asistido_id',$asistido_id)
        ->update(['checkPatologias'=>1]);

        $patologia=new Patologia($request->all());
        //fichaSaludMental_id en la clase adiccion tiene que ser fillable para que funcione con Eloquent
        $fichaSaludMental->patologias()->save($patologia);
        $patologia->save();
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);       
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

    public function destroyPatologia(Request $request){

        $patologia_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $patologia=Patologia::find($patologia_id);
        $patologia->delete();
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);

    }

    public function storeMedicacion(Request $request,$asistido_id){
        //var_dump($request);

        if($request->has('nombre') && $request->has('droga') && ($request->input('nombre')!== null) && ($request->input('droga')!== null)){
            $profesional_input=$request->only(['nombre','apellido']);
            $medicacion_input=$request->only(['recetada','droga','dosis','frecuencia','receta','inicio','fin']);
            $profesional=new Profesional($profesional_input);
            $medicacion=new Medicacion($medicacion_input);
            $profesional->save();
            $profesional->medicacion()->save($medicacion);
        }
        
        if($request->has('droga') && ($request->input('droga')!== null) && ($request->input('nombre')== null)){
            $medicacion_input=$request->only(['recetada','droga','dosis','frecuencia','receta','inicio','fin']);
            $medicacion=new Medicacion($medicacion_input);
            $medicacion->save();
        }
        
        Asistido::where('id',$asistido_id)->update(['checkFichaSaludMental' =>1]);
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        FichaSaludMental::where('asistido_id',$asistido_id)
        ->update(['checkMedicacion'=>1]);
        $fichaSaludMental->medicaciones()->save($medicacion);
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

    public function destroyMedicacion(Request $request){
        
        $medicacion_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $medicacion=Medicacion::find($medicacion_id);
        if(isset($medicacion->profesional)){
            $medicacion->delete();
            $profesional=$medicacion->profesional;
            $profesional->delete();
        }
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

    public function storeTratamiento(Request $request,$asistido_id){
        $tratamiento_input=$request->only(['tipo','inicio','fin','estado','causaDeFin']);
        $tratamiento=new Tratamiento($tratamiento_input);
        if($request->has('droga') && isset($request->droga)){
            $medicacion_input=$request->only(['droga','dosis','frecuencia']);
            $medicacion=new Medicacion($medicacion_input);
            $tratamiento->save();
            $tratamiento->medicaciones()->save($medicacion);
            $medicacion->save();
        }
        if($request->has('nombreInstitucion') && isset($request->nombreInstitucion)){
            $institucion=new Institucion;
            $institucion->nombre=$request->nombreInstitucion;
            $institucion->direccion=$request->direccionInstitucion;
            $institucion->email=$request->emailInstitucion;
            $tratamiento->save();
            $tratamiento->institucion()->save($institucion);

            $institucion->save();
        }
        if($request->has('nombre') && isset($request->nombre)){
            $profesional=new Profesional;
            $profesional->nombre=$request->nombre;
            $profesional->apellido=$request->apellido;
            $profesional->especialidad=$request->especialidadProfesional;
            $profesional->cargo=$request->cargoProfesional;
            $profesional->save();
            $tratamiento->profesional()->associate($profesional);
            $tratamiento->save();
        }

        Asistido::where('id',$asistido_id)->update(['checkFichaSaludMental' =>1]);
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        FichaSaludMental::where('asistido_id',$asistido_id)
        ->update(['checkTratamiento'=>1]);
        $fichaSaludMental->tratamientos()->save($tratamiento);
        $tratamiento->save();
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

    public function destroyTratamiento(Request $request){
        
        $tratamiento_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $tratamiento=Tratamiento::find($tratamiento_id);
        if(isset($tratamiento->medicaciones)){
            $medicacion=$tratamiento->medicaciones;
            $medicacion->delete();
        }
        if(isset($tratamiento->institucion)){
            $institucion=$tratamiento->institucion;
            $institucion->delete();
        }

        $tratamiento->delete();

        if(isset($tratamiento->profesional)){
            $profesional=$tratamiento->profesional;
            $profesional->delete();
        }
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }


    public function storeEpisodioAgresivo(Request $request, $asistido_id){
        $episodioAgresivo=new EpisodioAgresivo($request->all());
        Asistido::where('id',$asistido_id)->update(['checkFichaSaludMental' =>1]);
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        FichaSaludMental::where('asistido_id',$asistido_id)
        ->update(['checkAgresiones'=>1]);
        $fichaSaludMental->episodiosAgresivos()->save($episodioAgresivo);
        $episodioAgresivo->save();
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);     
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    } 

    public function destroyEpisodioAgresivo(Request $request){

        $episodioAgresivo_id=$request->input('id');
        $asistido_id=$request->input('asistidoid');
        $episodioAgresivo=EpisodioAgresivo::find($episodioAgresivo_id);
        $episodioAgresivo->delete();
        //return redirect()->route('fichaSaludMental.create',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

    
    

    public function storeConsideraciones(Request $request,$asistido_id){
        $fichaSaludMental=$this->findFichaSaludMentalByAsistidoId($asistido_id);
        Asistido::where('id',$asistido_id)->update(['checkFichaSaludMental' =>1]);
        $estadoMental=$request->input('estadoMental');

        $ansiedad=$request->input('ansiedad');
        if($ansiedad=='on'){
            $ansiedadValue=1;
        }else{
            $ansiedadValue=0;
        }
        $depresivo=$request->input('depresivo');
        if($depresivo=='on'){
            $depresivoValue=1;
        }else{
            $depresivoValue=0;
        }
        $delirios=$request->input('delirios');
        if($delirios=='on'){
            $deliriosValue=1;
        }else{
            $deliriosValue=0;
        }
        $trastornoCognitivo=$request->input('trastornoCognitivo');
        if($trastornoCognitivo=='on'){
            $trastornoCognitivoValue=1;
        }else{
            $trastornoCognitivoValue=0;
        }
        $requiereDerivacion=$request->input('checkDerivacion');
        if($requiereDerivacion=='on'){
            $requiereDerivacionValue=1;
        }else{
            $requiereDerivacionValue=0;
        }
        $requiereInternacion=$request->input('checkInternacion');
        if($requiereInternacion=='on'){
            $requiereInternacionValue=1;
        }else{
            $requiereInternacionValue=0;
        }
        if($request->has('nombreInstitucion2')){
            $institucion=Institucion::updateOrCreate(
                ['nombre'=>$request->nombreInstitucion2,
                'direccion'=>$request->direccionInstitucion2,
                'email'=>$request->emailInstitucion2,
                'telefono'=>$request->telefonoInstitucion2]);
            $institucion->save();
            $fichaSaludMental->institucion()->save($institucion);
            
        }
        FichaSaludMental::where('asistido_id',$asistido_id)
        ->update(['estadoMental'=>$estadoMental,
        'ansiedad'=>$ansiedadValue,
        'depresivo'=>$depresivoValue,
        'orientado'=>$deliriosValue,
        'trastornoCognitivo'=>$trastornoCognitivoValue,
        'checkDerivacion'=>$requiereDerivacionValue,
        'checkInternacion'=>$requiereInternacionValue]);
        //return redirect()->route('asistido.show',['asistido_id'=>$asistido_id]);
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);

    }

    public function findFichaSaludMentalByAsistidoId($asistido_id){
        $fichaSaludMental=FichaSaludMental::where('asistido_id',$asistido_id)->first();
        $asistido=Asistido::find($asistido_id);
        if(!isset($fichaSaludMental)){
            $fichaSaludMental=new FichaSaludMental();
            $fichaSaludMental->created_by = Auth::user()->id;
            $asistido->ficha()->save($fichaSaludMental);
            $asistido->update(['checkFichaSaludMental' =>1]);
        }
        return $fichaSaludMental;
    }
}
