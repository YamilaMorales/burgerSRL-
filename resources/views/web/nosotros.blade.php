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
        <div class="heading_container">
            <h2>
                Trabaja con nosotros.
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                        <div>
                            <input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre:" />
                        </div>
                        <div>
                            <input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido:" />
                        </div>
                        <div>
                            <input type="tex" id="txtCelular" name="txtCelular" class="form-control" placeholder="Teléfono de contacto:" />
                        </div>
                        <div>
                            <input type="email" class="form-control" id="txtCorreo" name="txtCorreo"  placeholder="Correo:" />
                        </div>
                        <div>
                            <input type="file" class="form-control" id="archivo" name="archivo" accept=".doc, .docx, .pdf" placeholder="Curriculum:" />
                             <small class="d-block">Archivos admitidos .doc, .docx, .pfd </small>
                        </div>

                        <div class="btn_box">
                            <button name="btnEnviarPostulacion" type="submit">
                                Enviar postulación
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- end book section -->
<!-- client section -->

<section class="client_section layout_padding-bottom pt-4">
    <div class="container">
        <div class="heading_container heading_center psudo_white_primary mb_45">
            <h2>
                Nuestros Clientes
            </h2>
        </div>
        <div class="carousel-wrap row ">
            <div class="owl-carousel client_owl-carousel">
                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                Las hamburguesas y papas fritas caseras más ricas y sanas.
                            </p>
                            <h6>
                                Lucila Perez
                            </h6>
                            
                        </div>
                        <div class="img-box">
                            <img src="web/images/client1.jpg" alt="" class="box-img">
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="detail-box">
                            <p>
                                Hamburguesa rica, abundante y jugosa. El pan una delicia.
                            </p>
                            <h6>
                                Martin Holdder
                            </h6>
                            
                        </div>
                        <div class="img-box">
                            <img src="web/images/client2.jpg" alt="" class="box-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end client section -->

@endsection