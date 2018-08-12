
@extends(false ? 'layouts.adminApp' : 'layouts.userApp')

@section('title')
	Alerta
@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-bullhorn fa-fw"></i>Alertas
	<small>Nueva Alerta</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bullhorn"></i> Alertas</a></li>
	<li class="active">Nueva</li>
</ol>
@endsection

@section('content')

<style type="text/css">
  
  .seleccionado {
    background: #f0c7c7; 
    border-radius: 8px;
    box-shadow: 3px 3px 16px #272634;
  }

  .cercano:hover {
    background: #f0c7c7; 
    border-radius: 8px; 
  }

  @media (max-width: 992px) { 

    .users-list > li {
      width: 50%;
      /*float: left;*/
      /*padding: 10px;*/
      /*text-align: center;*/
    }
  }

</style>

<div class="row rowPaso rowPaso1">
  <div class="col-md-10 col-md-offset-1">
    
    <h3>Paso 1 <small>INGRESÁ LOS DATOS DE LA PERSONA EN SITUACIÓN DE VULNERABILIDAD</small></h3>

    <div class="box box-solid">
      <div class="box-body">
        
        <div class="col-md-10 col-md-offset-1">
          <h1><small><i class="icon fa fa-fw fa-user"></i> DATOS DEL ASISTIDO</small></h1>

            <h2 class="text-center">
              <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                  <span class="fa fa-circle fa-stack-2x" style="color: black"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      1    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      2    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      3    
                  </strong>
              </span>
            </h2>

        </div>
        
        <div class="col-md-8 col-md-offset-2">

          <div class="form-group">
            <label>NOMBRE *</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre (obligatorio)" name="nombre" maxlength="250" required>
            <input type="hidden" class="form-control" id="institucion_id" name="institucion_id" value="">
            <input type="hidden" class="form-control" id="lat" name="lat" value="">
            <input type="hidden" class="form-control" id="lng" name="lng" value="">
          </div>

          <div class="form-group">
            <label>APELLIDO *</label>
            <input type="text" class="form-control" id="apellido" placeholder="Apellido (obligatorio)" name="apellido" maxlength="250" required>
          </div>

          <div class="form-group">
            <label>DNI *</label>
            <input type="text" class="form-control" id="documento" placeholder="Documento (obligatorio)" name="dni"  maxlength="10" required>
          </div>

          <div class="form-group">
            <label>FECHA DE NACIMIENTO</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
          </div>

          <div class="form-group">
            <label>OBSERVACIONES</label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" maxlength="250" placeholder="Este campo es opcional. Agregá acá cuaquier otra información que creas relevante al caso."></textarea>
          </div>

          <p class="help-block"> <i class="fa icon fa-exclamation-circle"></i> Tratá de ser lo mas completo posible, ya que con esta información nos va a ser mas fácil identificar y hacer un mejor seguimiento del caso cuando la persona se presente en un Posadero.</p>
          <br>


        </div>


        <div class="col-md-8 col-md-offset-1">
          <button type="button" class="btn btn-primary pull-right" id="confirmPaso1">SIGUIENTE <i class="fa icon fa-chevron-right"></i></button>
        </div>

      </div> 
    </div>
  </div>
</div>

