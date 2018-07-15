@extends('layouts.inicio')
@section('title', 'Inicio')
@section('content')
    <div class="jumbotron banner-principal">
        <div>
            <h3>Lorem ipsum dolor</h3>
            <h1>SIT AMET, CONSECTETUR</h1>      
        </div>
    </div>
    <div class="container">
        <h3>Libros a la venta</h3>
        <div class="row">
            @foreach($libros as $libro)
            <div class="col-md-3 col-sm-4 col-xs-12">
                <a data-id="{{ $libro->id }}" data-nombre="{{ $libro->nombre }}" data-cantidad="{{ $libro->cantidad }}" data-precio="{{ $libro->precio }}" data-imagen="{{ $libro->imagen }}" href="#" class="card btn-libro">
                    <div class="content-img">
                        <img class="card-img-top" src="/img/libros/{{ $libro->imagen }}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $libro->nombre }}</h5>
                        <p class="card-text">Precio: <b>${{ number_format($libro->precio, 2, ",", ".") }} COP</b></p>
                        @if($libro->cantidad > 0)
                            <p class="card-text">Cantidad: <b>{{ $libro->cantidad }}</b></p>
                        @else
                            <p class="card-text">Cantidad: <b>Agotado</b></p>
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="modal-libros" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-b-30">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div style="display: block;width: 100%;" class="content-img"></div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <h4 class="title-libro"></h4>
                            <div class="form-group">
                                <label>Precio: <b class="precio-libro"></b></label>
                            </div>
                            <div class="form-group">
                                <label>Cantidad disponible: <b class="cantidad-libro"></b></label>
                            </div>
                            <div class="form-group content-cantidad-select">
                                <label>Agregar al carrito</label>
                                <select class="select-cantidad-libro form-control"></select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info btn-agregar-carro">
                                    Añadir al carrito
                                </button>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/inicio.js"></script>
    <script>
        cantidadProtuctosCarrito = {{ count(session("libros_cart")) }};
        tokenCsrf = "{{ csrf_token() }}";
    </script>
    @if (session('compra') == 'success')
    <script>
        $(document).ready(function(){
            swal({
                title: 'Compra realizada',
                text: 'Hemos recibido su solicitud y será procesada por nuestros agentes. Gracias por su compra',
                type: 'success',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#98b732'
            });
        });
    </script>
    @endif
@endsection