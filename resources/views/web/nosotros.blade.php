@extends("web.plantilla")
@section("contenido")
<!-- about section -->

<section class="about_section layout_padding">
    <div class="container">

        <div class="row">
            <div class="col-md-6 ">
                <div class="img-box">
                    <img src="web/images/about-img.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            Sobre Nosotros
                        </h2>
                    </div>
                    <p>
                        Burger SRL nace con la idea de volcar más de 10 años de experiencia gastronómica para generar revolución y cambios. Ofrecemos la mejor hamburguesa del mercado, desarrollada con un blend de carnes y condimentos que sumados dan como resultado una hamburguesa con mucho sabor que la diferencia de la que hoy está en el mercado.
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- end about section -->
<!-- book section -->
<section class="book_section layout_padding">
    <div class="container">
        <div class="heading_container p-3">
            <h2>
                Trabaja con nosotros.
            </h2>
        </div>


        <div class="form_container">
            <form action="" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre:" />
                        </div>
                        <div>
                            <input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido:" />
                        </div>
                        <div>
                            <input type="tex" id="txtCelular" name="txtCelular" class="form-control" placeholder="Teléfono de contacto:" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        
                        <div>
                            <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Correo:" />
                        </div>
                        <div>
                            <input type="file" class="form-control" id="archivo" name="archivo" accept=".doc, .docx, .pdf" placeholder="Curriculum:" />
                            <small class="d-block">Archivos admitidos .doc, .docx, .pfd </small>
                        </div>
                    </div>
                </div>
                <div class="btn_box p-3" style="text-align:  center;">
                    <button name="btnEnviarPostulacion" type="submit">
                        Enviar postulación
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>
<!-- end book section -->
<!-- client section -->



@endsection