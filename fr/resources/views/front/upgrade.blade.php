@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>3 Façons de Mettre à Niveau<h2>
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

    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5>1. Utilisez DIRECT CONNECT</h5>
                            <span class="title-border-left"></span>
                            <p> La façon la plus simple de passer à la version des relevés d'emploi transmissibles est de vous connecter à votre compte et d'utiliser notre module DIRECT CONNECT pour commencer à créer de nouveaux relevés. Ce module est un outil de base qui est déjà utilisé par de nombreuses petites entreprises (et des entreprises qui n'ont pas de système de contrôle des employés) pour créer des dossiers.<br><br> L'utilisation du module DIRECT CONNECT est GRATUITE, il n'y a aucune limite au nombre d'employés que vous pouvez ajouter ou au nombre d'enregistrements que vous pouvez créer, ce qui le rend adapté à la plupart des entreprises.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/fr/CONTROLPANEL.png" alt="sample image">
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
                            <h5>2. Utiliser un fournisseur agréé</h5>
                            <span class="title-border-left"></span>
                            <p>Si vous souhaitez plus de fonctionnalités que celles fournies par notre module DIRECT CONNECT, vous pouvez créer un compte avec l'un de nos partenaires agréés (si vous créez actuellement vos enregistrements avec l'un de nos partenaires agréés, celui-ci aura déjà établi sa propre connexion CONVEY qui synchronise automatiquement les enregistrements que vous créez avec lui avec la banque de données CONVEY).<br><br>De nombreux fournisseurs de systèmes de gestion des ressources humaines et d'évaluation, de SIRH, d'ATS et de VMS ont prévu la demande d'une connexion facile à CONVEY et sont en train de relier leurs systèmes. Si vous avez déjà un compte chez l'un de ces fournisseurs agréés, vous pouvez accéder directement à la banque de données CONVEY en quelques clics.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/fr/supplier.png" alt="sample image">
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
                            <h5>3. Utiliser une connexion API personnalisée</h5>
                            <span class="title-border-left"></span>
                            <p>Les grandes entreprises possédant un logiciel personnalisé peuvent utiliser l'API CONVEY pour créer une connexion personnalisée. L'API a été conçue pour se connecter à la BANQUE DE DONNEES CONVEY via une interface programmatique standardisée. L'API CONVEY est une API de type RESTful basée sur des demandes HTTPs et des réponses JSON.<br><br>Les développeurs ayant une connaissance de vos systèmes existants pourront facilement effectuer ce processus en 2 à 5 jours.<br><br>
                            Connectez-vous à votre compte pour plus d'informations sur la façon de réaliser ce processus.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/fr/api2.png" alt="sample image">
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
