@extends('layouts.administracion')
@section('title', 'Administración')

@section('content')
    
    <div class="container container-cart">
        <h3>Informes de venta</h3>
        
		<div class="row">
			<div class="col-12">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4 col-12">
									<label>Cliente: </label>
								</div>
								<div class="col-md-8 col-12">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-user"></span></span>
										<input style="background: #fff;" type="text" class="form-control input-valor" placeholder="Cliente" readonly value="{{ $informe->user->name }}">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 offset-md-2">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4 col-12">
									<label>Fecha: </label>
								</div>
								<div class="col-md-8 col-12">
									<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
										<input type="text" style="background: #fff;" readonly class="form-control" value="{{ date('Y-m-d', strtotime($informe->fecha)) }}">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4 col-12">
									<label>Total: </label>
								</div>
								<div class="col-md-8 col-12">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-dollar"></span></span>
										<input style="background: #fff;" type="text" class="form-control input-valor" id="nombres-terceros" placeholder="Total" value="${{ number_format($informe->total, 0, ",", ".") }}" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div style="margin-top: 10px;" class="col-12">
				<table class="table table-bordered table-dashed">
					<thead>
						<tr>
							<th>#</th>
							<th colspan="2">Libro</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($informe->libro_venta as $key => $ventaLibro)
						@php ($totalAct = $ventaLibro->precio * $ventaLibro->cantidad)
						<tr class="table_row">
							<td>{{ $key+1 }}</td>
							<td>
								<img style="width:60px;" src="/img/libros/{{ $ventaLibro->libro->imagen }}" alt="IMG">
							</td>
							<td>{{ $ventaLibro->libro->nombre }}</td>
							<td>${{ number_format($ventaLibro->precio, 0, ",", ".") }}</td>
							<td class="text-center">{{ $ventaLibro->cantidad }}</td>
							<td class="content-total">${{ number_format($totalAct, 0, ",", ".") }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </div>

@endsection