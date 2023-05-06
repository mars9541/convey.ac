@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Presse et médias</h2>
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
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">À propos de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Contexts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="About-tab">
                            <div class="padding-top-middle"></div>
                            <p>Les dossiers d'emploi transférables sont des fichiers numériques qui CONVOQUENT d'un employeur à l'autre, permettant aux employés de conserver un historique de leurs réalisations professionnelles même lorsqu'ils changent d'employeur.
<br><br>
                                Tous les dossiers transmissibles sont stockés en toute sécurité dans la banque de données CONVEY, une ressource centralisée neutre à laquelle les employés, les employeurs et les fournisseurs tiers agréés n'ont accès que sur autorisation. Ce niveau de neutralité permet aux entreprises, grandes et petites, d'établir des connexions sécurisées à la banque de données CONVEY afin de stocker et d'accéder aux dossiers des employés.</p>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="Background-tab">
                            <div class="padding-top-middle"></div>
                            <p>CONVEY a été fondé par Clive Lambert qui, en 2019, a remarqué qu'un grand nombre d'informations contenues dans les dossiers d'emploi n'étaient pas utilisées à leur plein potentiel en raison de la manière dont elles étaient stockées.
<br><br>
                                CONVEY fonctionne comme un produit autonome, mais s'intègre également à de nombreux fournisseurs de logiciels de RH/recrutement qui reconnaissent les avantages de la transmissibilité qu'ils souhaitent apporter à leurs propres utilisations professionnelles.</p>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="padding-top-middle"></div>
                            <p> Pour les questions relatives à la presse et aux médias, veuillez transmettre toutes les communications à : <br><br> press@convey.ac</p>
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
                                            Télécharger les fichiers de logo
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Veuillez télécharger nos logos à partir d'ici. Notre page de marque, située dans le pied de page du site, vous indiquera comment utiliser les logos dans le respect de nos directives de marque.
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_logo')}}" class="color-black-light downloadable-tag">TELECHARGER LES LOGOS<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                            Télécharger les captures d'écran
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Veuillez télécharger les captures d'écran de notre site web à partir d'ici.
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_screen_shot')}}" class="color-black-light downloadable-tag">TÉLÉCHARGER LES IMAGES<i class="fa fa-download m-lg-1"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="card single-faq">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h5 class="mb-0">
                                        <a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                            Télécharger les images d'en-tête d'article
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Veuillez télécharger les images d'en-tête de notre article ici.
                                        <br><br>
                                        <a href="{{url('frontend_downloadable_file/press_header_images')}}" class="color-black-light downloadable-tag">TÉLÉCHARGER LES IMAGES<i class="fa fa-download m-lg-1"></i></a>
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
