@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Crea tu cuenta GRATIS ahora</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">

                            <p>Crea tu cuenta GRATIS ahora y seguirá siendo GRATUITA durante todo el tiempo que la necesites.<br><br>Nuestra solución "on point" te permite crear Expedientes de Empleo Transferibles para cada uno de tus empleados y crear una cultura positiva centrada en los beneficios a largo plazo de tus empleados (no hay límites en el número de empleados que puedes añadir ni en el número de expedientes que puedes crear).<br><br>Una cuenta CONVEY debería costar entre 490 y 29,995 euros al año, dependiendo del tamaño de la empresa, y la mayoría de las empresas acabarán de dar el paso a CONVEY en los próximos 18 meses, así que crea tu cuenta ahora que todavía es gratuita y lo seguirá siendo mientras la necesites.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/es/people.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Información cuando la necesites</h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="business-feature-1x">
        <div class="container">
            <div class="business-features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">BÚSQUEDA...<br><br>Una búsqueda segura en el BANCO DE DATOS DE CONVEY para encontrar los expedientes de empleo de un nuevo candidato solo cuesta un crédito de búsqueda.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">RESULTADOS...<br><br>Cada búsqueda mostrará al instante todos los expedientes añadidos previamente por el/los empleador/es anterior/es y actual/es del candidato.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">COSTE...<br><br>El coste de cada crédito de búsqueda es a partir de 5€ y si la búsqueda no da resultados, no se descontará el crédito.<BR>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp.... 100% SIN RIESGO<br></h5>
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
