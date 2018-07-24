<?php

namespace App\Http\Controllers;

use App\Consulta;
use App\Asistido;

use App\FichaDatosPersonales;
use App\FichaAdiccion;
use App\FichaAsistenciaSocial;
use App\FichaDiagnosticoIntegral;
use App\FichaEducacion;
use App\FichaEmpleo;
use App\FichaLegal;
use App\FichaLocalizacion;
use App\FichaNecesidad;
use App\FichaMedica;
use App\FichaSaludMental;
use App\FichaFamiliaAmigos;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConsultaController extends Controller
{

    public function __construct () {

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $consulta = new Consulta([
            'mensaje' => $request->mensaje,
            'user_id' => Auth::user()->id,
        ]);

        $asistido_id = $request->asistido_id;
        //$url = '/asistido/show2/'.$asistido_id;
        switch ($request->tipo) {

            case 'fichasDatosPersonales':
                $ficha = FichaDatosPersonales::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasAdicciones':
                $ficha = FichaAdiccion::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasAsistenciasSociales':
                $ficha = FichaAsistenciaSocial::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasDiagnosticosIngegrales':
                $ficha = FichaDiagnosticoIntegral::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasEducaciones':
                $ficha = FichaEducacion::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasEmpleos':
                $ficha = FichaEmpleo::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasFamiliaAmigos':
                $ficha = FichaFamiliaAmigos::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasLegales':
                $ficha = FichaLegal::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasLocalizacion':
                $ficha = FichaLocalizacion::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasMedicas':
                $ficha = FichaMedica::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasSaludMental':
                $ficha = FichaSaludMental::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasNecesidaddes':
                $ficha = FichaNecesidad::where('asistido_id',$asistido_id)->first();
                break;
        }

        $validation = $request->validate([
            'adjunto' => 'file|mimes:jpeg,png,gif,doc,docx,xls,xlsx,txt,pdf|max:20480'
        ]);

        if (null != $request->file('adjunto')) {
           
            $path = $request->file('adjunto')->store('consultas');
            $consulta->adjunto = $path;
        }
        //$usuarioNotif = Asistido::find($asistido_id)->owner();
        //$usuarioNotif->notify(new NuevaConslta($consulta));
        $ficha->consultas()->save($consulta);
        //return redirect()->route('consulta.list');
        return redirect()->route('asistido.show2',['asistido_id'=>$asistido_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Display the specified resource list.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        echo "<br>";
        $data['consultas'] = Consulta::all();
        return view('consultas.listado', $data);
    }

    public function getView ($asistido_id, $tipo) {

        //Recibe por parametros: consultable_id (el id de la ficha), consultable_type (el tipo de ficha)
        $data['asistido_id'] = $asistido_id;
        $data['tipo'] = $tipo;
        
        switch ($tipo) {
            
            case 'fichasDatosPersonales':
                $ficha = FichaDatosPersonales::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasAdicciones':
                $ficha = FichaAdiccion::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasAsistenciasSociales':
                $ficha = FichaAsistenciaSocial::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasDiagnosticosIngegrales':
                $ficha = FichaDiagnosticoIntegral::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasEducaciones':
                $ficha = FichaEducacion::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasEmpleos':
                $ficha = FichaEmpleo::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasFamiliaAmigos':
                $ficha = FichaFamiliaAmigos::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasLegales':
                $ficha = FichaLegal::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasLocalizacion':
                $ficha = FichaLocalizacion::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasMedicas':
                $ficha = FichaMedica::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasSaludMental':
                $ficha = FichaSaludMental::where('asistido_id',$asistido_id)->first();
                break;

            case 'fichasNecesidaddes':
                $ficha = FichaNecesidad::where('asistido_id',$asistido_id)->first();
                break;
            
            default:
                break;
        
        }

        if (isset($ficha) && !empty($ficha)) {            
            $consultas = $ficha->consultas;
            $data['consultas'] = $consultas;
            $data['ficha'] = $ficha; 
        }


        $view = view('consultas.consultas', $data)->render();

        return response()->json([
            'status' => true,
            'view' => $view,
        ]);
    }

    public function descargarAdjunto ($path) {

        return response()->download($path, "Adjunto");
    }

}
