@extends("web.plantilla")
@section("contenido")
<!-- food section -->

<section class="food_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Nuestro Menu
      </h2>
    </div>

    <ul class="filters_menu">
      <li class="active" data-filter="*">Todo</li>
      @foreach ($aCategorias AS $categoria)
      <li data-filter="">{{ $categoria->nombre }}</li>
      @endforeach
    </ul>
    
    <div class="filters-content">
      <div class="row grid "  >
      @foreach($aProductos AS $producto)
        <div class="col-sm-6 col-lg-4 all {{$producto->categoria}}" >
          <div class="box" style="height:450px;">
            <div>
              <div class="img-box img-thumbnail" style="background:white;">
                <img src="/files/{{ $producto->imagen }}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  {{ $producto->nombre }}
                </h5>
                <p>
                  {{ $producto->descripcion }}
                </p>
                <div class="options ">
                  <h6>
                    $ {{ number_format($producto->precio, 0,',' , '.') }}
                  </h6>
                  <form action="" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="txtProducto" id="txtProducto" class="form-control" style="width: 50px;">
                    <input type="number" name="txtCantidad" id="txtCantidad" class="form-control" style="width: 50px;">
                  </form>
                  <i><button type="submit" class="btn-box " > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
  <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
  <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg> </button></i>
                </div>

              </div>

            </div>

          </div>

        </div>

        @endforeach
      </div>
     
    </div>

  </div>

</section>

<!-- end food section -->

@endsection