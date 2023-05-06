@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Crea ora il tuo account GRATUITO</h2>
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
                            <p>Crea ora il tuo account GRATUITO e rimarrà GRATUITO per tutto il tempo in cui ne avrai bisogno.<br><br>La nostra soluzione "on-point" ti consente di creare dei "Registri di Impiego Trasferibili" per ciascuno dei tuoi dipendenti e creare una cultura positiva incentrata sui benefici a lungo termine dei tuoi dipendenti (nessun limite al numero di dipendenti che puoi aggiungere o al numero di registri che puoi creare).<br><br>Un account CONVEY dovrebbe costare tra € 490 e € 29,995 all'anno a seconda delle dimensioni dell'azienda e la maggior parte delle aziende completerà il passaggio entro i prossimi 18 mesi, quindi crea il tuo account ora che è gratuito e rimarrà gratuito per tutto il tempo in cui ne avrai bisogno.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/it/people.png" alt="sample image">
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
                        <h2>Informazioni quando ne hai bisogno</h2>
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
                                    <h5 class="mt-0">RICERCA...<br><br>Una ricerca sicura nella BANCA DATI CONVEY per trovare i registri di impiego appartenenti a un nuovo candidato costerà solo un credito di ricerca.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">RISULTATI...<br><br>Ogni ricerca rivelerà istantaneamente tutti i registri precedentemente aggiunti dai precedenti e attuali datori di lavoro dei candidati.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0">COSTO...<br><br>Il costo di ogni credito di ricerca parte da sole €5 e se una ricerca non produce risultati il ​​credito non verrà detratto<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp.... 100% SENZA RISCHI<br></h5>
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
                            <h2>Un grande balzo in avanti ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">PASSA A CONVEY ORA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
