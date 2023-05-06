@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>3 modi per passare a CONVEY<h2>
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
                            <h5>1. Usare DIRECT CONNECT</h5>
                            <span class="title-border-left"></span>
                            <p> Il modo più semplice per passare ai Registri di Impiego Ttrasferibili è accedere al tuo account e utilizzare il nostro modulo DIRECT CONNECT per iniziare a creare nuovi registri. Il modulo è uno strumento di base per creare registri già utilizzato da molte piccole imprese (e aziende senza un sistema di analisi dei dipendenti).<br><br> Il modulo DIRECT CONNECT è GRATUITO, non ci sono limiti al numero di dipendenti che puoi aggiungere o al numero di registri che puoi creare ed è adatto alla maggior parte delle aziende.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/it/CONTROLPANEL.png" alt="sample image">
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
                            <h5>2. Utilizzare un fornitore approvato</h5>
                            <span class="title-border-left"></span>
                            <p>Se desideri più funzionalità rispetto a quelle fornite con il nostro modulo DIRECT CONNECT, puoi creare un account con uno dei nostri partner approvati (se attualmente crei i tuoi registri con uno dei nostri partner approvati, questi avranno già stabilito una connessione con CONVEY che sincronizza automaticamente nella BANCA DATI CONVEY i registri che crei con loro).<br><br>Molti fornitori di sistemi di gestione e valutazione della forza lavoro, fornitori di HRIS, ATS e VMS hanno previsto la richiesta di una connessione CONVEY semplice e stanno collegando i loro sistemi. Se hai già un account con uno di questi fornitori approvati, puoi ottenere l'accesso immediato alla BANCA DATI CONVEY con solo un paio di clic.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/it/supplier.png" alt="sample image">
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
                            <h5>3. Usare una connessione API personalizzata</h5>
                            <span class="title-border-left"></span>
                            <p>Le grandi aziende con software personalizzato possono utilizzare l'API CONVEY per creare una connessione personalizzata. L'API è stata progettata per connettersi alla BANCA DATI CONVEY tramite un'interfaccia programmatica standardizzata. L'API CONVEY è un'API RESTful basata su richieste HTTP e risposte JSON. <br><br>Gli sviluppatori che conoscono i tuoi sistemi saranno in grado di completare facilmente questo processo entro 2-5 giorni.<br><br>

                                Accedi al tuo account per ulteriori informazioni su come completare questo processo.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/it/api2.png" alt="sample image">
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
