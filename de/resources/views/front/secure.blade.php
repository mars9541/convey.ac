@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Geschützte DATEN</h2>
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
                    <p>Alle übertragbaren Datensätze werden sicher in der CONVEY DATABANK gespeichert, die eine neutral positionierte, zentralisierte Ressource innerhalb der CONVEY-Plattform ist. Die CONVEY-Plattform wurde nach dem Prinzip "Data Protection by Design and by Default" aufgebaut, was bedeutet, dass Datensicherheit und Datenschutz die zentralen Elemente sind, um die herum alles andere aufgebaut wird. Dieses Prinzip ist in Artikel 25 der Datenschutz-Grundverordnung (GDPR) festgelegt und umfasst alles, von der Art und Weise, wie die Daten in die Plattform gelangen, über eine Verschlüsselungsschicht (Transport Layer Security), die das Lesen der Daten während der Übertragung unmöglich macht, bis hin zur Verschlüsselung von Datensätzen, Feldern und sogar dem Löschen von Datensätzen nach einer erfolgreichen Anfrage.</p>
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
                            <h5>SICHERE Datenspeicherung</h5>
                            <span class="title-border-left"></span>
                            <p>Die CONVEY-Plattform befindet sich sicher in unseren ISO27001:2013-zertifizierten Rechenzentren, die rund um die Uhr vor Ort bewacht werden und über eine vollständige CCTV-Überwachung mit Foto-ID und Zugang per Magnetkarte verfügen. Um eine maximale Betriebszeit der CONVEY-Plattform zu gewährleisten, wird unsere Hardware durch redundante und unterbrechungsfreie Stromversorgungen versorgt.<br>
                                <br>Unsere Infrastruktur profitiert auch von einem 1 Tbps Anti-DDoS (Distributed Denial of Service) Schutzsystem. DDOS-Attacken können viele Server lahmlegen, aber mit diesem System ist die CONVEY-Plattform im Falle eines Angriffs in der Lage, die Datenverarbeitung ohne Unterbrechung fortzusetzen.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/de/sec.png" alt="sample image">
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
                                    <h5 class="mt-0">E-Mail-Sicherheit.<br><br> Zum Schutz unserer Systeme werden alle E-Mails, die zur und von der CONVEY-Plattform gesendet werden, einem fortschrittlichen dreistufigen Antiviren- und Antispamschutz-Scan unterzogen.<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Bösartige Angriffe.<br><br> Unsere Web Application Firewall prüft jede HTTP-Anfrage im Millisekundenbereich auf SQL-Injection, Trojaner, Cross-Site-Scripting, Path Traversal und viele andere Arten von Angriffen.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">DATEN-SICHERUNG.<br><br> Die gesamte CONVEY-Plattform profitiert von automatisierten Backups, die zu festgelegten Zeitpunkten während des Tages durchgeführt werden. Diese Backups stellen sicher, dass unsere Systeme vollständig wiederherstellbar bleiben.<br></h5>
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
                            <h2>Ein Quantensprung nach vorn ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">JETZT UPGRADEN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
