@extends("web.plantilla")


@section("contenido")

<section class="book_section layout_padding">
      <div class="container">
            <div class="heading_container">
                  <h2>
                        Registrate
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
            <div class="py-3">
                  <h7>Ingresa tus datos para registrarte.</h7>
            </div>
            <div class="row">
                  <div class="col-md-6">
                        <div class="form_container">

                              <form action="" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <div>
                                          <input type="tex" class="form-control" id="txtNombre" name="txtNombre" required placeholder="Nombre" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtApellido" name="txtApellido" required placeholder="Apellido:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtDni" name="txtDni" required placeholder="DNI:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtCelular" name="txtCelular" required placeholder="Teléfono de contacto:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtCorreo" name="txtCorreo" required placeholder="Correo:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtDireccion" name="txtDireccion"  required placeholder="Dirección:" />
                                    </div>
                                    <div>
                                          <input type="password" class="form-control" id="txtClave" name="txtClave" required placeholder="Contraseña:" />
                                    </div>

                                    <div class="btn_box">
                                          <button type="submit" name="btnGuardar">
                                                Guardar
                                          </button>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>

      </div>
      </div>

</section>

@endsection