<div class="row rowPaso rowPaso2" style="display: none;">
  <div class="col-md-10 col-md-offset-1">
    
    <h3>Paso 2 <small>DERIVALO A UN CENTRO DE AYUDA PARA QUE RECIBA ASISTENCIA</small></h3>

    <div class="box box-solid">
      <div class="box-body">
        
        <div class="col-md-10 col-md-offset-1">
          <h1>
            <small>
              <img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 30px;">
              SELECCIONÁ UN POSADERO
              <small><br class="visible-xs"> <a href="#" id="posaderoPopover">  ¿Qué es un Posadero? <i class="fa icon fa-question-circle"></i> </a></small>
              <div id="posaderoPopoverContent" style="display: none;">
                <h5 class="text-center text-black"><img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 20px;"> Red del Posadero</h5>
                <p>El Posadero brinda una atención integral, mediante un equipo multidisciplinario de profesionales de la salud, asistencia social y jurídica, y procede a elaborar un primer diagnóstico del asistido.</p>
                <p>A partir de diversas entrevistas, el Posadero trabaja en la promoción, reinserción y contención del necesitado.</p>
                <p class="text-center"><a href="http://www.lumencor.com.ar/index.php#red">Hacé click acá para saber más!</a></p>
              </div>
            </small>
          </h1>

            <h2 class="text-center">
              <span class="fa-stack" style="cursor: pointer;">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      1    
                  </strong>
              </span>
              <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                  <span class="fa fa-circle fa-stack-2x" style="color: black;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      2    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      3    
                  </strong>
              </span>
            </h2>

        </div>
        
        <div class="col-md-8 col-md-offset-2">
  
          <div class="form-group buscaCercano">
            <label>SELECCIONÁ EL POSADERO MAS CERCANO</label>
            
            <div class="box-body no-padding">
              <ul class="users-list clearfix cercanos">

                <div class="text-center loadingCercanos">
                  <br>
                  <i class="icon fa fa-spinner fa-spin fa-4x"></i>
                  <p class="text-muted" style="margin-top: 5px;">Información de Geolocalización no disponible</p>
                  <br><br><br><br>
                </div>
               
              </ul>

            </div>

            <p class="help-block"> <a href="javascript:void(0)" class="mostrarLista">O HACE CLICK ACÁ PARA BUSCÁR EN LA LISTA COMPLETA</a> </p>
          </div>

          <div class="form-group buscaLista" style="display: none;">
            <label>BUSCÁ EN LA LISTA</label>
            <select class="form-control select2 selectPosadero" style="width: 100%;">

              <?php foreach ($instituciones as $institucion): ?>

                <?php
                  $l = '';

                  if (isset($institucion->direccion->calle))
                    $l .= $institucion->direccion->calle;
                  if (isset($institucion->direccion->numero))
                    $l .= ' '.$institucion->direccion->numero;

                  if (isset($institucion->direccion->piso))
                    $l .= ' Piso '.$institucion->direccion->piso;
                  if (isset($institucion->direccion->departamento))
                    $l .= ' '.$institucion->direccion->departamento;

                  if (isset($institucion->direccion->localidad))
                    $l .= ', '.$institucion->direccion->localidad;
                  if (isset($institucion->direccion->provincia))
                    $l .= ', '.$institucion->direccion->provincia;
                ?>

                <option value="<?=$institucion->id?>" data-direccion="<?=$l?>" data-telefono="<?=$institucion->telefono?>" data-horarios="<?=$institucion->descripcion?>" data-nombre="<?=$institucion->nombre?>"><?=$institucion->nombre?></option>
              
              <?php endforeach ?>
            
            </select>
            <br>
            <div class="help-block" style="background-color: #352727; color: white; padding: 10px; border-radius: 15px; margin-top: 10px; min-height: 80px;">
              <i class="fa icon fa-map-marker fa-fw"></i> <span class="selectDireccion"></span><br>
              <i class="fa icon fa-phone fa-fw "></i> <span class="selectTelefono"></span><br>
              <i class="fa icon fa-clock-o fa-fw "></i> <span class="selectHorarios"></span>
            </div>
            
            <p class="help-block"> <a href="javascript:void(0)" class="mostrarCercano"> O HACE CLICK ACÁ PARA VER LOS MÁS CERCANOS</a> </p>
          </div>
            

        </div>

        <?php if (isset($comunidades) && count($comunidades)): ?>
        <div class="col-md-8 col-md-offset-2" id="comunidades">
          <br>
          <div class="form-group">
            <label> <i class="icon fa fa-users"></i> COMPARTÍLO CON TU COMUNIDAD! (opcional)</label>
            <i class="icon fa fa-fw"></i> <input type="checkbox" name="checkComunidad" value="1" id="checkComunidad">

            <span id="selectComunidad" style="display: none;">
            <select class="form-control select2" style="width: 100%;" name="comunidad" id="comunidad">
                @foreach($comunidades as $comunidad)
                  <option value="{{$comunidad->id}}">{{$comunidad->nombre}}</option>
                @endforeach
            </select>
            </span>
          </div>
          <br>
        </div>
        <?php endif ?>

        <div class="col-md-8 col-md-offset-1">
          <a href="javascript:void(0)" class="paso1"> <i class="icon fa fa-chevron-left"></i>VOLVER</a>

          <button type="button" class="btn btn-primary pull-right" id="confirmPaso2">SIGUIENTE <i class="fa icon fa-chevron-right"></i></button>
          
          <span class="pull-right" style="margin-right: 15px;"><span id="posaderoSeleccionadoTxt" class="text-muted"></span></span>
        </div>


      </div> 
    </div>
  </div>
