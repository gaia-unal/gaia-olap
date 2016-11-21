<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }} ">
    <meta name="author" content="Sergi Tur Badenas - acacha.org">

    <meta property="og:title" content="Adminlte-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" />

    <title>Gaia-Olap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/js/smoothscroll.js') }}"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>Gaia-Olap</b></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#home" class="smoothScroll">Inicio</a></li>
                <li><a href="#desc" class="smoothScroll">Descripción</a></li>
                <li><a href="#showcase" class="smoothScroll">Uso</a></li>
                <li><a href="#contact" class="smoothScroll">Contacto</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                @else
                    <li><a href="/home">{{ Auth::user()->name }}</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


<section id="home" name="home"></section>
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
                <h1>Gaia <b><a href="https://github.com/Daespinosag/gaia-olap">Olap</a></b></h1>
                <h3> Herramienta para la creación de análisis multidimencional OLAP</h3>
                <h3> Crea cubos OLAP desde cero en 4 sencillos pasos </h3>
                <h3><a href="{{ url('/register') }}" class="btn btn-lg btn-success">{{ trans('adminlte_lang::message.gedstarted') }}</a></h3>
            </div>
            <div class="col-lg-2">
                <h5>Opciones consultadas dinámicamente</h5>
                <p>Estas son las posibilidades individuales para cada creación de cubo OLAP</p>
                <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/arrow1.png') }}">
            </div>
            <div class="col-lg-8">
                <img class="img-responsive" src="{{ asset('/img/frond-print/dashboard.jpg') }}" alt="">
            </div>
            <div class="col-lg-2">
                <br>
                <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/arrow2.png') }}">
                <h5>Operaciones de Agregación</h5>
                <p>... Una vez escogidas las opciones a visualizar, se generan las opciones operacionales tipicas de los cubos OLAP</p>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->


<section id="desc" name="desc"></section>
<!-- INTRO WRAP -->
<div id="intro">
    <div class="container">
        <div class="row centered">
            <h1>Principales Caracteristicas</h1>
            <br>
            <br>
            <div class="col-lg-4">
                <img src="{{ asset('/img/intro01.png') }}" alt="">
                <h3>Open Source</h3>
                <p>Este proyecto desponible en <a href="https://github.com/Daespinosag/gaia-olap">Github</a>, Es de libre acceso, edición y distribución</p>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('/img/intro02.png') }}" alt="">
                <h3>Soporte</h3>
                <p>Grupo de Investigacion en Ambientes Inteligentes Adaptativos <a href="http://gta.manizales.unal.edu.co/gaia/">GAIA</a></p>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('/img/intro03.png') }}" alt="">
                <h3>Modificación</h3>
                <p>Este es un proyecto de graduación de estudios profesionales, Gracias a su <a href="">arquitectira</a> se hace facil su modificación</p>
            </div>
        </div>
        <br>
        <hr>
    </div> <!--/ .container -->
</div><!--/ #introwrap -->

