@extends('layouts.inicio')
@section('title', 'Carro de compras')

@section('content')
    
    <div class="container container-cart">
        <h3>Libros a la venta</h3>
        <div class="row">
            <div class="col-md-8">
                <table id="table-libros" class="table table-bordered table-dashed">
                    <thead>
                        <tr>
                            <th colspan="2">Libro</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $granTotal = 0
                        @endphp
                        @if(count($librosSelect) > 0)
                            @foreach($librosSelect as $key => $value)
                                @php
                                    $libroAct = $libros[$value["id"]];
                                    $total = $value["cantidad"] * $libroAct->precio;
                                    $granTotal += $total;
                                @endphp

                                <tr data-id="{{ $key }}" data-precio="{{ $libroAct->precio }}" data-cantidad="{{ $value["cantidad"] }}" class="table_row">
                                    <td>
                                        <img style="width:60px;" src="/img/libros/{{ $libroAct->imagen }}" alt="IMG">
                                    </td>
                                    <td>{{ $libroAct->nombre }}</td>
                                    <td>${{ number_format($libroAct->precio, 0, ",", ".") }}</td>
                                    <td>
                                        <select class="form-control select-cantidad">';
                                            @for($i = 1; $i <= $libroAct->cantidad ; $i++)
                                                @php ($selected = ($i == $value["cantidad"])? 'selected' : '')
                                                <option {{ $selected }}>{{ $i }}</option>}
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="content-total">${{ number_format($total, 0, ",", ".") }}</td>
                                    <td class="text-center"><a href="#" style="color:#fff;" class="btn btn-xs btn-danger btn-eliminar"><span class="fa fa-close"></span></a></td>
                                </tr>
                            @endforeach
                        @else
                        <tr><td colspan="6" class="text-center">No se encuentrar pedidos</td></tr>
                        @endif
                    </tbody>
                </table>

                @if(count($librosSelect) > 0)
                <div class="form-group">
                    <a href="#" class="btn btn-danger" id="btn-cancelar-compra">
                        Cancelar compra
                    </a>
                </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card border-secondary" style="border: 1px solid;">
                    <div class="card-body">
                        <h2 class="card-title" style="font-size: 25px;">Resumen compra</h2>
                        <p style="margin-top: 10px;margin-bottom: 20px;font-size: 18px;" class="card-text">Total: <b id="content-gran-total">${{ number_format($granTotal, 0, ",", ".") }} </b>COP</p>

                        @if(count($librosSelect) > 0)
                        <button class="btn btn-block btn-success" id="btn-finalizar-compra">
                            Finalizar compra
                        </button>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/cart.js"></script>
    <script>
        @guest
        login = 0;
        @else
        login = 1;
        @endguest
        tokenCsrf = "{{ csrf_token() }}";
    </script>
@endsection