</div>

<div class="row rowPaso rowPaso3" style="display: none;">
  <div class="col-md-10 col-md-offset-1">
    
    <h3>Paso 3 <small>CONFIRMACIÓN</small></h3>

    <div class="box box-solid">
      <div class="box-body">
        
        <div class="col-md-10 col-md-offset-1">
          <h1><small><i class="icon fa fa-fw fa-check-circle"></i> CONFIRMÁ LOS DATOS Y ENVIANOS LA INFORMACIÓN</small></h1>

            <h2 class="text-center">
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      1    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      2    
                  </strong>
              </span>
              <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                  <span class="fa fa-circle fa-stack-2x" style="color: black;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      3    
                  </strong>
              </span>
            </h2>

        </div>
        
        <div class="col-md-8 col-md-offset-2">

          <h4><i class="icon fa fa-user"></i> ASISTIDO <small><span class="confirmNombre"></span> <span class="confirmApellido"></span></small></h4>

          <div class="callout bg-gray">
            <p>
              Nombre: <span class="confirmNombre">-</span> <span class="confirmApellido">-</span>
              <br>Documento: <span class="confirmDocumento">-</span>
              <br>Fecha Nacimiento: <span class="confirmFechaNacimiento">-</span>
              <br>Observaciones: <span class="confirmObservaciones">-</span>
            </p>
          </div>

          <h4><img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 20px;"> DERIVAR A <small class="confirmPosadero"></small></h4>
          
          <div class="callout bg-gray">
            <p>
              Informále a la persona que se tiene que presentar en un Posadero para recibir ayuda!
              <br>Acá estan los datos del Posadero al que lo derivaste
              <p class="text-center" style="margin-top: 0px;">
                <img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 15px;"> <span class="confirmPosadero">-</span>
                <br><i class="fa icon fa-map-marker fa-fw"></i> <span class="confirmDireccion">-</span>
                <br><i class="fa icon fa-clock-o fa-fw"></i> <span class="confirmHorario">-</span>
                <br><i class="fa icon fa-phone fa-fw"></i><span class="confirmTelefono">-</span>
              </p>
            </p>
          </div>

          <br>

        </div>

        <div class="col-md-8 col-md-offset-1">
          <a href="javascript:void(0)" class="paso2"> <i class="icon fa fa-chevron-left"></i>VOLVER</a>
          <button type="button" class="btn btn-primary pull-right" id="confirmPaso3">CONFIRMAR Y ENVIAR <i class="fa icon fa-chevron-right"></i></button>
        </div>

      </div> 
    </div>
  </div>
</div>


