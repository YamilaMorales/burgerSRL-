<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="Te esperamos en cualquiera de nuestras sucursales para disfrutar de las mejores hamburguesas." />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="web/images/favicon.png" type="">

    <title>BURGER SRL </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="web/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="web/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="web/css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
            <img src="web/images/hero-bg.jpg" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="/">
                        <span>
                            BURGER SRL
                        </span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mx-auto ">
                            <li class="nav-item  <?php echo (Request::path() == "") ? "active" : ""; ?>">
                                <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item  <?php echo (Request::path() == "takeaway") ? "active" : ""; ?>">
                                <a class="nav-link" href="/takeaway">Takeaway</a>
                            </li>
                            <li class="nav-item <?php echo (Request::path() == "nosotros") ? "active" : ""; ?>">
                                <a class="nav-link" href="/nosotros">Nosotros</a>
                            </li>
                            <li class="nav-item <?php echo (Request::path() == "contacto") ? "active" : ""; ?>">
                                <a class="nav-link" href="/contacto">Contacto</a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <a href="/mi-cuenta" class="user_link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </a>
                            @if(Session::get("idCliente") && Session::get("idCliente") > 0)
                            <?php $cantidadTotal = 0; ?>

                            @foreach ($aCarritos AS $carrito)

                          
                            <?php

                            $cantidadTotal += $carrito->cantidad;

                            ?>
                            @endforeach
                           
                            <a class="cart_link" href="/carrito">

                                <h7 class="m-1  p-1" style="background-color:#ffbe33; color:#ffffff; border-radius:60px;">{{$cantidadTotal}}</h7>

                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">


                                    <g>
                                        <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>

                                </svg>
                            </a>
                            @else
                            <a class="cart_link" href="/carrito">

                               

                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">


                                    <g>
                                        <g>
                                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>

                                </svg>
                            </a>
                            @endif
                            @if(Session::get("idCliente") && Session::get("idCliente") > 0)
                            <a href="/logout" class="order_online">
                                Cerrar sesi??n
                            </a>
                            @else
                            <a href="/login" class="order_online">
                                Ingresar
                            </a>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->

        @yield("banner")
    </div>


    @yield("contenido")



    <!-- footer section -->
    <footer class="footer_section ">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="col-md-12 footer-col  mx-auto mb-md-0 mb-4">
                <h1 style="text-align: center;">
                    Sucursales
                </h1>
            </div>
            <!-- Left -->


            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom ">
            <div class="container text-center text-md-start mt-3">
                <!-- Grid row -->
                <div class="row mt-3">

                    @foreach ($aSucursales as $sucursal)
                    <!-- Grid column -->

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">



                        <!-- Links -->
                        <p> <a target="_blank" href="{{$sucursal->ubicacion}}">
                                <i class="fa fa-map-marker" style="color: white;" aria-hidden="true"></i>
                                <span style="color: white;">
                                    {{$sucursal->nombre}}
                                </span>
                            </a></p>
                        <p><i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                                {{$sucursal->telefono}}
                            </span>
                        </p>
                        <p><i class="bi bi-clock" aria-hidden="true"></i>
                            <span>
                                {{$sucursal->horario}}
                            </span>
                        </p>
                    </div>
                    @endforeach
                    <!-- Grid column -->
                </div>

                <!-- Grid row -->
            </div>

        </section>

        <div class="col-md-12 footer-col">
            <div class="footer_detail">
                <a href="" class="footer-logo pt-5">
                    BURGER SRL
                </a>
                <p>
                    Seguinos en nuestras redes.
                </p>
                <div class="footer_social">
                    <a href="">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>

                </div>
            </div>
        </div>
        </div>
        </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="web/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="web/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="web/js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->
</body>

</html>