@extends('adminlte::page')
@section('content')
<div class="container">
    <h2 class="text-center">Crear nueva factura</h2>
        <form class="row justify-content-center" action=" {{ route('facturas.store') }}" method="POST" enctype="multipart/form-data" required>
            @csrf
            <div class="form-group col-12 mt-4 row">
                <div class="col-7">
                    <label for="producto">Productos</label>
                    <select class="form-control" id="producto" name="producto" required>
                        @forelse($productos as $producto)
                            <option value="{{ $producto->id }}">Nombre: {{ $producto->nombre }} Cantidad: {{ $producto->cantidad }}</option>
                        @empty
                            <option value="-1">No hay productos</option>
                        @endforelse                    
                    </select>
                </div>
                <div class="col-3">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" min="0" name="cantidad" aria-describedby="namelHelp" placeholder="Ingresar cantidad de producto" value="0" required>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary mt-4" id="agregar_producto">Agregar producto</button>
                </div>
            </div> 
            <div class="form-group col-12 mt-4 row" id="productos">
                <div class="col-12 row">
                    <div class="col-12">
                        <span>Total: 0.00</span>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 mt-4 row">
                <div class="col-6">
                    <select class="form-control" name="divisa" id="divisa">
                        <option value="0">Seleccione divisa</option>
                        @foreach($divisas as $divisa)
                            <option value="{{ $divisa->id }}">{{ $divisa->nombre }} - {{ $divisa->ultima_divisa->tasa }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row justify-content-center" id="user_data" style="display:none">
                <div class="form-group col-5 offset-1">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="namelHelp" disabled>
                </div>
                <div class="form-group col-5 offset-1">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="namelHelp" disabled>
                </div>
                <div class="form-group col-8 offset-1">
                    <label for="direccion">Direccion</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" aria-describedby="namelHelp" disabled>
                </div>
                <div class="form-group col-2 mt-4" id="crear_cliente" style="display:none">
                    <button type="button" class="btn btn-primary" id="crear_cliente_btn">Crear</button>
                </div>
            </div>
            <div class="form-group col-12 mt-4 row">
                <div class="col-8">
                    <label for="cedula">Cedula</label>
                    <input type="text" class="form-control" name="cedula" id="cedula" placeholder="cedula">
                </div>
                <div class="col-4 mt-4">
                    <button type="button" class="btn btn-primary" id="buscar_cedula">buscar</button>
                </div>
            </div>
            <div class="form-group col-4 offset-2 mt-4">
                <button type="submit" class="btn btn-lg btn-primary text-center">Registrar</button> 
            </div>
        </form>
</div>
    
@endsection

@section('js')
    <script>
        let lista_productos = <?= $productos ?>;
        let lista_divisas = <?= $divisas ?>;
        let productos = [];
        let cliente_id = 0;
        let historial_divisa_id = 0;

        document.addEventListener('DOMContentLoaded',() => {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $("form").on('submit', function(e) {
                e.preventDefault();
                var data = { productos, historial_divisa_id, cliente_id };

                if (!$("#user_data").is(':visible'))
                    return alert("Por favor busque el cliente")
                if (productos.length <= 0)
                    return alert("Agregue al menos 1 producto")

                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: '/facturas',
                    data: data,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: (data) => {
                        console.log(data);
                        window.location.href='/facturas';
                    },
                    error: (data) => {
                        console.log(data);
                        alert("Ha ocurrido un error");
                        window.location.href='/facturas/create';
                    }
                });

            });

            let seleccion_tasa = () => {
                var divisa_seleccionada = $("#divisa option:selected");
                var id = parseInt(divisa_seleccionada.val());
                var item_divisa = lista_divisas.filter((item) => item.id == id)[0];
                var tasa = (id) ? parseFloat(item_divisa.ultima_divisa.tasa) : 1;
                historial_divisa_id = (id) ? item_divisa.ultima_divisa.id : 0;
                return tasa;
            }

            let filtrar_productos = (id = -1) => {
                var total = 0;
                productos = productos.filter((item) => item.id != id);
                productos.forEach(item => {total = total + item.cantidad * item.precio;});
                tasa = seleccion_tasa();
                total = total * tasa;

                $("#productos").empty();

                /*
                    Modificar el HTML de aquí abajo, cuando hagan el frontend
                */

                productos.forEach(item => {
                    $("#productos").append(`
                        <div class="col-12 row">
                            <div class="col-10">
                                <div>Nombre: ${item.nombre} Cantidad: ${item.cantidad} Precio: ${(item.precio * item.cantidad).toFixed(2)}</div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="borrar btn btn-danger" data-id="${item.id}">Borrar</button>
                            </div>
                        </div>
                    `);
                });

                $("#productos").append(`
                    <div class="col-12 row">
                        <div class="col-12">
                            <span>Total: ${total.toFixed(2)}</span>
                        </div>
                    </div>
                `);

                $('.borrar').on('click', (e) => {
                    e.preventDefault();
                    filtrar_productos(e.currentTarget.getAttribute('data-id'));
                });
            };

            $('#agregar_producto').on('click', (e) => {
                e.preventDefault();
                var producto_seleccionado = $("#producto option:selected");
                var id = parseInt(producto_seleccionado.val());
                var item_producto = lista_productos.filter((item) => item.id == id)[0];
                var nombre_producto = item_producto.nombre;
                var precio = parseFloat(item_producto.precio);
                var cantidad_actual_producto = parseInt(item_producto.cantidad);
                var cantidad = parseInt($("#cantidad").val());

                /* 
                    Ponerle un Sweet alert o algo en vez de alertas...
                */

                if (!cantidad)
                    return alert("No se pueden agregar 0 en cantidad");
                if (productos.filter((item) => item.id == id).length > 0)
                    return alert("Producto ya está agregado");
                if (cantidad > cantidad_actual_producto)
                    return alert("Cantidad mucho mayor a la actual");

                productos.push({ 'id': id, 'nombre': nombre_producto, 'cantidad': cantidad, 'precio': precio });
                filtrar_productos();
            });
            
            $('#divisa').on('change', () => {
                filtrar_productos();
            });

            $("#buscar_cedula").on('click', (e) => {
                e.preventDefault();
                var cedula = $("#cedula").val();
                if (cedula) {
                    $.ajax({
                        type: 'GET',
                        dataType: 'JSON',
                        url: `/clientes/buscar/${cedula}`,
                        success: (data) => {
                            if (data) {
                                cliente_id = data.id;
                                $("#nombre").val(data.nombre);
                                $("#nombre").prop('disabled', true);
                                $("#direccion").val(data.direccion);
                                $("#direccion").prop('disabled', true);
                                $("#telefono").val(data.telefono);
                                $("#telefono").prop('disabled', true);
                                $("#user_data").show();
                                $("#crear_cliente").hide();
                            } else {
                                // Usar Sweetalert o algo.
                                alert("No existe cliente con esa cedula");

                                $("#nombre").val('');
                                $("#nombre").prop('disabled',false);
                                $("#direccion").val('');
                                $("#direccion").prop('disabled',false);
                                $("#telefono").val('');
                                $("#telefono").prop('disabled',false);
                                $("#user_data").show();
                                $("#crear_cliente").show();
                            }
                        },
                        error: (error) => {
                            /* 
                                Ponerle un Sweet alert o algo en vez de alertas...
                            */
                            console.log('Error:', error);
                            alert("Ha ocurrido un error");
                            $("#user_data").hide();
                            $("#crear_cliente").hide();
                        }
                    });
                } else {
                    /* 
                        Ponerle un Sweet alert o algo en vez de alertas...
                    */
                    alert("Introduzca un valor");
                }
            });

            $("#crear_cliente_btn").on('click', function() {
                var data = {
                    nombre: $("#nombre").val(),
                    cedula: $("#cedula").val(),
                    direccion: $("#direccion").val(),
                    telefono: $("#telefono").val()
                }

                if (!data.nombre || !data.cedula || !data.direccion || !data.telefono) {
                    /* 
                        Ponerle un Sweet alert o algo en vez de alertas...
                    */
                    alert("Por favor, ingrese todos los campos")
                } else {
                    $.ajax({
                        type: "POST",
                        dataType: 'JSON',
                        url: '/clientes/crear_cliente',
                        data: data,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: (data) => {
                            cliente_id = data.id;
                            $("#nombre").val(data.nombre);
                            $("#nombre").prop('disabled', true);
                            $("#direccion").val(data.direccion);
                            $("#direccion").prop('disabled', true);
                            $("#telefono").val(data.telefono);
                            $("#telefono").prop('disabled', true);
                            $("#crear_cliente").hide();
                            /* 
                                Ponerle un Sweet alert o algo en vez de alertas...
                            */
                            alert("Cliente creado con exito");
                        },
                        error: (data) => {
                            /* 
                                Ponerle un Sweet alert o algo en vez de alertas...
                            */
                            console.log(data);
                            alert("Ha ocurrido un error");
                            $("#user_data").hide();
                            $("#crear_cliente").hide();
                        }
                    });
                }
                
            });
		});
    </script>
@stop