<div class="row rowPaso rowPaso4Ok" style="display: none;">
  <div class="col-md-10 col-md-offset-1">
    
    <h3>Listo <small> GRACIAS POR TU COLABORACIÓN</small></h3>

    <div class="box box-solid">
      <div class="box-body">
        
        <div class="col-md-10 col-md-offset-1">
          <h1><small><i class="icon fa fa-fw fa-check-circle"></i> ¡GRACIAS! <small>Alerta No. <span id="alerta_id"></span></small></small></h1>

            <h2 class="text-center">
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      1    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      2    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      3    
                  </strong>
              </span>
              <span>
                <img src="{{asset('/img/sent.gif')}}" class="img-circle" style="max-height: 55px;">
              </span>

            </h2>

        </div>
        
        <div class="col-md-8 col-md-offset-2">

          <h4><i class="icon fa fa-envelope-o fa-fw"></i> Te vamos a informar por mail si la persona se presenta al Posadero! </h4>

          <h4 style="margin-top: 15px;"><i class="icon fa fa-exclamation-circle fa-fw"></i> Para hacer un seguimiento de tus alertas hace <a href="">CLICK ACÁ</a></h4>

          <br>

          <h4><i class="icon fa fa-info-circle fa-fw"></i> Si querés involucrarte mas en el seguimiento del caso o querés obtener mas información sobre como ayudar. ¡Sumáte! <a href="">CLICK ACÁ</a></h4>

        </div>


        <div class="col-md-8 col-md-offset-1">
          <a href="{{url('/alert/my_list')}}" class="btn btn-primary pull-right">Ver Mis Alertas</a>
        </div>

      </div> 
    </div>
  </div>
</div>

<div class="row rowPaso rowPaso4Error" style="display: none;">
  <div class="col-md-10 col-md-offset-1">
    
    <h3>ERROR <small> Verificá los datos y volvé a intentar</small></h3>

    <div class="box box-solid">
      <div class="box-body">
        
        <div class="col-md-10 col-md-offset-1">
          <h1><small><i class="icon fa fa-fw fa-times-circle"></i> ERROR</small></h1>

            <h2 class="text-center">
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      1    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      2    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle fa-stack-2x" style="color: gray;"></span>
                  <strong class="fa-stack-1x" style="color: white">
                      3    
                  </strong>
              </span>
              <span class="fa-stack">
                  <span class="fa fa-circle-o fa-stack-2x" style="color: #e12424;"></span>
                  <strong class="fa-stack-1x" style="color: #e12424;">
                      X    
                  </strong>
              </span>

            </h2>

        </div>
        
        <div class="col-md-10 col-md-offset-1">

          <h4><i class="icon fa fa-times-circle fa-fw"></i> Ocurrió un error al procesar la información </h4>

          <!-- <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="callout callout-danger" style="background-color: #e5260e !important;">
              <p>Error</p>
            </div>
            </div>
          </div> -->

          <h4 style="margin-top: 15px;"><i class="icon fa fa-exclamation-circle fa-fw"></i> Por favor, verificá los datos y volvé a intentar. Para volver a empezar hace <a href="">CLICK ACÁ</a></h4>

          <br>

        </div>


        <div class="col-md-8 col-md-offset-1">
          <a href="{{url('/alert/my_list')}}" class="btn btn-primary pull-right">Ver Mis Alertas</a>
        </div>

      </div> 
    </div>
  </div>
</div>

	
@endsection


@section('scripts')

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDYXXQ58L5elQGyL_9L3pY8ihhLqKQjibM&v=3&libraries=geometry"></script>

<script src="{{asset('select2/select2.full.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('select2/select2.min.css')}}">

