@extends("web.plantilla")


@section("contenido")

<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Recuperar clave
            </h2>
        </div>

        <div class="py-3">
            <h7>Ingresa tu correo para recuperar tu clave.</h7>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form_container">

                    <form action="" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

                        <div>
                            <input type="tex" name="txtCorreo" id="txtCorreo" class="form-control" placeholder="Correo:" />
                        </div>
                        @if(isset($mensaje))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success" role="alert">
                                    {{ $mensaje }}
                                </div>

                            </div>
                        </div>
                        @endif
                        <div class="btn_box">
                            <button type="submit">RECUPERAR</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</section>

@endsection