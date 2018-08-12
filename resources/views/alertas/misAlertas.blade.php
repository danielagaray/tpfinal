@extends('layouts.userApp')


@section('title')
	Alertas
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-bullhorn fa-fw"></i>Alertas
	<small>Mis Alertas</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bullhorn"></i> Alertas</a></li>
	<li class="active">Mis Alertas</li>
</ol>
@endsection

@section('content')

<style type="text/css">
	
	.vert-aligned {

		vertical-align: middle !important;
	}
</style>


<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#reciente" data-toggle="tab" aria-expanded="true"><i class="fa icon fa-fw fa-history"></i> <span class="hidden-xs">Actualizaciones Recientes</span></a></li>
      <li class=""><a href="#personal" data-toggle="tab" aria-expanded="false"><i class="fa icon fa-fw fa-user-circle"></i> <span class="hidden-xs">Mis Alertas</span></a></li>
      <li class=""><a href="#comunidad" data-toggle="tab" aria-expanded="false"><i class="fa icon fa-fw fa-users"></i> <span class="hidden-xs">Mi Comunidad</span></a></li>
    </ul>
    
    <div class="tab-content">
      
      <div class="tab-pane active" id="reciente">
        
        <br>
      	<h4> <i class="icon fa fa-history"></i> Actividad Reciente <small><br>NO TE PIERDAS DE NADA! <br>REVISÁ TU ACTIVIDAD Y LA DE TU COMUNIDAD LA ÚLTIMA SEMANA</small></h4>


      	<ul class="timeline timeline-inverse">

      		<?php $dia = 0; ?>

      		<?php foreach ($recientes as $alerta): ?>
			    
			    <?php if ($alerta->updated_at->format('Y-m-d') != $dia): ?>
			    	
			    	<li class="time-label">
		                <span class="bg-navy">
		                  <?php echo $alerta->updated_at->format('d M Y') ?>
		                </span>
		          	</li>	
			    
			    <?php endif ?>

			    <?php $dia = $alerta->updated_at->format('Y-m-d'); ?>

			    <?php if (isset($alerta->asistido_id)) { ?>
					

			    	<li>
			            <i class="fa fa-check bg-green"></i>

			            <div class="timeline-item">
			              <span class="time"><i class="fa fa-clock-o"></i> <?php echo $alerta->updated_at->diffForHumans() ?> </span>

			              <?php if ($alerta->user_id == Auth::user()->id) { ?>
							
				              <h3 class="timeline-header no-border"><a href="#">Felicitaciones!</a> se dió de alta uno de tus Asistidos en un Posadero</h3>

			              <?php } else { ?>

			              	  <h3 class="timeline-header no-border"><a href="#">Felicitaciones!</a> se dio de alta un Asistido de tu Comunidad en un Posadero</h3>
			              
			              <?php } ?>
			              
			              <div class="timeline-body">

			              	<i class="icon fa fa-user"></i> <?php echo $alerta->nombre ?> <?php echo $alerta->apellido ?> se dió de alta en <img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> <?php echo isset($alerta->institucion_id) ? $alerta->institucion->nombre : ' "No Disponible"' ?>
			              	<p class="help-block"> Si querés involucrarte y hacer un seguimiento del caso, podes acercarte a un Posadero. Hace <a href="#">click aca</a> para obtener mas información sobre como ayudar.</p>	

			              </div>

			              <div class="timeline-footer">
			                <a class="btn btn-default btn-xs"><i class="fa icon fa-address-card fa-fw"></i> Ver Ficha</a>
			              </div>

			            </div>
			        </li>

			    <?php } else { ?>

			    	<li>
			            <i class="fa fa-user-plus bg-blue"></i>

			            <div class="timeline-item">
			              <span class="time"><i class="fa fa-clock-o"></i> <?php echo $alerta->updated_at->diffForHumans() ?></span>

			              <h3 class="timeline-header">
			              	<?php if ($alerta->user_id == Auth::user()->id) { ?>
								
			              		<a href="#">Generaste una alerta (#<?php echo $alerta->id ?>)</a>

			              	<?php } else { ?>

			              		<a href="#"><?php echo ucwords($alerta->user->name) ?> <?php echo ucwords($alerta->user->apellido) ?></a> generó una alerta (#<?php echo $alerta->id ?>)


			              	<?php } ?>
			              </h3>

			              <div class="timeline-body">
			              	<strong><i class="icon fa fa-user"></i> ASISTIDO</strong>
			              	<p>
			              		Nombre: <?php echo $alerta->nombre ?> <?php echo $alerta->apellido ?>
			              		<br>DNI: <?php echo $alerta->dni ?>
			              		
			              		<?php if (isset($alerta->fechaNacimiento)): ?>
			              			<br>Fecha Nacimeinto: <?php echo $alerta->fechaNacimiento ?>
			              		<?php endif ?>

			              		<?php if (isset($alerta->observaciones)): ?>
			              			<br><br><strong>Observaciones:</strong> 
			              			<br><?php echo $alerta->observaciones ?>
			              		<?php endif ?>
			              		
			              	</p>
			              	<img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> <strong>POSADERO al que fue derivado:</strong>
			              	<p>
			              		<?php if (isset($alerta->institucion_id)): ?>
			              			<?php echo $alerta->institucion->nombre ?>
			              		<?php endif ?>
			              	</p>

			              </div>
			              <div class="timeline-footer">
			                <a class="btn btn-default btn-xs"><i class="fa icon fa-location-arrow fa-fw"></i> Ver Ubicación</a>
			              </div>
			            </div>
			          </li>

	      		<?php } ?>

      		

      		<?php endforeach ?>
	          

<!-- 
          <li>
            <i class="fa fa-user-plus bg-blue"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

              <h3 class="timeline-header"><a href="#">Juan Carlos Vargas</a> generó una alerta (#455)</h3>

              <div class="timeline-body">
              	<strong><i class="icon fa fa-user"></i> ASISTIDO</strong>
              	<p>
              		Nombre: Juan Gallo
              		<br>DNI: 238482
              		<br>Fecha Nacimeinto: 93339

              		<br><br><strong>Observaciones:</strong> 
              		<br>Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                quora plaxo ideeli hulu weebly balihoo
              	</p>
              	<img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> <strong>POSADERO al que fue derivado:</strong>
              	<p>
              		Ntra. Senora de las Nieves	
              	</p>

              </div>
              <div class="timeline-footer">
                <a class="btn btn-default btn-xs"><i class="fa icon fa-location-arrow fa-fw"></i> Ver Ubicación</a>
              </div>
            </div>
          </li>

          <li>
            <i class="fa fa-check bg-green"></i>

            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

              <h3 class="timeline-header no-border"><a href="#">Felicitaciones!</a> se dió de alta uno de tus Asistidos en un Posadero</h3>
              <h3 class="timeline-header no-border"><a href="#">Felicitaciones!</a> se dio de alta un Asistido de tu Comunidad en un Posadero</h3>

              <div class="timeline-body">

              	<i class="icon fa fa-user"></i> Juan Carlos se dió de alta en <img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> San Roque
              	<p class="help-block"> Si queres involucrarte y hacer un seguimiento del caso, podes acercarte a un Posadero. Hace <a href="#">click aca</a> para obtener mas informacion sobre como ayudar.</p>	

              </div>

              <div class="timeline-footer">
                <a class="btn btn-default btn-xs"><i class="fa icon fa-address-card fa-fw"></i> Ver Ficha</a>
              </div>

            </div>
          </li>

 -->
			          
        


          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>


        </ul>

      </div>







      <!-- TAB PERSONAL -->
      <div class="tab-pane" id="personal">

      	<br>
      	<h4> <i class="icon fa fa-user-circle"></i> Mis Alertas <small><br>A CONTINUACION PODES HACER UN SEGUIMIENTO DEL ESTADO DE LAS ALERTAS QUE GENERASTE</small></h4>

      	<table class="table table-bordered table-striped table-hover table-datatables" id="tabla-personal">
			
			<thead>

				<tr style="">
					<th class="text-center">#</th>
					<th class="text-center">Datos de la Alerta</th>
					<th class="text-center"><i class="icon fa fa-users"> Comunidad</i></th>
					<th class="text-center"><img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 15px;"> Posadero</th>
					<th class="text-center"><i class="icon fa fa-tag"></i> Estado</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($personales) && count($personales))

					@foreach ($personales as $alerta)


							<tr>
								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
								<td class="vert-aligned " style="vertical-align: middle;">
									<strong>Nombre:</strong> {{ $alerta->nombre }} {{ $alerta->apellido }}
									<br><strong>DNI:</strong> {{ $alerta->dni }}
									<br><strong>Fecha Nacimiento:</strong> {{ $alerta->fechaNacimiento }}
									<br><strong>Observaciones:</strong> 
									<br> {{ $alerta->observaciones }}

									@if (isset($alerta->lat) && isset($alerta->lng))
									<br> <span class="pull-right"><a target="_blank" title="Ver Ubicación" href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}"><i class="icon fa fa-location-arrow"></i></a></span>
									@endif
								</td>
								

								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ isset($alerta->comunidad->nombre) ? $alerta->comunidad->nombre : '' }}</td>
								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ isset($alerta->institucion->nombre) ? $alerta->institucion->nombre : '' }}</td>
								
								<td class="vert-aligned text-center">
									<?php if (isset($alerta->asistido_id)) { ?>
										
										<span class="label label-success"><i class="fa icon fa-check-circle"></i> SE PRESENTÓ </span>

									<?php } else { ?>

										<span class="label label-default"><i class="fa icon fa-clock-o"></i> PENDIENTE </span>

									<?php } ?>
								</td>	

							</tr>

					@endforeach

			    @endif

			</tbody>

		</table>

      </div>





      <!-- TAB COMUNIDAD -->
      <div class="tab-pane" id="comunidad">

      	<br>
      	<h4> <i class="icon fa fa-users"></i> Mi Comunidad <small><br>A CONTINUACION PODES HACER UN SEGUIMIENTO DEL ESTADO DE LAS ALERTAS DE TU COMUNIDAD</small></h4>
        
        <h4>
        	<small style="margin-bottom: 50px;">Comunidades a las que perteneces: </small>

        	<?php foreach ($misComunidades as $com): ?>
        		<span class="label label-default"><?php echo $com->nombre ?></span>	
        	<?php endforeach ?>
        </h4>
        
        <br>

        <table class="table table-bordered table-striped table-hover table-datatables" id="tabla-comunidad">
			
			<thead>

				<tr style="">
					<th class="text-center">#</th>
					<th class="text-center">Datos de la Alerta</th>
					<th class="text-center"><i class="icon fa fa-users"> Comunidad</i></th>
					<th class="text-center"><img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 15px;"> Posadero</th>
					<th class="text-center"><i class="icon fa fa-tag"></i> Estado</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($comunidad) && count($comunidad))

					@foreach ($comunidad as $alerta)


							<tr>
								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
								<td class="vert-aligned " style="vertical-align: middle;">
									<strong>Nombre:</strong> {{ $alerta->nombre }} {{ $alerta->apellido }}
									<br><strong>DNI:</strong> {{ $alerta->dni }}
									<br><strong>Fecha Nacimiento:</strong> {{ $alerta->fechaNacimiento }}
									<br><strong>Observaciones:</strong> 
									<br> {{ $alerta->observaciones }}

									@if (isset($alerta->lat) && isset($alerta->lng))
									<br> <span class="pull-right"><a target="_blank" title="Ver Ubicación" href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}"><i class="icon fa fa-location-arrow"></i></a></span>
									@endif
								</td>
								

								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ isset($alerta->comunidad->nombre) ? $alerta->comunidad->nombre : '' }}</td>
								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ isset($alerta->institucion->nombre) ? $alerta->institucion->nombre : '' }}</td>
								
								<td class="vert-aligned text-center">
									<?php if (isset($alerta->asistido_id)) { ?>
										
										<span class="label label-success"><i class="fa icon fa-check-circle"></i> SE PRESENTÓ </span>

									<?php } else { ?>

										<span class="label label-default"><i class="fa icon fa-clock-o"></i> PENDIENTE </span>

									<?php } ?>
								</td>	

							</tr>

					@endforeach

			    @endif

			</tbody>

		</table>
      </div>

    </div>

  </div>

	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$(function () {

	    $('.table-datatables').DataTable({
	      'paging'      : true,
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false,
	      'pageLength'	: 50,

	      	"oLanguage": {
				"sEmptyTable": "No hay datos disponibles para la tabla.",
				"sLengthMenu": "Mostrar _MENU_ filas",
				"sSearch": "Buscar alerta:",
				"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ filas",
				"oPaginate": {
					"sPrevious": "Anterior",
					"sNext": "Siguiente"
				}
			}
	    });
  });

</script>

@endsection
