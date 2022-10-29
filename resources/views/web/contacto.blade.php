@extends("web.plantilla")
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
            <form action="">
              <div>
                <input type="text" class="form-control" placeholder="Nombre:" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Teléfono:" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email:" />
              </div>
              <div>
                <textarea name="text" id="text" cols="20" rows="10" class="form-control" placeholder="Escribe aquí tu mensaje:" ></textarea>
              </div>
              
              <div class="btn_box">
                <a href=""> <button>
                  ENVIAR
                </button> </a>
              </div>
            </form>
          </div>
        </div>
      
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

  @endsection("contenido")