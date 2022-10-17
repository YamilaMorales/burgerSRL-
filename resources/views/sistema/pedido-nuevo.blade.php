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
      <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
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
                        <input type="date" id="txtFecha" name="txtFecha" class="form-control " value="" required>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-6">
                        <label>Descripcion: *</label>
                        <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="20" class="form-control" value="" required></textarea>
                  </div>

                  <div class="form-group col-6">
                        <label>Total: *</label>
                        <input type="text" id="txtTotal" name="txtTotal" class="form-control" value="" required>
                  </div>

                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-6">
                        <label>Estado: *</label>
                        <select value="" id="lstEstado" name="lstEstado" required class="form-control">
                        <option value="" disabled selected >Seleccionar </option>
                              @foreach( $aEstados as $estado)
                              <option value="{{$estado->idestado}}"> {{$estado->nombre}}</option>

                              @endforeach
                        </select>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-6">
                        <label>Sucursal: *</label>
                        <select value="" id="lstSucursal" name="lstSucursal" required class="form-control">
                        <option value="" disabled selected >Seleccionar </option>
                              @foreach( $aSucursales as $sucursal)
                              <option value="{{$sucursal->idsucursal}}"> {{$sucursal->nombre}}</option>

                              @endforeach
                        </select>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                  <div class="form-group col-6">
                        <label>Cliente: *</label>
                        <select value="" id="lstCliente" name="lstCliente" required class="form-control">
                        <option value="" disabled selected >Seleccionar </option>
                              @foreach( $aClientes as $cliente)
                              <option value="{{$cliente->idcliente}}"> {{$cliente->nombre}}</option>

                              @endforeach
                        </select>
                  </div>

            </div>
      </form>
</div>

@endsection