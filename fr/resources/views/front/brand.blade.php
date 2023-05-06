@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Directives de la marque<h2>
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
                            <h5><br><br>L'Exigence de Base.</h5>
                            <span class="title-border-left"></span>
                            <p>Pour vous permettre de tirer plus facilement parti de la force de notre marque, nous avons élaboré ce guide de base comme un aperçu de l'utilisation préalablement approuvée. Cela vous permettra d'utiliser notre LOGO sans avoir besoin de demander une autorisation préalable.</p>
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
                            <h5><br><br>Apparence.</h5>
                            <span class="title-border-left"></span>
                            <p>En principe, notre logo devrait toujours être illustré en couleur, mais nous comprenons que vous puissiez parfois avoir besoin d'utiliser notre logo en une seule couleur. Les exemples présentés ici montrent comment notre logo doit apparaître dans différentes circonstances. Téléchargez nos logos ici :
                                <br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url('frontend_downloadable_file/convey_colour_logo')}}" class="color-black-light downloadable-tag">Logo en couleur</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_black_logo')}}" class="color-black-light downloadable-tag">Logo noir sur blanc</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_white_logo')}}" class="color-black-light downloadable-tag">Logo blanc sur noir</a></p>
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
                            <h5><br>Espacement</h5>
                            <span class="title-border-left"></span>
                            <p>Pour que notre logo soit correctement présenté, veuillez respecter les consignes d'espacement indiquées ici. Cet espacement minimum permet à notre logo de ne pas être obstrué et contribue à maximiser l'image du logo.</p>
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
                            <h5><br><br>Utilisation inacceptable.</h5>
                            <span class="title-border-left"></span>
                            <p>Nous tenons à ce que notre marque ne soit pas dévaluée en aucune façon. Voici quelques exemples de ce qu'il ne faut pas faire avec notre logo.</p>
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
                            <h5><br><br>Couleurs.</h5>
                            <span class="title-border-left"></span>
                            <p>Notre logo est composé de deux couleurs sur un fond blanc. Lorsque le logo est imprimé en couleur, ces couleurs doivent être utilisées sans exception.</p>
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
                            <h2>Un bond prodigieux en avant ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">METTRE À NIVEAU MAINTENANT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
