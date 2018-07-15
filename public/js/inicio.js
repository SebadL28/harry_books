    var cantidadProtuctosCarrito = 0,
        libroAct = -1,
        tokenCsrf = "";

    $(document).ready(function(){
        $(".btn-libro").click(function(e){
            e.preventDefault();
            var btn = $(this),
                id = btn.attr("data-id"),
                nombre = btn.attr("data-nombre"),
                cantidad = btn.attr("data-cantidad"),
                precio = btn.attr("data-precio"),
                imagen = btn.attr("data-imagen"),
                rutaImg = "/img/libros/"+imagen,
                modal = $("#modal-libros"),
                parentSelect = modal.find(".content-cantidad-select"),
                selecCantidad = modal.find(".select-cantidad-libro"),
                optionsSelect = selecCantidad.find("option"),
                contentCantidad = '',
                textCantidad = cantidad,
                btnCarro = $(".btn-agregar-carro");

            if(optionsSelect.length > 0){
                optionsSelect.remove();
            }
            if(cantidad > 0){
                for (var i = 1; i <= cantidad; i++){
                    contentCantidad += '<option value="'+i+'">'+i+'</option>';
                }
                selecCantidad.append(contentCantidad);
                parentSelect.show();
                btnCarro.show();
            }
            else{
                textCantidad = 'Agotado';
                parentSelect.hide();
                btnCarro.hide();
            }

            libroAct = id;

            modal.find(".modal-body .cantidad-libro").html(textCantidad);
            modal.find(".modal-body .title-libro").html(nombre);
            modal.find(".modal-body .precio-libro").html("$"+precio+" COP");
            modal.find(".content-img").html('<img style="width: 100%;" src="'+rutaImg+'">');
            modal.modal("show");
        });

        $(".btn-agregar-carro").click(function(e){
            e.preventDefault();
            var btn = $(this),
                cantidadSelect = $(".select-cantidad-libro").val(),
                modal = $("#modal-libros"),
                url = "/cart/agregar_libro";

            btn.addClass("disabled").html('<span class="fa fa-spinner fa-pulse"></span>');

            $.post(url, {id: libroAct, cantidad: cantidadSelect, _token: tokenCsrf}, function(data){
                btn.removeClass("disabled");
                btn.html('Añadir al carrito');

                cantidadProtuctosCarrito++;
                actualizarCantidadCarrito();

                swal({
                    type: 'success',
                    title: 'Libro agregado',
                    text: 'Libro agregado a carro de compras'
                });

                modal.modal("hide");
            });
        });
    });

    function actualizarCantidadCarrito(){
        var content = $("#content-cantidad-carrito");
        content.html(cantidadProtuctosCarrito);
    }