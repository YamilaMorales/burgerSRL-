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
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
          <?php
      if (isset($msg)) {
            echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
      }
      ?>
      <div id="msg"></div>
            <form action=""  method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
         
              <div>
                <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre:" />
              </div>
              <div>
                <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" placeholder="Teléfono:" />
              </div>
              <div>
                <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email:" />
              </div>
              <div>
                <textarea name="text" id="text" cols="20" rows="10" class="form-control" placeholder="Escribe aquí tu mensaje:" ></textarea>
              </div>
              
              <div class="btn_box">
                 <button type="submit" name="btnEnviar">
                  ENVIAR
                </button>
              </div>
            </form>
          </div>
        </div>
      
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

  @endsection