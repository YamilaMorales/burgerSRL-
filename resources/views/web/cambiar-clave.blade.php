@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Cambiar clave
            </h2>
        </div>
        @if(isset($mensaje))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert">
                    {{ $mensaje["MSG"] }}
                </div>
            </div>
        </div>
        @endif
        @if(isset($msg))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger" role="alert">
                    {{ $msg ["MSG"] }}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div>
                            <input type="password" name="txtClave1" id="txtClave1" class="form-control" placeholder="Nueva contraseña:" />
                        </div>
                        <div>
                            <input type="password" name="txtClave2" id="txtClave2" class="form-control" placeholder="Repetir contraseña:" />
                        </div>

                        <div class="btn_box">
                            <button type="submit">
                                Cambiar clave
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection