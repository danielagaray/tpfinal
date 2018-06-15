@extends('layouts.adminApp')
@extends('scripts.googleMaps')


@section('title')
	Ficha Localización
@endsection

@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<style type="text/css">
		
		.pac-container {

			z-index: 99999;
		}

	</style>

@endsection

@section('pageHeader')
<h1>
	Ficha Localización
</h1>

@endsection

@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-10 col-md-offset-1">
    <div class="box-body">
      <div class="box-group">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">
              <a data-toggle="collapse" href="#collapseOne">
                Localización o Zona de Permanencia
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body ">
                
              @if(isset($fichaLocalizacion)>0)
              
                @foreach($localizaciones as $localizacion)
                  <div class="box-tools pull-right">
                    <a href="{{ route('FichaLocalizacion.destroyLocalizacion',['id'=>$localizacion->id,'asistido_id'=>$asistido->id,$localizacion->localizacionOZona => 'localizacionOZona'])}}" class="descartarBtn" data-id="{{$localizacion->id}}" data-toggle="tooltip" data-title="Descartar Localización habitual">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  
                  <span>Localización Habitual</span>
                  <dl class="dl-horizontal" >
                    @if(isset($localizacion->direccion->calle))
                    <dt>Calle</dt>
                    <dd>{{$localizacion->direccion->calle}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->numero))
                    <dt>Número</dt>
                    <dd>{{$localizacion->direccion->numero}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->piso))
                    <dt>Piso</dt>
                    <dd>{{$localizacion->direccion->piso}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->departamento))
                    <dt>Departamento</dt>
                    <dd>{{$localizacion->direccion->departamento}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->entreCalles))
                    <dt>Entre calles</dt>
                    <dd>{{$localizacion->direccion->entreCalles}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->localidad))
                    <dt>Localidad</dt>
                    <dd>{{$localizacion->direccion->localidad}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->provincia))
                    <dt>Provincia</dt>
                    <dd>{{$localizacion->direccion->provincia}}</dd>
                    @endif
                    
                    @if(isset($localizacion->vivienda))
                    <dt>Tipo de vivienda</dd>
                    <dd>{{$localizacion->vivienda}}</dd>
                    @endif

                    @if(isset($localizacion->referenteNombre))
                    <dt>Referente de vivienda</dd>
                    <dd>{{$localizacion->referenteNombre}}</dd>
                    @endif

                    @if(isset($localizacion->referenteTelefono))
                    <dt>Teléfono referente</dd>
                    <dd>{{$localizacion->referenteTelefono}}</dd>
                    @endif

                    @if(isset($localizacion->referenteEmail))
                    <dt>E-mail referente</dd>
                    <dd>{{$localizacion->referenteEmail}}</dd>
                    @endif

                  </dl>
                @endforeach
                @endif 


                @if(isset($fichaLocalizacion)>0)
              
                @foreach($zonas as $zona)
                  <div class="box-tools pull-right">
                    <a href="{{ route('FichaLocalizacion.destroyLocalizacion',['id'=>$localizacion->id,'asistido_id'=>$asistido->id,$localizacion->localizacionOZona => 'localizacionOZona'])}}" class="descartarBtn" data-id="{{$localizacion->id}}" data-toggle="tooltip" data-title="Descartar Localización habitual">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  <span>Zona de permanencia</span>
                  <br>
                  <dl class="dl-horizontal" >

                    @if(isset($zona->zona))
                    <dt>Zona habitual</dt>
                    <dd>{{$zona->zona}}</dd>
                    @endif

                    @if(isset($zona->direccion->calle))
                    <dt>Calle</dt>
                    <dd>{{$zona->direccion->calle}}</dd>
                    @endif
                    @if(isset($zona->direccion->numero))
                    <dt>Número</dt>
                    <dd>{{$zona->direccion->numero}}</dd>
                    @endif
                    @if(isset($zona->direccion->piso))
                    <dt>Piso</dt>
                    <dd>{{$zona->direccion->piso}}</dd>
                    @endif
                    @if(isset($zona->direccion->departamento))
                    <dt>Departamento</dt>
                    <dd>{{$zona->direccion->departamento}}</dd>
                    @endif
                    @if(isset($zona->direccion->entreCalles))
                    <dt>Entre calles</dt>
                    <dd>{{$zona->direccion->entreCalles}}</dd>
                    @endif
                    @if(isset($zona->direccion->localidad))
                    <dt>Localidad</dt>
                    <dd>{{$zona->direccion->localidad}}</dd>
                    @endif
                    @if(isset($zona->direccion->provincia))
                    <dt>Provincia</dt>
                    <dd>{{$zona->direccion->provincia}}</dd>
                    @endif

           
                    @if(isset($zona->puntosDeReferencia))
                    <dt>Puntos de referencia</dd>
                    <dd>{{$zona->puntosDeReferencia}}</dd>
                    @endif

                    @if(isset($zona->dias))
                    <dt>Días</dd>
                    <dd>{{$zona->dias}}</dd>
                    @endif

                    @if(isset($zona->de))
                    <dt>Desde</dd>
                    <dd>{{$zona->de}}</dd>
                    @endif

                    @if(isset($zona->hasta))
                    <dt>Hasta</dd>
                    <dd>{{$zona->hasta}}</dd>
                    @endif

                    @if(isset($zona->observaciones))
                    <dt>Observaciones</dd>
                    <dd>{{$zona->observaciones}}</dd>
                    @endif

                  </dl>
                @endforeach
                @endif 
              <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Localización Habitual o Zona de permanencia</a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> Agregar Localización Habitual o Zona de Permanencia </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
              <form id="nuevoContacto-form" method="POST" action="{{ route('FichaLocalizacion.storeLocalizacion',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">


                    <div class="form-group col-md-12 localizacionOZona">
                        {!! Form::Label('localizacionOZona', 'Agregar localización habitual o zona de permanencia') !!}
                        <select class="form-control" name="localizacionOZona" id="localizacionOZona" required>
                            <option selected="selected" value="Localizacion" >Localización</option>
                            <option value="Zona" >Zona de permanecia</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-12">Ubicación</label>
                        <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false" >
                        <p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Calle</label>
                        <input class="form-control" id="route" name="calle" required></input>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Número</label>
                        <input class="form-control" id="street_number" name="numero"></input>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Piso</label>
                        <input class="form-control" name="piso"></input>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Dpto</label>
                        <input class="form-control" name="departamento"></input>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Localidad</label>
                        <input class="form-control" id="locality" name="localidad"></input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>CP</label>
                        <input class="form-control" id="postal_code" name="codigoPostal"></input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Provincia</label>
                        <input class="form-control" id="administrative_area_level_1" name="provincia"></input>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Pais</label>
                        <input class="form-control" id="country" name="pais"></input>
                    </div>

                    <input class="form-control" id="lat" name="lat" style="display: none;"></input>
                    <input class="form-control" id="lng" name="lng" style="display: none;"></input>

                    <div class="form-group col-md-12">
                        <label>Mas detalles (entre calles o puntos de referencia)</label>
                        <input class="form-control" name="entreCalles"></input>
                    </div>
                            
                   
              
                    <div class="localizacion">
                        <div class="form-group col-md-12">
                            {!! Form::Label('condicion', 'Condición') !!}
                            <select class="form-control" name="condicion" id="condicion" required>
                                <option value="Calle">Situación de calle</option>
                                <option selected="selected" value="Vivienda" >Vivienda</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12 vivienda">
                            {!! Form::Label('vivienda', 'Vivienda') !!}
                            <select class="form-control" name="vivienda" id="vivienda" >
                                <option value="Casa" selected="selected">Casa</option>
                                <option value="Departamento">Departamento</option>
                                <option value="Hotel">Hotel/Hostel</option>
                            </select>
                        </div>

                        <div class="referente">

                            <div class="form-group col-md-12 tipo">
                                {!! Form::Label('tipo', 'Tipo') !!}
                                <select class="form-control" name="tipo" id="tipo" >
                                    <option value="Propietario">Propietario</option>
                                    <option value="Inquilino">Inquilino</option>
                                    <option value="Familiar">Familiar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('referenteNombre') ? ' has-error' : '' }}">
                                <label for="referenteNombre">Nombre del encargado de la vivienda</label>
                                <input type="text" class="form-control" id="referenteNombre" placeholder="Ingrese nombre y apellido de un referente de la vivienda" name="referenteNombre">
                                @if ($errors->has('referenteNombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referenteNombre') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('referenteTelefono') ? ' has-error' : '' }}">
                                <label for="referenteTelefono">Teléfono del encargado de la vivienda</label>
                                <input type="text" class="form-control" id="referenteTelefono" placeholder="Ingrese un teléfono del referente de la vivienda" name="referenteTelefono">
                                @if ($errors->has('referenteTelefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referenteTelefono') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('referenteEmail') ? ' has-error' : '' }}">
                                <label for="referenteEmail">E-mail del encargado de la vivienda</label>
                                <input type="email" class="form-control" id="referenteEmail" placeholder="Ingrese un e-mail del referente de la vivienda" name="referenteEmail">
                                @if ($errors->has('referenteEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referenteEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> <!--cierra referente -->
                    </div> <!--cierra la localizacion para ajax-->

                    <div class="zona">
                        <span class="col-md-12">Ingrese días y horarios en que el asistido se encuentra en la zona de permanencia</span>
                        <br>
                        <div class="form-group col-md-12 {{ $errors->has('dia') ? ' has-error' : '' }}">
                            <label for="dia">Días</label>
                            <input type="text" class="form-control" id="dia" placeholder="Ingrese días" name="dia">
                            @if ($errors->has('dia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dia') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('de') ? ' has-error' : '' }}">
                            <label for="de">Desde</label>
                            <input type="text" class="form-control" id="de" placeholder="Ingrese desde que horario se encuentra" name="de">
                            @if ($errors->has('de'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('de') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('hasta') ? ' has-error' : '' }}">
                            <label for="hasta">Hasta</label>
                            <input type="text" class="form-control" id="hasta" placeholder="Ingrese hasta que horario se encuentra" name="hasta">
                            @if ($errors->has('hasta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hasta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> <!--cierra la zona de permanencia para ajax-->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Agregar </button>
                </div>
                </form>
            </div>
            </div>
        </div>
        
        </div>




        
    </div>
    </div>
</div>
@endsection

@section('scripts') 

  @include('scripts.googleMaps')

  <script type="text/javascript">

    window.onload=function(){

        $('#localizacionOZona').val('Localizacion');
        $('.localizacion').show();
        $('.zona').hide();
        //select condicion tiene q ser vivienda
        $('#condicion').val('Vivienda');
        //vivienda por defecto casa vivienda  Casa
        $('#vivienda').val('Casa');
        //referente mostrar
        $('.referente').show();
    }

  $('#localizacionOZona').change(function () {

    if ($(this).val() == 'Localizacion') {
        $('.localizacion').show();
        $('.zona').hide();

    } else {

        $('.zona').show();
        $('.localizacion').hide();

    } 
    });
    
    $('#condicion').change(function () {

      if ($(this).val() == 'Vivienda') {

        $('.vivienda').show();
        $('.referente').show();
        $('.tipo').show();

      } else {

        $('.vivienda').hide();
        $('.referente').hide();
        $('.tipo').hide();
    
      } 
    });

    $('#vivienda').change(function () {

    if ($(this).val() == 'Casa' || $(this).val() == 'Departamento') {

        $('.referente').show();

    } else {

        $('.referente').hide();

    } 
    });

  </script>

@endsection