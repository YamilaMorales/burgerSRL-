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
                              <table class="table table hover">
                                    <thead>
                                          @foreach ($aCarritos AS $carrito)
                                          <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio unitario</th>
                                                <th>Total</th>
                                                <th>Metodo de pago</th>
                                                <th>Sucursal</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <td>
                                                <img src="" class="thumbnail">
                                          </td>
                                          <td>
                                                {{$carrito->producto}}
                                          </td>
                                          <td>
                                                {{$carrito->cantidad}}
                                          </td>
                                          <td>
                                                {{$carrito->precio}}
                                          </td>
                                          @endforeach
                                    </tbody>


                              </table>

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
                        <button type="submit">Agregar productos </button>
                  </a>
            </div>
      </div>

</section>
@endsection