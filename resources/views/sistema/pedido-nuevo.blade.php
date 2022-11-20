@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
    globalId = '<?php echo isset($pedido->idpedido) && $pedido->idpedido > 0 ? $pedido->idpedido : 0; ?>';
    <?php $globalId = isset($pedido->idpedido) ? $pedido->idpedido : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/pedido/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
    function fsalir() {
        location.href = "/admin/sistema/menu";
    }
</script>
@endsection
@section('contenido')
<div class="panel-body">
    <div id="msg"></div>
    <?php
    if (isset($msg)) {
        echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
    }
    ?>
    <form id="form1" method="POST" class="py-3">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="form-group col-6">
                <label>Fecha: *</label>
                <input type="date" id="txtFecha" name="txtFecha" class="form-control " value="{{ date_format(date_create($pedido->fecha),'Y-m-d') }}" required>
            </div>

            <div class="form-group col-6">
                <label>Descripcion: *</label>
                <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="20" class="form-control" required>{{$pedido->descripcion}}</textarea>
            </div>

            <div class="form-group col-6">
                <label>Total: *</label>
                <input type="text" id="txtTotal" name="txtTotal" class="form-control" value="{{$pedido->total}}" required>
            </div>


            <div class="form-group col-6">
                <label>Estado: *</label>
                <select value="" id="lstEstado" name="lstEstado" required class="form-control">
                    <option value="" disabled selected>Seleccionar </option>
                    @foreach( $aEstados as $estado)
                    @if($estado->idestado == $pedido->fk_idestado)
                    <option selected value="{{$estado->idestado}}"> {{$estado->nombre}}</option>
                    @else
                    <option value="{{$estado->idestado}}"> {{$estado->nombre}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-6">
                <label>Sucursal: *</label>
                <select value="" id="lstSucursal" name="lstSucursal" required class="form-control">
                    <option value="" disabled selected>Seleccionar </option>
                    @foreach( $aSucursales as $sucursal)
                    @if($sucursal->idsucursal == $pedido->fk_idsucursal)

                    <option selected value="{{$sucursal->idsucursal}}"> {{$sucursal->nombre}}</option>
                    @else
                    <option value="{{$sucursal->idsucursal}}"> {{$sucursal->nombre}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-6">
                <label>Cliente: *</label>
                <select selected value="" id="lstCliente" name="lstCliente" required class="form-control">
                    <option value="" disabled selected>Seleccionar </option>
                    @foreach( $aClientes as $cliente)
                    @if($cliente->idcliente == $pedido->fk_idcliente)
                    <option selected value="{{$cliente->idcliente}}"> {{$cliente->nombre}}</option>
                    @else
                    <option value="{{$cliente->idcliente}}"> {{$cliente->nombre}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label>Metodo de pago: *</label>
                <select selected value="" id="lstPago" name="lstPago" class="form-control">
                    <option value="" disabled selected>Seleccionar </option>

                    <option <?php echo $pedido->pago == "Efectivo" ? "selected" : ""; ?> value="Efectivo"> Efectivo</option>
                    <option <?php echo $pedido->pago == "MercadoPago" ? "selected" : ""; ?> value="MercadoPago"> Mercado Pago</option>

                </select>
            </div>

        </div>
        @if($pedido->idpedido > 0)
        <div class="row">

            <div class="col-md-12">
                <label for="">Detalles del pedido:</label>
                <table class="table table hover border">
                    <tr>
                        <th>N Pedido</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Comentario</th>
                        <th>Imagen</th>
                    </tr>
                    @foreach ($aPedidoProductos as $producto)
                    <tr>
                        <td>{{$producto->fk_idpedido}}</td>
                       <td>{{ $producto->nombre }}</td>
                       <td> {{ $producto->cantidad }} </td>
                       <td>{{ $producto->descripcion }}</td>
                       <td>{{ $producto->comentario}}</td>
                       <td><img src="/files/{{ $producto->imagen }}" class="img-thumbnail" style=" width: 90px;"></style> </td> 
                    </tr>
                    @endforeach
                </table>

            </div>

        </div>
        @endif
    </form>
</div>
<script>
    $("#form1").validate();

    function guardar() {
        if ($("#form1").valid()) {
            modificado = false;
            form1.submit();
        } else {
            $("#modalGuardar").modal('toggle');
            msgShow("Corrija los errores e intente nuevamente.", "danger");
            return false;
        }

    }

    function eliminar() {
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/pedido/eliminar') }}",
            data: {
                id: globalId
            },
            async: true,
            dataType: "json",
            success: function(data) {
                if (data.err == 0) {
                    msgShow(data.mensaje, "success");
                    $("#btnEnviar").hide();
                    $("#btnEliminar").hide();
                    $('#mdlEliminar').modal('toggle');
                } else {
                    msgShow(data.mensaje, "danger");
                    $('#mdlEliminar').modal('toggle');
                }
            }
        });
    }
</script>
@endsection