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
                    <form action="method post">
                        <div>
                            <input type="tex" class="form-control" placeholder="Correo:" />
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Nueva contraseña:" />
                        </div>
                        <div>
                            <input type="tex" class="form-control" placeholder="Repetir contraseña:" />
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