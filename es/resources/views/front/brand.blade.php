@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Guía de marca<h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bussiness-highlight-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

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
                            <h5><br><br>Requisito básico.</h5>
                            <span class="title-border-left"></span>
                            <p> Para que te resulte más fácil aprovechar la fuerza de nuestra marca, hemos desarrollado esta guía básica como esquema de uso preautorizado. Esto te permitirá utilizar nuestro LOGO sin tener que pedir permiso previamente.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/basiclogo.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5><br><br>Apariencia.</h5>
                            <span class="title-border-left"></span>
                            <p>Lo ideal es que nuestro logotipo se muestre siempre a todo color, pero entendemos que a veces puedes necesitar utilizarlo en un solo color. Los ejemplos que se muestran aquí muestran cómo debería mostrarse nuestro logotipo en diferentes condiciones. Descarga nuestros logotipos aquí:
                                <br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url('frontend_downloadable_file/convey_colour_logo')}}" class="color-black-light downloadable-tag">Logotipo en color</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_black_logo')}}" class="color-black-light downloadable-tag">Logotipo negro sobre blanco</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_white_logo')}}" class="color-black-light downloadable-tag">Logotipo blanco sobre negro</a></p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/appearance.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5><br>Espaciado</h5>
                            <span class="title-border-left"></span>
                            <p>Para garantizar la correcta presentación de nuestro logotipo, asegúrate de seguir la guía de espaciado que se muestra aquí. Este espaciado mínimo garantiza que nuestro logotipo no quede obstruido y ayuda a maximizar la imagen del logotipo.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/spacing.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5><br><br>Uso inaceptable.</h5>
                            <span class="title-border-left"></span>
                            <p>Nuestra marca es importante para nosotros y nos gustaría asegurarnos de que no se devalúa de ningún modo. Estos son algunos ejemplos de lo que no se debe hacer con nuestro logotipo.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/unacceptable.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5><br><br>Colores.</h5>
                            <span class="title-border-left"></span>
                            <p>Nuestro logotipo se compone de dos colores que se muestran sobre un fondo blanco. Cuando el logotipo se imprime en color, deben utilizarse estos colores sin excepción. </p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/colours.png" alt="sample image">
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
