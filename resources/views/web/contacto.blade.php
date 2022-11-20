@extends("web.plantilla")
@section('scripts')

@endsection
@section("contenido")
<!-- book section -->
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Envianos un mensaje
            </h2>
        </div>
        @if(isset($mensaje))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger" role="alert">
                    {{ $mensaje["MSG"] }}
                </div>

            </div>
        </div>
        @endif
        <div>

            <div class="form_container">


                <form action="" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <input type="text" id="txtNombre" name="txtNombre" class="form-control" required placeholder="Nombre:" />
                            </div>
                            <div>
                                <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required placeholder="Teléfono:" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" required placeholder="Correo:" />
                            </div>
                            <div>
                                <textarea name="txtMensaje" id="txtMensaje" cols="20" rows="10" class="form-control" required placeholder="Escribe aquí tu mensaje:"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="btn_box" style="text-align: center;">
                        <button type="submit" name="btnEnviar">
                            ENVIAR
                        </button>
                    </div>
                </form>

            </div>

        </div>

</section>
<!-- end book section -->

@endsection