<!-- FEATURES WRAP -->
<div id="features">
    <div class="container">
        <div class="row">
            <h1 class="centered">{{ trans('adminlte_lang::message.whatnew') }}</h1>
            <br>
            <br>
            <div class="col-lg-6 centered">
                <img class="centered" src="{{ asset('/img/3d-cube.png') }}" alt="">
            </div>

            <div class="col-lg-6">
                <h3>{{ trans('adminlte_lang::message.features') }}</h3>
                <br>
                <!-- ACCORDION -->
                <div class="accordion ac" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                Mapeo de base de datos
                            </a>
                        </div><!-- /accordion-heading -->
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                <p> Se incluyo en el proyecto con el objetivo  de hacer facil e intuitiva la creacion de cubos OLAP, un componente para que permite la generacion de un grafo con el mapa del data warehouse.</p>
                                <div class="centered">
                                    <img class="centered" src="{{ asset('/img/frond-print/anexo-figura-1.jpg') }}" alt="">
                                </div>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                Composición de consultas
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>Diferente de todas las herramientas OLAP que estan disponibles actualmente, GAIA-OLAP no pre-calcula los datos para las visualizaciones OLAP. sino que compoene comsultas dependiendo de la interaccion del usuario con la plataforma.</p>
                                <div class="centered">
                                    <img class="centered" src="{{ asset('/img/frond-print/anexo-figura-3.jpg') }}" alt="">
                                </div>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                Dashboard, Drang and Drop
                            </a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>Se diseño un compoenente de interacción basado en tecinas Drag and Drop (agarrar y soltar). Con el objetivo de hacer mas usable la plataforma una vez se hayan creado los cubos OLAP</p>
                                <div class="centered">
                                    <img class="centered" src="{{ asset('/img/frond-print/anexo-figura-4.jpg') }}" alt="">
                                </div>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>

                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                Arquitectura Modular
                            </a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <p>Uno de los objetivos fundamentales fue hacer la plataforma escalable en el tiempo para  eso se diseño una arquitectura que propicia el escalado y/o el intercambio de codigo</p>
                                <div class="centered">
                                    <img class="centered" src="{{ asset('/img/frond-print/anexo-figura-2.jpg') }}" alt="">
                                </div>
                            </div><!-- /accordion-inner -->
                        </div><!-- /collapse -->
                    </div><!-- /accordion-group -->
                    <br>
                </div><!-- Accordion -->
            </div>
        </div>
    </div><!--/ .container -->
</div><!--/ #features -->


<section id="showcase" name="showcase"></section>
<div id="showcase">
    <div class="container">
        <div class="row">
            <h1 class="centered">Proceso de registro de un Cubo-OLAP</h1>
            <br>
            <div class="col-lg-8 col-lg-offset-2">
                <div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li class="success" data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{ asset('/img/frond-print/seleccion_conexion.jpg') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('/img/frond-print/creacion_conexion.jpg') }}" alt="">
                        </div>
                        <div class="item ">
                            <img src="{{ asset('/img/frond-print/datos_basicos_olap.jpg') }}" alt="">
                        </div>
                        <div class="item">
                            <img src="{{ asset('/img/frond-print/seleccion_tablas.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div><!-- /container -->
</div>


<section id="contact" name="contact"></section>
<div id="footerwrap">
    <div class="container">

        <div class="col-lg-5">
            <h3>Autor</h3>
            <p>
                Daniel Andres Espinosa,<br/>
                Investigador GAIA,<br/>
                Trabajo de fin de carrera<br/>
                Administración de sistemas informáticos
            </p>
        </div>

        <div class="col-lg-7">
            <h3>{{ trans('adminlte_lang::message.dropus') }}</h3>
            <br>
            <form role="form" action="#" method="post" enctype="plain">
                <div class="form-group">
                    <label for="name1">{{ trans('adminlte_lang::message.yourname') }}</label>
                    <input type="name" name="Name" class="form-control" id="name1" placeholder="{{ trans('adminlte_lang::message.yourname') }}">
                </div>
                <div class="form-group">
                    <label for="email1">{{ trans('adminlte_lang::message.emailaddress') }}</label>
                    <input type="email" name="Mail" class="form-control" id="email1" placeholder="{{ trans('adminlte_lang::message.enteremail') }}">
                </div>
                <div class="form-group">
                    <label>{{ trans('adminlte_lang::message.yourtext') }}</label>
                    <textarea class="form-control" name="Message" rows="3"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-large btn-success">{{ trans('adminlte_lang::message.submit') }}</button>
            </form>
        </div>
    </div>
</div>
<div id="c">
    <div class="container">
        <p>
            <a href="https://github.com/Daespinosag/gaia-olap"></a><b>Gaia-Olap</b></a>. Una Herramienta para analisis multidimencional OLAP.<br/>
            <strong>Grupo de investigacion en agentes inteligentes adaptativos GAIA</a>
            <br/>Trabajo de fin de carrera
            <br/>
            Daniel Andres Espinosa Gomez
        </p>

    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
