@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Des Données Protégées</h2>
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
                    <p>Tous les dossiers transférables sont stockés en toute sécurité dans la BANQUE DE DONNÉES CONVEY qui constitue une ressource centralisée neutre située au sein de la plateforme CONVEY. La plateforme CONVEY a été construite selon le principe de la "protection des données dès la conception et par défaut", ce qui signifie que la sécurité et la confidentialité des données sont l'élément central autour duquel tout le reste est établi. Ce principe est décrit par l'article 25 du GDPR et couvre tout, y compris la manière dont les données entrent dans la plate-forme, protégées par un cryptage (Transport Layer Security) rendant les données impossibles à lire pendant leur transit, jusqu'au cryptage des enregistrements et des champs, et même à la suppression des enregistrements si la demande est acceptée.</p>
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
                            <h5>Stockage sécurisé des données</h5>
                            <span class="title-border-left"></span>
                            <p>La plateforme CONVEY est hébergée en toute sécurité dans nos centres de données certifiés ISO27001:2013, qui disposent d'un système de sécurité sur site 24 heures sur 24 et 7 jours sur 7, d'un système de vidéosurveillance complet avec identification par photo et entrée par carte magnétique. Pour garantir une disponibilité maximale de la plateforme CONVEY, notre matériel est équipé d'alimentations redondantes et ininterrompues.<br>
                                <br>Notre infrastructure bénéficie également d'un système de protection anti-DDOS (Distributed denial of service) de 1 Tbps. Les attaques DDOS peuvent paralyser de nombreux serveurs, mais grâce à ce système, en cas d'attaque, la plateforme CONVEY pourra continuer à traiter les données sans interruption.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/fr/sec.png" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="business-feature-1x">
        <div class="container">
            <div class="business-features">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/leader.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Sécurité des é-mails.<br><br> Pour protéger nos systèmes, tous les e-mails envoyés vers et depuis la plateforme CONVEY sont analysés par une triple protection antivirus et anti-spam avancée.<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Attaques Malicieuses.<br><br> Notre Web Application Firewall (pare feu) effectue une inspection à la microseconde de chaque demande HTTP à la recherche d'injections SQL, de troyens, de scripts inter-sites, de chemins d'accès et de nombreux autres types d'attaques.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">SAUVEGARDE DES DONNÉES.<br><br> L'ensemble de la plateforme CONVEY bénéficie de sauvegardes chronologiques automatisées qui se produisent à des moments précis de la journée. Ces sauvegardes instantanées garantissent que nos systèmes restent entièrement récupérables.<br></h5>
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
