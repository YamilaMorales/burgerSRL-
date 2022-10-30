@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Cambiar clave
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div>
                            <input type="password" name="txtNuevaClave" id="txtNuevaClave" class="form-control" placeholder="Nueva contraseña:" />
                        </div>
                        <div>
                            <input type="password" name="txtRepetirClave" id="txtRepetirClave" class="form-control" placeholder="Repetir contraseña:" />
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