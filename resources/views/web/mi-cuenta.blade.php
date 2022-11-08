@extends("web.plantilla")
@section("contenido")
<section class="book_section layout_padding">
      <div class="container">
            <div class="heading_container">
                  <h2>
                        Mis datos
                  </h2>
            </div>
            <div class="row">
                  <div class="col-md-6">
                        <div class="form_container">
                              <form action="" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <div>
                                          <input type="tex" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtDni" name="txtDni" placeholder="DNI:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtCelular" name="txtCelular" placeholder="Celular de contacto:" />
                                    </div>
                                    <div>
                                          <input type="tex" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Dirección:" />
                                    </div>
                                    <div>
                                          <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Contraseña:" />
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
            <div class="heading_container">

                  <div class="container col-md-6 p-3">

                        <div>
                              <h1>Mis pedidos</h1>
                        </div>
                        <div>
                             
                              <table class="table table-hover">

                                    <thead>
                                   

                                          <tr>
                                         
                                                <th>
                                                      Sucursal
                                                      Pedido
                                                      Estado
                                                      Fecha
                                                      Total
                                                </th>
                                          </tr>
                                          @foreach ($aPedidos AS $pedido)
                                    </thead>
                                   
                                    <tbody>
                                    
                                          <tr>
                                             <td>{{ $carrito->producto}}</td>
                                          
                                          <td></td>
                                          
                                         
                                               
                                          </tr>
                                          @endforeach
                                    </tbody>

                                   
                              </table>
                             

                        </div>
                  </div>
            </div>

      </div>
</section>

@endsection