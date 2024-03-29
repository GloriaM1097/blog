@extends('egresado.inicio')
@section('contenido')
<div class="table-responsive">
	<div class="table-responsive">
		<h3>Listado de Postulaciones</h3>
		<table class="table table-striped table-bored table-condensed table-hover">
			<thead>
				<th>Fecha</th>
				<th>Descripci&oacute;n</th>
				<th>Nombre de la Empresa</th>
				<th>Nombre de la Vacante</th>
				<th>Estatus</th>
				
			</thead>
			@foreach($postulados as $postulado)
			<?php
			$solicitud = DB::table('solicitud')->where('idsolicitud',$postulado->idsolicitud)->get();
			$empresa = DB::table('empresas')->where('idempresa',$postulado->idempresa)->get();

			$dt = new DateTime($postulado->created_at);

			?>
			<tr>
				
				{{-- <td>{{date_format($item->created_at, 'd-m-Y')}}</td> --}}
				<td>{{$dt->format('d/m/Y')}}</td>
				<td>{{ $solicitud[0]->descripcion_del_puesto }}</td>
				<td>{{ $empresa[0]->nombre }}</td>
				<td>{{ $solicitud[0]->nombredelpuesto}}</td>				
				<td>
					<form action="{{ url('cambio-estatus-egresado',$postulado->id) }}" method="POST">
						@csrf
						{{-- @if($postulado->estatus == 'Postulado                     ') --}}
						@if($postulado->estatus == 'Postulado')
							<button type="submit" class="btn-wide btn btn-success">{{ $postulado->estatus }}</button>
						@elseif($postulado->estatus == 'No Postulado')
						{{-- @elseif($postulado->estatus == 'No Postulado                  ') --}}
							<button type="submit" class="btn-wide btn btn-danger">{{ $postulado->estatus }}</button>
						@endif
					</form>
				</td>				
				
				
			</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection