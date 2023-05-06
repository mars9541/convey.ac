@extends('layouts.frontend-master')
@section('content')
<div class="padding-top-large"></div>

<div class="bussiness-component-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="business-title-middle">
                    <h2>Les Avantages Immédiats</h2>
                    <span class="title-border-middle"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="padding-top-large"></div>

<div class="bussiness-dropcaps">
    <div class="container">
        <div class="row">
            <div class="col-md-6 dropcaps">
                <p><strong>ANCIEN</strong>Les systèmes que vous avez actuellement en place limitent l'utilité des dossiers de vos employés. <br><br> Le type de "dossiers statiques" dont vous disposez actuellement n'offre aucune valeur à long terme à l'objet de ces dossiers (l'employé), qui devient évidente au moment de son départ, lorsque toutes ses contributions et réalisations sont abandonnées. <br><br> Cette approche inutile est aujourd'hui abandonnée par de nombreuses entreprises qui abandonnent activement les "dossiers statiques" au profit de dossiers " transmissibles ".</p>
            </div>
            <div class="col-md-6 dropcaps">
                <p><strong>NOUVEAU</strong>En passant aux relevés d'emploi transmissibles, vous pouvez faire en sorte que vos relevés fonctionnent pour vous.<br><br>Une fois terminé, les dossiers que vous créez et traitez concernant vos employés deviendront automatiquement transmissibles, ce qui permettra à vos employés de CONVOQUER leurs "dossiers d'emploi" à un autre employeur en cas de départ.<br><br> Pendant leur emploi chez vous, les employés seront très motivés pour constituer leurs "relevés d'emploi transmissibles" et créer un actif précieux pour une future utilisation.</p>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>


<div class="business-features-3x">
    <div class="colourful-features-content">
        <div class="row">
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-1">
                    <h3>01.</h3>
                    <h2>Enregistrements non modifiables</h2>
                    <p>Tous les enregistrements transmissibles sont non modifiables afin de garantir l'intégrité des données à long terme.</p>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-2">
                    <h3>02.</h3>
                    <h2>100% Transparent</h2>
                    <p>Tous les documents sont visibles pour l'employé, l'employeur et les employeurs potentiels autorisés.</p>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-3">
                    <h3>03.</h3>
                    <h2>Visibilité à 100%</h2>
                    <p>Tous les enregistrements saisis sont visibles, de sorte que les enregistrements positifs et négatifs sont présentés de la même manière.</p>
                </div>
            </div>
            <div class="col-md-3 no-padding">
                <div class="single-colorful-feature feature-color-4">
                    <h3>04.</h3>
                    <h2>Enregistrements constructibles</h2>
                    <p>Enregistrements communicables créés par un ancien employeur et complétés par un employeur actuel</p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="padding-top-large"></div>

<div class="business-app-present-2x">
    <div class="app-present-content-2">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Aucun coût avantageux ... </h2>
                        <span class="title-border-middle"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="margin-top-middle"></div>
                </div>

                <div class="col-md-7">
                    <div class="app-present-left-2">
                        <img src="{{asset('landing_front')}}/images/fr/ipad.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right-2">
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-phone"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.1.png" width="30px" alt="higher engagement">
                                </span>
                                <div class="media-body">
                                    <h2>Des niveaux d'engagement plus élevés</h2>
                                    <p>Attendez-vous à des niveaux accrus d'engagement des employés, ce qui se traduira par une meilleure attitude à l'égard des tâches et des rôles.</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-podcast"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.2.png" width="30px" alt="Improved Productivity">
                                </span>
                                <div class="media-body">
                                    <h2>Productivité améliorée</h2>
                                    <p>Attendez-vous à des niveaux de productivité plus élevés de la part de vos employés engagés.</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-user"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.3.png" width="30px" alt="Reduced Costs">
                                </span>
                                <div class="media-body">
                                    <h2>Coûts réduits</h2>
                                    <p>Attendez de vos employés engagés qu'ils répondent mieux aux incitations à coût zéro.</p>
                                </div>
                            </div>
                        </div>
                        <div class="single-app-present">
                            <div class="media">
                                <span class="animatedhover pulse">
{{--                                    <i class="fa fa-bus"></i>--}}
                                    <img src="{{asset('landing_front')}}/images/New folder/4.4.png" width="30px" alt="Fewer Sick">
                                </span>
                                <div class="media-body">
                                    <h2>Moins de congés médicaux</h2>
                                    <p>Attendez-vous à ce que vos employés engagés prennent moins de congés médicaux.</p>
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

