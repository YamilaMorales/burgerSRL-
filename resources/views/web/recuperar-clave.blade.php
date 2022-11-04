@extends("web.plantilla")
@section('scripts')
<script>
      globalId = '<?php echo isset($cliente->idcliente) && $cliente->idcliente > 0 ? $cliente->idcliente : 0; ?>';
      <?php $globalId = isset($cliente->idcliente) ? $cliente->idcliente : "0"; ?>
</script>
@endsection
@section("contenido")

<section class="book_section layout_padding">
      <div class="container">
            <div class="heading_container">
                  <h2>
                        Recuperar clave
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
                              <form  id="form1" method="POST" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                                    <div>
                                          <input type="tex" name="txtCorreo" id="txtCorreo" class="form-control" placeholder="Correo:" />
                                    </div>

                                    <div class="btn_box">
                                          <a> <button type="submit">
                                                      RECUPERAR
                                                </button></a>


                                    </div>
                              </form>
                        </div>
                  </div>

            </div>
      </div>

</section>
<script>
      $("#form1").validate();
      cargarGrillaPermisos();
      cargarGrilla();

      function guardar() {
            if ($("#form1").valid()) {
                  modificado = false;
                  form1.submit();
            } else {
                  $("#modalRecuperar").modal('toggle');
                  msgShow("Corrija los errores e intente nuevamente.", "danger");
                  return false;
            }
      }
</script>
@endsection