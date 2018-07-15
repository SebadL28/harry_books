        var login = -1,
            tokenCsrf = '';

        $(document).ready(function(){
            $("#table-libros").on("change", ".select-cantidad", function(){
                var selectAct = $(this),
                    cantidadAct = selectAct.val(),
                    trAct = selectAct.parent().parent(),
                    id = trAct.attr("data-id");


                trAct.attr("data-cantidad", cantidadAct);
                actualizarCantidadPedido(id, cantidadAct);
                actualizarTotal();
            });

            $("#table-libros").on("click", ".btn-eliminar", function(e){
                e.preventDefault();
                var btn = $(this),
                    trAct = btn.parent().parent(),
                    id = trAct.attr("data-id"),
                    registros = $("#table-libros tbody tr");

                swal({
                    title: 'Eliminar articulo',
                    text: "¿Realmente desea eliminar el libro?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        eliminarLibroPedido(id);
                        trAct.remove();
                        console.log(registros.length);
                        if(registros.length == 1){
                            agregarRegistroVacio();
                        }
                        swal(
                            'Eliminado',
                            'Libro eliminado',
                            'success'
                        );
                        actualizarTotal();
                    }
                });
            });

            $("#btn-cancelar-compra").click(function(e){
                e.preventDefault();
                swal({
                    title: 'Cancelar compra',
                    text: "¿Realmente desea cancelar la compra?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.value) {
                        cancelarCompra();
                        swal(
                            'Compra cancelada',
                            '',
                            'success'
                        );
                        vaciarTabla();
                        actualizarTotal();
                    }
                });
            });

            $("#btn-finalizar-compra").click(function(e){
                e.preventDefault();

                if(login == 1){
                    swal({
                        title: 'Finalizar compra',
                        text: "¿Realmente desea finalizar la compra?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.value) {
                            finalizarCompra();
                        }
                    });
                }
                else{
                    swal(
                        'Inicia sesión',
                        'Por favor inicia sesión para poder finalizar la compra',
                        'warning'
                    );
                }
            });
        });

        function finalizarCompra(){
            window.location.href = "/cart/finalizar_compra";
        }

        function cancelarCompra(){
            var url = "/cart/cancelar_compra";
            $.post(url, { _token: tokenCsrf}, function(data){});
        }

        function eliminarLibroPedido(id){
            var url = "/cart/eliminar_pedido";
            $.post(url, {id: id, _token: tokenCsrf}, function(data){});
        }

        function actualizarCantidadPedido(id, cantidadAct){
            var url = "/cart/actualizar_cantidad";
            $.post(url, {id: id, cantidad: cantidadAct, _token: tokenCsrf}, function(data){});
        }

        function actualizarTotal(){
            var tabla = $("#table-libros"),
                libros = tabla.find("tbody tr");

            var granTotal = 0;
            if(libros.length > 0){
                var contador = 0;
                libros.each(function(){
                    var libroAct = this;
                    libroAct = $(this);

                    var precioAct = libroAct.attr("data-precio"),
                        cantidadAct = libroAct.attr("data-cantidad"),
                        $total = libroAct.find(".content-total"),
                        total = precioAct * cantidadAct;

                    libroAct.attr("data-id", contador);

                    granTotal += total;
                    total = seperadorMiles(total, ".");
                    $total.html("$"+total);
                    
                    contador++;
                });

                granTotal = seperadorMiles(granTotal, ".");
            }
            $("#content-gran-total").html("$"+granTotal);
        }

        function agregarRegistroVacio(){
            var tabla = $("#table-libros"),
                container = tabla.find("tbody"),
                content = '<tr><td colspan="6" class="text-center">No se encuentrar pedidos</td></tr>';

            container.html(content);
            $("#btn-cancelar-compra").remove();
            $("#btn-finalizar-compra").remove();
        }

        function vaciarTabla(){
            var tabla = $("#table-libros"),
                registros = tabla.find(".tbody tr");

            registros.remove();
            agregarRegistroVacio();
        }

        function seperadorMiles(numero, separador){
            var number_string = numero.toString(),
            rest      = number_string.length % 3,
            result    = number_string.substr(0, rest),
            thousands = number_string.substr(rest).match(/\d{3}/gi);

            if (thousands) {
                separator = rest ? separador : '';
                result += separator + thousands.join(separador);
            }

            return result;
        }
