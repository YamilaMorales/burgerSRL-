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
            <li class="" data-filter="*"></li>
            @foreach ($aCategorias AS $categoria)
            <li class="" data-filter=".{{ $categoria->nombre }}">{{ $categoria->nombre }}</li>
            @endforeach
        </ul>

        <div class="filters-content">
            @if(isset($msg))
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        {{ $msg["MSG"] }}
                    </div>

                </div>
            </div>
            @endif
            @if(isset($mensaje))
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger" role="alert">
                        {{ $mensaje["MSG"] }}
                    </div>

                </div>
            </div>
            @endif
            @if(isset($msg1))
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-danger" role="alert">
                        {{ $msg1["MSG"] }}
                    </div>

                </div>
            </div>
            @endif
            <div class="row grid">
                @foreach($aProductos AS $producto)                <div class="col-sm-6 col-lg-4 all {{ $producto->categoria }}">
                    <div class="box" style="height:450px;">
                        <div>
                            <div class="img-box " style="background:white;">
                                <img src="/files/{{ $producto->imagen }}" alt="" style="border-radius:25px;">
                            </div>
                            <div class="detail-box">
                                <h5>
                                    {{ $producto->nombre }}
                                </h5>
                                <p>
                                    {{ $producto->descripcion }}
                                </p>
                                <div class="options " style="height:100px;">
                                    <h6>
                                        $ {{ number_format($producto->precio, 0,',' , '.') }}
                                    </h6>
                                    <form action="" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="txtProducto" id="txtProducto" class="form-control" style="width: 50px;" value="{{ $producto->idproducto }}">
                                        <input type="number" name="txtCantidad" id="txtCantidad" class="form-control" style="width: 50px;" min="0">
                                        <button type="submit" class=" my-1 btn btn-warning" style="background-color:#ffbe33; color:#ffffff; border-radius:60px; "> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" style="enable-background:new 0 0 456.029 456.029;" viewBox="0 0 16 16">
                                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                        </button>
                                    </form>
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