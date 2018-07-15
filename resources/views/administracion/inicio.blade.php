@extends('layouts.administracion')
@section('title', 'Administración')

@section('content')
    
    <div class="container container-cart">
        <h3>Informes de venta</h3>
        
		<table style="margin-top: 20px;" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Fecha</th>
					<th class="text-center">Cliente</th>
					<th class="text-center">Tipos libros</th>
					<th class="text-center">Total</th>
					<th class="text-center">Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($informes as $key => $informe)
				<tr>
					<td class="text-center">{{ $key+1 }}</td>
					<td class="text-center">{{ date('d-m-Y', strtotime($informe->fecha)) }}</td>
					<td class="text-center">{{ $informe->user->name }}</td>
					<td class="text-center">{{ count($informe->libro_venta) }}</td>
					<td class="text-right">${{ number_format($informe->total, 0, ",", ".") }}</td>
					<td class="text-center"><a href="/administracion/informe/{{ $informe->id }}" class="btn btn-xs btn-info"><span class="fa fa-eye"></span></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>

@endsection