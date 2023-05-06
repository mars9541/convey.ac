@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Prensa y medios de comunicación</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="bussiness-tab-accordion">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Antecedentes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contacte con</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="About-tab">
                            <div class="padding-top-middle"></div>
                            <p>Los expedientes de empleo transportables son archivos digitales que se transmiten de una empresa a otra, lo que permite a los empleados conservar un historial de sus logros laborales incluso cuando cambian de empresa.
                                <br><br>
                                Todos los Expedientes Transportables se almacenan de forma segura en el banco de datos de CONVEY, que es un recurso centralizado de posición neutral al que sólo pueden acceder los empleados, los empleadores y los proveedores autorizados de terceros. Este nivel de neutralidad permite a las empresas, tanto grandes como pequeñas, establecer conexiones seguras con el banco de datos de CONVEY para almacenar y acceder a los registros de los empleados.</p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="Background-tab">
                            <div class="padding-top-middle"></div>
                            <p>CONVEY fue fundada por Clive Lambert, quien en 2019 se dio cuenta de que una gran cantidad de información contenida en los registros de empleo no se utilizaba en todo su potencial debido a la forma en que se almacenaba.
<br><br>
                                CONVEY funciona como un producto independiente, pero también se integra con muchos proveedores de software de RRHH/reclutamiento que reconocen los beneficios de la transmisibilidad que quieren aportar a sus propios usos empresariales.</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="padding-top-middle"></div>
                            <p> Para consultas de prensa y medios de comunicación, envíe todas las comunicaciones a : <br><br> press@convey.ac</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="business-faq">

                        <div class="panel-group" id="accordion" role="tablist">

                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                            Descargar archivos de logotipos
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Descargue nuestros logotipos desde aquí, nuestra página de marca en el pie de página del sitio web le indicará cómo utilizar los logotipos dentro de nuestras directrices de marca.
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_logo')}}" class="color-black-light downloadable-tag">DESCARGAR LOGOS<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                            Descargar capturas de pantalla
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Descargue las imágenes de nuestro sitio web desde aquí.
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_screen_shot')}}" class="color-black-light downloadable-tag">DESCARGAR IMÁGENES<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                            Descargar imágenes de la cabecera del artículo
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Descargue las imágenes de la cabecera del artículo desde aquí.
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_header_images')}}" class="color-black-light downloadable-tag">DESCARGAR IMÁGENES<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="business-cta-2x">
        <div class="business-cta-2-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="business-cta-left-2">
                            <h2>Un Gran Salto Adelante ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">ACTUALIZAR AHORA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
