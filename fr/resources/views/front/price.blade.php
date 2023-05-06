@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Créez votre compte GRATUIT dès maintenant</h2>
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

                            <p>Créez votre compte GRATUIT dès maintenant et il restera GRATUIT aussi longtemps que vous en aurez besoin.<br><br>Notre solution « on point » (sur place) vous permet de créer des « dossiers d'emploi transférables » pour chacun de vos employés et de créer une culture positive basée sur les avantages à long terme de vos employés (aucune limite au nombre d'employés que vous pouvez ajouter ou au nombre de dossiers que vous pouvez créer).<br><br>Un compte CONVEY devrait coûter entre 490 et 29 995 EUR par an, en fonction de la taille de l'entreprise. La majorité des entreprises effectueront leur mise à niveau dans les 18 prochains mois, alors créez votre compte maintenant pendant qu'il est gratuit et il le restera aussi longtemps que vous en aurez besoin.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/fr/people.png" alt="sample image">
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
                        <h2>Des informations quand vous en avez besoin</h2>
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
                                    <h5 class="mt-0">RECHERCHE...<br><br>Toute recherche sécurisée dans la banque de données CONVEY pour trouver les dossiers d'emploi d'un nouveau candidat ne coûte qu'un seul crédit de recherche.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">RÉSULTATS...<br><br>Chaque recherche permet de découvrir instantanément tous les enregistrements précédemment ajoutés par le ou les employeurs actuels et anciens du candidat.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">COÛT...<br><br>Le coût de chaque crédit de recherche commence à partir de 5 EUR seulement et si une recherche ne donne aucun résultat, le crédit ne sera pas débité.<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp.... 100% SANS RISQUE<br></h5>
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
