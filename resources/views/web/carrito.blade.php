@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
      <div class="container">

            <div class="heading_container">
                  <h2>
                        Mi Carrito
                  </h2>
            </div>
            <div class="row">
                  @if($aCarritos)
                  <div class="col-md-9">
                        <div class="row form_container">
                              <table class="table-dark table hover">
                                    <thead>
                                          @foreach ($aCarritos AS $carrito)
                                          <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio unitario</th>
                                                <th></th>

                                          </tr>
                                    </thead>
                                    <tbody>

                                          <td>
                                                {{$carrito->producto}}
                                          </td>
                                          <td>
                                                {{$carrito->cantidad}}
                                          </td>
                                          <td>
                                                {{$carrito->precio}}
                                          </td>
                                          <td>
                                                <img src="(($carrito->imagen}}" class="thumbnail">
                                          </td>
                                          @endforeach
                                    </tbody>


                              </table>

                        </div>

                        <div class="row">
                              <div class="col-md-9 p-2">
                                    <label for="">Sucursal</label>

                                    <select name="lstSucursal" id="lstSucursal">
                                          <option value="" disabled selected>Seleccionar </option>
                                          @foreach ( $aSucursales AS $sucursal)
                                          <option value="{{ $sucursal->nombre }}">{{$sucursal->nombre}}</option>
                                          @endforeach
                                    </select>

                              </div>

                        </div>
                  </div>
            </div>

            @else
            <div class="col-md-12 heading_container">
                  <h4>No hay productos seleccionados</h4>

            </div>
            @endif

            <div class="btn_box">
                  <a href="/takeaway">
                        <button type="submit">Agregar productos</button>
                  </a>
            </div>
      </div>

</section>
@endsection