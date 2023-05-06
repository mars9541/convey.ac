@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>DATI protetti</h2>
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
                    <p>Tutti i Registri Trasferibili sono archiviati in modo sicuro nella BANCA DATI CONVEY che è una risorsa centralizzata posizionata in modo neutrale situata all'interno della piattaforma CONVEY. La piattaforma CONVEY è stata costruita utilizzando il principio "Data Protection by Design and by Default", il che significa che la sicurezza e la privacy dei dati sono l'elemento centrale attorno al quale è fissato tutto il resto. Questo principio è delineato dall'articolo 25 del GDPR e copre tutto, dal modo in cui i dati entrano nella piattaforma racchiuso in un livello di crittografia (Transport Layer Security) che rende i dati impossibili da leggere durante il transito, fino alla registrazione e alla crittografia dei campi, e persino la cancellazione dei registri se richiesta.</p>
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
                            <h5>Archiviazione SICURA dei dati</h5>
                            <span class="title-border-left"></span>
                            <p>La piattaforma CONVEY è posizionata in modo sicuro nei nostri data center certificati ISO27001:2013 che beneficiano di sicurezza in loco 24 ore su 24, 7 giorni su 7, monitoraggio completo con CCTV e ID con foto e inserimento della tessera magnetica. Per garantire il massimo tempo di attività della piattaforma CONVEY, il nostro hardware è alimentato da alimentatori ridondanti e gruppi di continuità.<br>
                                <br>La nostra infrastruttura beneficia anche di un sistema di protezione anti-DDoS (Distributed Denial of Service) da 1 Tbps. Gli attacchi DDOS possono paralizzare molti server tuttavia con questo sistema in essere, in caso di attacco la piattaforma CONVEY sarà in grado di continuare a elaborare i DATI senza interruzioni.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/it/sec.png" alt="sample image">
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
                                    <h5 class="mt-0">Sicurezza della posta elettronica.<br><br> Per proteggere i nostri sistemi, tutte le e-mail inviate da e verso la piattaforma CONVEY sono sottoposte a un'avanzata scansione antivirus e antispam a tre passaggi.<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Attacchi dannosi.<br><br> Il nostro Web Application Firewall esegue un'ispezione al millisecondo di ogni richiesta HTTP per SQL injection, trojan, cross-site scripting, path traversal e molti altri tipi di attacco.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">BACKUP DEI DATI.<br><br> L'intera piattaforma CONVEY beneficia di backup automatici della sequenza temporale che si verificano in determinati punti durante il giorno. Queste istantanee di backup garantiscono che i nostri sistemi rimangano completamente recuperabili.<br></h5>
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
