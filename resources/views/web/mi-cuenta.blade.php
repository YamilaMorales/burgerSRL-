@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Mis datos
            </h2>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form_container">

                    <form action="" method="POST">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

                        <div>
                            <input type="tex" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" value="{{ $cliente->nombre }}" />
                        </div>
                        <div>
                            <input type="tex" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido:" value="{{ $cliente->apellido }}" />
                        </div>
                        <div>
                            <input type="tex" class="form-control" id="txtDni" name="txtDni" placeholder="DNI:" value="{{ $cliente->dni }}" />
                        </div>
                        <div>
                            <input type="tex" class="form-control" id="txtCelular" name="txtCelular" placeholder="Celular de contacto:" value="{{ $cliente->celular }}" />
                        </div>
                        <div>
                            <input type="tex" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección:" value="{{ $cliente->direccion }}" />
                        </div>
                        <div>
                            <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Contraseña:" value="{{ $cliente->clave }}" />
                        </div>
                        <div colspan="4" style="text-align: right; ">
                            <u> <a style="color:black; " class="p-2" href="/cambiar-clave"> Cambiar Clave</a></u>
                        </div>

                        <div class="btn_box">
                            <button type="submit" name="btnGuardar">
                                Guardar
                            </button>
                        </div>

                    </form>

                </div>


            </div>

        </div>
        @if($aPedidos)
        <div class="heading_container p-3">

            <div class="container col-md-6">

                <div class="p-3">
                    <h1>Mis pedidos</h1>
                </div>
                <div>

                    <table class="table table-hover">

                        <thead>


                            <tr>

                                <th> Sucursal </th>
                                <th> Nº Pedido</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Método de pago</th>

                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($aPedidos as $pedido)
                            <tr>
                                <td> {{ $pedido->sucursal }} </td>
                                <td> {{ $pedido->idpedido }}</td>
                                <td> {{ $pedido->estado }}</td>
                                <td>{{ date_format(date_create("$pedido->fecha"),'d M Y') }}</td>
                                <td> {{ $pedido->total }}</td>
                                <td> {{ $pedido->pago }}</td>
                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
        @else
        <div  class="col-md-12 heading_container m-3 ">
            <h5 style="text-align: right; ">No hay pedidos activos.</h5>
            <div class="p-3">
                <a href="/takeaway"><button type="submit" class="btn btn-warning" style="background-color:#ffbe33; color:#ffffff; border-radius:45px;">Hace tu pedido.</button></a>

            </div>
        </div>

        @endif



    </div>
</section>

@endsection