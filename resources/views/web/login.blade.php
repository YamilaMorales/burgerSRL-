@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Ingresar al sistema
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="method post">
                        <div>
                            <input type="tex" class="form-control" placeholder="Usuario:" />
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Contraseña:" />
                        </div>
                        <div class="btn_box">
                           <a href="/"> <button type="submit">
                                Ingresar
                            </button> </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection