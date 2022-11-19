@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">

        <div class="heading_container">
            <h2>
                Mi Carrito
            </h2>
        </div>
        @if(isset($msg))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert">
                    {{ $msg["MSG"] }}
                </div>

            </div>
        </div>
        @endif
        <div class="form-container">
            <div class="row">
                @if($aCarritos)
                <div class="col-md-12">
                    <div class="row container">
                        <table class="table table hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Producto</th>
                                    <th></th>
                                    <th></th>
                                    <th>Precio unitario</th>
                                    <th></th>
                                    <th>Cantidad</th>
                                    <th></th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $total = 0; ?>

                                @foreach ($aCarritos AS $carrito)

                                <?php
                                $subtotal = $carrito->precio * $carrito->cantidad;
                                $total += $subtotal;
                                ?>

                                <form action="" method="POST">
                                    <tr>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <td>
                                            {{$carrito->producto}}
                                        </td>
                                        <td>

                                            <input type="hidden" name="txtCarrito" id="txtCarrito" class="form-control" style="width: 50px;" value="{{ $carrito->idcarrito }}">
                                        </td>
                                        <td>
                                            <img src="/files/{{$carrito->imagen}}" class="thumbnail" height="50px;">
                                        </td>

                                        <td>
                                            ${{ number_format($carrito->precio, 0,',' , '.') }}
                                        </td>
                                        <td><input type="hidden" name="txtProducto" id="txtProducto" class="form-control" style="width: 60px;" value="{{ $carrito->fk_idproducto }}">
                                        <td><input type="number" name="txtCantidad" id="txtCantidad" class="form-control" style="width: 60px;" min="0" value="{{ $carrito->cantidad }}">
                                        </td>
                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <button type="submit" id="btnActualizar" name="btnActualizar" class="btn btn-success "><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-repeat" viewBox="0 0 15 15">
                                                        <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z" />
                                                    </svg>
                                                </button>

                                                <button type="submit" id="btnEliminar" name="btnEliminar" class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1+5" height="15" fill="currentColor" class="bi bi-trash-fill btn-danger" viewBox="0 0 15 15">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>


                                            </div>


                                        </td>

                                        <td>
                                            ${{ number_format($subtotal, 0,',' , '.') }}
                                        </td>

                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th colspan="9" style="text-align: right;">TOTAL: ${{number_format($total, 2 , ",", ".") }}</th>

                                    </tr>
                                </form>

                                <tr>

                                    <td colspan="9" style="text-align: right;">

                                        <a href="/takeaway"><button class="btn btn-warning" style="background-color:#ffbe33; color:#ffffff; border-radius:45px;">Agregar productos</button></a>

                                    </td>

                                </tr>



                            </tbody>

                        </table>

                    </div>

                    <div class="row  container">
                        <div class="col-md-12 ">

                            <table class="table table hover">

                                <form action="" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <thead class="thead-dark">
                                        
                                        <tr>

                                            <th>
                                                Sucursal
                                            </th>

                                            <th>
                                                Método de pago
                                            </th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                       
                                        <tr>
                                            <td>
                                                <select class="form-control" name="lstSucursal" id="lstSucursal">
                                                    <option value="" disabled selected>Seleccionar </option>
                                                    @foreach ( $aSucursales AS $sucursal)
                                                    <option value="{{ $sucursal->idsucursal }}">{{$sucursal->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </td>


                                            <td>
                                                <select class="form-control" name="lstPago" id="lstPago">
                                                    <option value="" disabled selected>Seleccionar </option>

                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="MercadoPago">Mercado Pago</option>

                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> <label for="">Comentario:</label> </th>
                                            <th></th>

                                        </tr>
                                        <tr>
                                            <td class=""> <textarea name="txtDescripcion" id="txtDescripcion" cols="20" rows="2" class="form-control py-2">

                                            </textarea></td>
                                            <td></td>
                                        </tr>
                                        <tr>

                                            <td colspan="9" style="text-align: right;">


                                                <button name="btnFinalizar" id="btnFinalizar" type="submit" class="btn btn-warning p-2 px-3" style="background-color:#ffbe33; color:#ffffff; border-radius:45px;">Finalizar pedido</button>


                                            </td>

                                        </tr>
                                    </tbody>

                                </form>

                            </table>

                        </div>

                    </div>
                </div>
            </div>

            @else
            <div class="col-md-12 heading_container">
                <h4>No hay productos seleccionados</h4>
                <div class="p-3">
                    <a href="/takeaway"><button type="submit" class="btn btn-warning" style="background-color:#ffbe33; color:#ffffff; border-radius:45px;">Agregar productos</button></a>

                </div>
            </div>

            @endif


        </div>
    </div>

</section>
@endsection