<div class="business-app-present-1x">
    <div class="app-present-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="app-present-left">
                        <img src="{{asset('landing_front')}}/images/fr/design4.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>Créez de Simple TRANSFERABLE...</h3>
                        <h2>RELEVÉS DES EMPLOYÉS</h2>
                        <p>Si vous ne disposez pas encore d'un moyen de créer des fiches d'employés, vous pouvez utiliser notre module DIRECT CONNECT.<br><br>Votre compte CONVEY est préchargé avec notre module DIRECT CONNECT, ce qui vous permet d'ajouter vos employés et de commencer à créer des enregistrements transférables immédiatement. Il n'y a aucune limite au nombre d'employés que vous pouvez ajouter ou au nombre d'enregistrements que vous pouvez créer, ce qui convient à la plupart des entreprises.<br><br>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="padding-top-large"></div>
<div class="padding-top-large"></div>

<div class="about-business-2x">
    <div class="container">
        <div class="about-business-content-2x">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-business-left-2x">
                        <h5 style="font-size: 40px;">Réseau de Prestataires Agréés</h5>
                        <span class="title-border-left"></span>
                        <p>Si vous utilisez déjà un autre système pour créer les dossiers de vos employés, votre fournisseur actuel peut automatiquement rendre ces dossiers également TRANSFÉRABLE.<br><br>

                            Pour la plupart des entreprises, la mise à niveau vers le système de dossiers transférables constituera une avancée considérable et de nombreux fournisseurs de systèmes de gestion et d'évaluation de la main-d'œuvre (SIRH, ATS et VMS) sont en train de connecter leurs systèmes à la banque de données CONVEY afin d'automatiser ce processus et de le rendre plus facile pour vous. <br><br>Si votre fournisseur actuel est un fournisseur agréé, vous pourrez continuer à créer vos enregistrements comme vous le faites actuellement et ils deviendront automatiquement TRANSFÉRABLE. </p>
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
<div class="padding-top-large"></div>

<div class="business-app-present-1x">
    <div class="app-present-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="app-present-left">
                        <img src="{{asset('landing_front')}}/images/introduct-design3.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>Renforcer les équipes avec ...</h3>
                        <h2>DIRECTEUR DE FILIALE</h2>
                        <p>CONVEY répond aux besoins des petites et grandes entreprises grâce à une série de fonctionnalités, dont le DIRECTEUR DE FILIALE.<br><br> Les entreprises dont les équipes travaillent sur plusieurs sites peuvent créer autant de comptes de filiales segmentés que nécessaire. Chaque compte filiale disposera de ses propres fonctionnalités de recherche et de rapport, mais partagera les ressources du compte principal, ce qui permettra une supervision et un contrôle complets.<br><br>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="padding-top-large"></div>
<div class="padding-top-large"></div>

<div class="about-business-2x">
    <div class="container">
        <div class="about-business-content-2x">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-business-left-2x">
                        <h5 style="font-size: 40px;">Rangement sécurisé des dossiers.</h5>
                        <span class="title-border-left"></span>
                        <p>Tous les dossiers transférables sont rangés en toute sécurité dans la banque de données CONVEY DATABANK, une ressource centralisée neutre à laquelle les employés, les employeurs et les fournisseurs tiers agréés n'ont accès que sur autorisation. Ce niveau de neutralité permet aux entreprises, grandes et petites, d'établir des connexions sécurisées avec le CONVEY DATABANK afin de stocker et d'accéder aux dossiers des employés.<br><br> Grâce à une structure de données spécifique à chaque pays, la banque de données CONVEY est conforme aux exigences locales et internationales en matière de confidentialité.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/map.jpeg" alt="sample image">
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