<script type="text/javascript">
  
  $(document).ready(function() {

    if (navigator.geolocation) {
    
      var options = {
        timeout: 20000,
        maximumAge: 0,
        enableHighAccuracy: true,
      };

      navigator.geolocation.getCurrentPosition(position, error, options);
    
    } else {

      console.log('navigator.geolocaton failed');
      lanzarAlerta('info', 'Información de Geolocalización no disponible. <br>Algunas funciones podrían no estar disponibles.');
    }

    function position (position) {
      
      var posaderos = 
      [<?php 
        $l = "";

        foreach ($instituciones as $key => $institucion) {

          if (isset($institucion->direccion->lat) && isset($institucion->direccion->long)) {

            $l .= "{id: '" . $institucion->id . "', ";
            $l .= "lat: '" . $institucion->direccion->lat . "', ";
            $l .= "lng: '" . $institucion->direccion->long . "', ";
            $l .= "nombre: '" . $institucion->nombre . "', ";
            $l .= "imagen: '" . $institucion->imagen . "', ";
            $l .= "descripcion: '" . $institucion->descripcion . "', ";
            $l .= "telefono: '" . $institucion->telefono . "', ";

            $l .= "direccion: '";
            if (isset($institucion->direccion)) {

              if (isset($institucion->direccion->calle))
                $l .= $institucion->direccion->calle;
              if (isset($institucion->direccion->numero))
                $l .= ' '.$institucion->direccion->numero;

              if (isset($institucion->direccion->piso))
                $l .= ' Piso '.$institucion->direccion->piso;
              if (isset($institucion->direccion->departamento))
                $l .= ' '.$institucion->direccion->departamento;

              if (isset($institucion->direccion->localidad))
                $l .= ', '.$institucion->direccion->localidad;
              if (isset($institucion->direccion->provincia))
                $l .= ', '.$institucion->direccion->provincia;

            }
            $l .= "', ";

            $l .= "tipo: '" . $institucion->tipo . "'";

            $l .= "},";

          }
        } 

        echo trim($l, ",");
      ?>];

      myLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

      console.log('myLocation: ' + myLatLng);

      $('#lat').val(position.coords.latitude);
      $('#lng').val(position.coords.longitude);

      for (var i = posaderos.length - 1; i >= 0; i--) {

        posaderoLatLng = new google.maps.LatLng(posaderos[i].lat, posaderos[i].lng);
        distancia  = google.maps.geometry.spherical.computeDistanceBetween(posaderoLatLng, myLatLng);
        posaderos[i].distancia = distancia;
      }

      posaderos.sort(function(posadero1, posadero2) {
        return posadero1.distancia - posadero2.distancia;
      });

      for (var i = 0; i < posaderos.length  && i < 8; i++) {
              
        $('.loadingCercanos').hide();

        txt = '';
        txt+= '<li class="cercano" data-direccion="'+posaderos[i].direccion+'" data-telefono="'+posaderos[i].telefono+'" data-horarios="'+posaderos[i].descripcion+'" title="'+posaderos[i].nombre+'" data-nombre="'+posaderos[i].nombre+'" data-id="'+posaderos[i].id+'">';

          if (posaderos[i].imagen)
            txt+= '<img class="img-circle" src="<?php echo asset("storage")?>/'+posaderos[i].imagen+'" alt="Posadero" >';
          else
            txt+= '<img class="img-circle" src="{{asset("/img/parroquia.png")}}" alt="Posadero" >';

          txt+= '<span class="users-list-name" href="#">'+posaderos[i].nombre+'</span>';

          if (posaderos[i].distancia < 500)
            distancia = 'menos de 500m';
          else if (posaderos[i].distancia < 1000)
            distancia = 'menos de 1km';
          else if (posaderos[i].distancia < 2000)
            distancia = 'menos de 2km';
          else if (posaderos[i].distancia < 3000)
            distancia = 'menos de 3km';
          else if (posaderos[i].distancia < 4000)
            distancia = 'menos de 4km';
          else if (posaderos[i].distancia < 5000)
            distancia = 'menos de 5km';
          else
            distancia = 'más de 5km';

          txt+= '<span class="users-list-date">'+distancia+'</span>';

        txt+= '</li>';

        $('.cercanos').append(txt);

      }
    }

    function error (error) {
      console.log(error);

      switch(error.code) {
        case error.PERMISSION_DENIED:
            x = "Ha denegado el permiso para acceder a su ubicación. Revise las opciones de configuración de su navegador."
            break;
        case error.POSITION_UNAVAILABLE:
            x = "Información de Geolocalización no disponible"
            break;
        case error.TIMEOUT:
            x = "El tiempo de espera fue agotado."
            break;
        case error.UNKNOWN_ERROR:
            x = "Error desconocido. Por favor vuelva a intentarlo."
            break;

        default:
          x = "Error al obtener tu ubicación."
      }

      lanzarAlerta('info', x + '<br>Algunas funciones podrían no estar disponibles.');
    }

  });


  $('.paso1').click(function (e) {

    $('.rowPaso').hide();
    $('.rowPaso1').fadeIn();

  });

  $('.paso2').click(function (e) {
    
    $('.rowPaso').hide();
    $('.rowPaso2').fadeIn();

  });

  $('.paso3').click(function (e) {

    $('.rowPaso').hide();
    $('.rowPaso3').fadeIn();

  });

  $('#confirmPaso1').click(function (e) {

    console.log('validate step1');
    
    if ($('#nombre').val() != '' && $('#apellido').val() != '' && $('#documento').val() != '') {

      $('.confirmNombre').html($('#nombre').val());
      $('.confirmApellido').html($('#apellido').val());
      $('.confirmDocumento').html($('#documento').val());
      $('.confirmFechaNacimiento').html($('#fechaNacimiento').val());
      $('.confirmObservaciones').html($('#observaciones').val());

      $('.rowPaso').hide();
      $('.rowPaso2').fadeIn();  
    
    } else {

      lanzarAlerta('info', 'Los campos "Nombre", "Apellido" y "Documento" son obligatorios. No te olvides de completarlos!')
    }

  })

  $('#confirmPaso2').click(function (e) {

    console.log('validate step2');

    if ($('#institucion_id').val() != '') {

      $('.rowPaso').hide();
      $('.rowPaso3').fadeIn();
    
    } else {

      lanzarAlerta('info', 'Seleccioná un posadero antes de continuar.');
    }

  })

  $('#confirmPaso3').click(function (e) {

    console.log('Submit Information');

    if ($('#nombre').val() != '' && $('#apellido').val() != '' && $('#institucion_id').val() != '' && $('#documento').val() != '') {

      institucion_id = $('#institucion_id').val();
      nombre = $('#nombre').val(); 
      apellido = $('#apellido').val();
      fechaNacimiento = $('#fechaNacimiento').val();
      observaciones = $('#observaciones').val()
      documento = $('#documento').val();
      lat = $('#lat').val();
      lng = $('#lng').val();
      comunidad_id = $('#selectComunidad').find(":selected").val();

      if ($('#checkComunidad').is(':checked')) {
        comunidad_id = $('#selectComunidad').find(":selected").val();
      } else {
        comunidad_id = '';
      }

      var loading = bootbox.dialog({
          message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Aguardá mientras procesamos los datos ...</p>',
          closeButton: false
      });

      $.post( "{{url('/alert/store2')}}", {_token: '{{csrf_token()}}', lat: lat, lng: lng, institucion_id: institucion_id, comunidad_id: comunidad_id, nombre: nombre, apellido: apellido, dni: documento, fechaNacimiento: fechaNacimiento, observaciones: observaciones})
      
      .done(function(datos) {

          if (datos.status) {
          
            $('.rowPaso').hide();
            $('.rowPaso4Ok').fadeIn();

            $('#alerta_id').html(datos.msg);
          
          } else {

            $('.rowPaso').hide();
            $('.rowPaso4Error').fadeIn();
          }

          loading.modal('hide');

      });



    } else {

      lanzarAlerta('peligro', 'Datos no válidos. Verificá los datos ingresdos y volvé a intentar.')
    }

  })

  $(document).on('click', '.cercano', function() { 

    $('li.cercano').removeClass('seleccionado');
    $(this).addClass('seleccionado');

    var id = $(this).data('id');
    var nombre = $(this).data('nombre');
    var direccion = $(this).data('direccion');
    var telefono = $(this).data('telefono');
    var horarios = $(this).data('horarios');


    $('#institucion_id').val(id);
    $('#posaderoSeleccionadoTxt').html('<span class="hidden-xs">Seleccionado</span> "'+nombre+'"');

    $('.confirmPosadero').html(nombre);
    $('.confirmDireccion').html(direccion);
    $('.confirmHorario').html(horarios);
    $('.confirmTelefono').html(telefono);

  });

  $('.selectPosadero').change(function () {

    var seleccionado = $(this).find(":selected");

    var id = seleccionado.val();
    var nombre = seleccionado.data('nombre');
    var direccion = seleccionado.data('direccion');
    var horarios = seleccionado.data('horarios');
    var telefono = seleccionado.data('telefono');

    $('.selectDireccion').html('').html(direccion);
    $('.selectTelefono').html('').html(telefono);
    $('.selectHorarios').html('').html(horarios);

    if (undefined !== id && undefined !== nombre) {

      $('#institucion_id').val(id);
      $('#posaderoSeleccionadoTxt').html('').html('<span class="hidden-xs">Seleccionado</span> "'+nombre+'"');

      $('.confirmPosadero').html(nombre);
      $('.confirmDireccion').html(direccion);
      $('.confirmHorario').html(horarios);
      $('.confirmTelefono').html(telefono);
    }

  })

  $('.mostrarLista').click(function () {

    $('.buscaCercano').hide();
    $('.buscaLista').fadeIn();

    $('#institucion_id').val('');
    $('#posaderoSeleccionadoTxt').html('');

    $(".selectPosadero").select2("val", "0");
    $(".selectPosadero").change();
    $('li.cercano').removeClass('seleccionado');
  })

  $('.mostrarCercano').click(function () {

    $('.buscaCercano').fadeIn();
    $('.buscaLista').hide();

    $('#institucion_id').val('');
    $('#posaderoSeleccionadoTxt').html('');

    $(".selectPosadero").select2("val", "0");
    $(".selectPosadero").change();
    $('li.cercano').removeClass('seleccionado');
  })

  $('#checkComunidad').change(function () {

    if ($(this).is(':checked'))
      $('#selectComunidad').show();
    else 
      $('#selectComunidad').fadeIn();
  })

  $('.select2').select2({
    placeholder: 'Seleccioná...'
  });

  $('#posaderoPopover').popover({
    html: true,
    content: function () {
        return $("#posaderoPopoverContent").html();
  }

});


