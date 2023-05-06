@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Protected DATA</h2>
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
                    <p>All Conveyable Records are stored securely in the CONVEY Databank which is a neutrally positioned centralised resource located within the CONVEY platform. The CONVEY platform has been built using the 'Data Protection by Design and by Default’ principle which means that Data Security and Data Privacy is the central element around which everything else in established. This principle is outlined by article 25 of the GDPR and covers everything from the way that data enters the platform wrapped in an encryption layer (Transport Layer Security) making the data impossible to read whilst in transit, through to record and field encryption, and even the deletion of records upon a successful request.</p>
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
                            <h5>SECURE Data Storage</h5>
                            <span class="title-border-left"></span>
                            <p>The CONVEY platform is securely located in our ISO27001:2013 certified data centres which benefit from 24-7 on site security, full CCTV monitoring with Photo ID and swipe card entry. To ensure maximum uptime of the CONVEY platform our hardware is powered by both redundant and uninterruptible power supplies.<br>
                                <br>Our infrastructure also benefits from a 1 Tbps anti-DDoS (Distributed denial of service) protection system. DDOS attacks can cripple many servers however with this system in place, in the event of an attack the CONVEY platform will be able to carry on processing DATA without interruption.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/us/sec.png" alt="sample image">
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
                                    <h5 class="mt-0">Email Security.<br><br> To protect our systems all emails sent to and from the CONVEY platform are subjected to an advanced triple layer antivirus and anti-spam protection scan.<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Malicious Attacks.<br><br> Our Web Application Firewall performs a millisecond inspection of every HTTP request for SQL injection, trojans, cross-site scripting, path traversal and many other types of attack.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">DATA BACKUPS.<br><br> The entire CONVEY platform benefits from automated timeline backups that occur at set points throughout the day. These backup snap shots ensure our systems remain fully recoverable.<br></h5>
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
                            <h2>A Quantum Leap Forward ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">UPGRADE NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
