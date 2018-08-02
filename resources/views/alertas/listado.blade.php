@extends('layouts.adminApp')


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
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bullhorn"></i> Alertas</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-alertas">
			
			<thead>
				<tr style="background-color: #f4f4f4;">
					<th rowspan="2" class="text-center" style="vertical-align: middle;">#</th>
					<th class="text-center" colspan="3">Asistido</th>
					<th class="text-center" colspan="2">Creada</th>
					@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->descripcion=='Administrador') || (Auth::user()->tipoUsuario->descripcion=='Posadero') ))
					<th rowspan="2" class="text-center" style="vertical-align: middle;"> Acciones</th>
					@endif
				</tr>
				<tr style="background-color: #f4f4f4;">
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Documento</th>
					<th class="text-center" >Usuario</th>
					<th class="text-center" >Comunidad</th>
					<th class="text-center">Fecha</th>
					
				</tr>

			</thead>

			<tbody>

				@if (isset($alertas) && count($alertas))

					@foreach ($alertas as $alerta)
					    @if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->descripcion=='Nuevo Usuario') || (Auth::user()->tipoUsuario->descripcion=='Samaritano') ))
							@if(Auth::user()->id == $alerta->user_id)
							<tr>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->nombre }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->apellido }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->dni }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->user->name }} 
									@if (isset($alerta->lat) && isset($alerta->lng))
									<span class="pull-right"> 
										<a href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}" target="_blank"><i class="icon fa fa-map-pin fa-fw"></i></a>
									</span>
									@endif
								</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->comunidad->nombre }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->created_at }}</td>
								@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->descripcion=='Administrador') || (Auth::user()->tipoUsuario->descripcion=='Posadero') ))

								<td class="text-center" style="vertical-align: middle;"> 
																	@if(empty($alerta->asistido_id))
										<a href="{{ route('asistido.newFromAlert',['id'=>$alerta->id]) }}" class="altaBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Alta Asistido"><i class="icon fa fa-check-circle fa-2x fa-fw text-green"></i></a> 
									@else
										<a class="altaBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Alta Asistido"><i title="Esta alerta ya tiene un asistido vinculado." class="icon fa fa-check-circle fa-2x fa-fw text-gray"></i></a>
									@endif
									<a href="{{ route('alerta.destroy',['id'=>$alerta->id])}}" class="descartarBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Descartar Solicitud"><i class="icon fa fa-times-circle fa-2x fa-fw text-red"></i></a>
								</td>
								@endif	
							</tr>
							@endif
						@else 
							@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->descripcion=='Administrador') || (Auth::user()->tipoUsuario->descripcion=='Posadero') ))
							<tr>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->nombre }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->apellido }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->dni }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->user->name }} 
										@if (isset($alerta->lat) && isset($alerta->lng))
										<span class="pull-right"> 
											<a href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}" target="_blank"><i class="icon fa fa-map-pin fa-fw"></i></a>
										</span>
										@endif
									</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->comunidad->nombre }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->created_at }}</td>
									@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->descripcion=='Administrador') || (Auth::user()->tipoUsuario->descripcion=='Posadero') ))
		
									<td class="text-center" style="vertical-align: middle;"> 
																		@if(empty($alerta->asistido_id))
											<a href="{{ route('asistido.newFromAlert',['id'=>$alerta->id]) }}" class="altaBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Alta Asistido"><i class="icon fa fa-check-circle fa-2x fa-fw text-green"></i></a> 
										@else
											<a class="altaBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Alta Asistido"><i title="Esta alerta ya tiene un asistido vinculado." class="icon fa fa-check-circle fa-2x fa-fw text-gray"></i></a>
										@endif
										<a href="{{ route('alerta.destroy',['id'=>$alerta->id])}}" class="descartarBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Descartar Solicitud"><i class="icon fa fa-times-circle fa-2x fa-fw text-red"></i></a>
									</td>
									@endif	
								</tr>
								@endif
							@endif


					@endforeach

			    @endif

			</tbody>

		</table>
		</div>

	</div>
</div>
</div>
	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$(function () {

	    $('#tabla-alertas').DataTable({
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