</script>












<script type="text/javascript">
	
	$('#checkCoordenadas').change(function () {

		if ($('#checkCoordenadas').is(':checked')) {

			$(this).prop('disabled', true);
			
			if ($('#lat').val() == "" && $('#lng').val() == "") {

				$('#locLoad').fadeIn();
				$('#locErr').hide();
				$('#locOk').hide();
				navigator.geolocation.getCurrentPosition(position, error);

			}
			else {

				$('#locOk').fadeIn();
				$('#locErr').hide();
				$('#locLoad').hide();
				$('#checkCoordenadas').prop('disabled', false);
			}

		} else {
			
			$('#lat').val('');
	        $('#lng').val('');
	        $('#locOk').hide();
	        $('#locLoad').hide();
	        $('#locErr').hide();
	        $('#checkCoordenadas').prop('disabled', false);
		}
	});

	$('#submitBtn').click(function() {

	});

	function position(position) {

        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;

        $('#lat').val(latitud);
        $('#lng').val(longitud);

        $('#locLoad').hide();
        $('#locErr').hide();
        $('#locOk').fadeIn();
        $('#checkCoordenadas').prop('disabled', false);

    }

    function error(error) {

      	switch(error.code) {
	        case error.PERMISSION_DENIED:
	            x = "Ha denegado el permiso para acceder a su ubicación. Revise las opciones de configuración de su navegador."
	            break;
	        case error.POSITION_UNAVAILABLE:
	            x = "Información de Geolocalización no disponible"
	            break;
	        case error.TIMEOUT:
	            x = "El tiempo de espera fue agotado."
	            break;
	        case error.UNKNOWN_ERROR:
	            x = "Error desconocido. Por favor vuelva a intentarlo."
	            break;
      	}

      $('#locLoad').hide();
	    $('#locErr').fadeIn();
	    $('#locOk').hide();
	    $('#msgErr').html(x);
	    $('#checkCoordenadas').prop('disabled', false);

    }

</script>

@endsection
