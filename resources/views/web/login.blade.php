@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Ingresar al sistema
            </h2>
        </div>
        @if(isset($mensaje))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-danger" role="alert">
                {{ $mensaje }}
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
                            <input type="tex" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Correo:" />
                        </div>
                        <div>
                            <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Contraseña:" />
                        </div>
                        <div class="btn_box">
                             <button type="submit" name="btnIngresar">
                                    Ingresar
                                </button> 
                        </div>
                        <div class="col-md-12 p-2">
                            <a href="/registrarse">¿No estas registrado? ¡Registrate!</a>
                            <a href="recuperar-clave">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection