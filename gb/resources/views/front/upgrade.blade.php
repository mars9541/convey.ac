@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>3 Ways to Upgrade<h2>
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
                            <h5>1. Use DIRECT CONNECT</h5>
                            <span class="title-border-left"></span>
                            <p> The easiest way to upgrade to Conveyable Employment Records is to login to your account and use our DIRECT CONNECT module to start creating new records. The module is a basic tool which is already being used by many Small businesses (and businesses with no existing employee reviewing system) to create records.<BR><BR> The DIRECT CONNECT module is FREE to use, there are no limits to the number of employees you can add or the number of records you can create making it suitable for most businesses.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/gb/CONTROLPANEL.png" alt="sample image">
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
                            <h5>2. Use an Approved Provider</h5>
                            <span class="title-border-left"></span>
                            <p>If you are wanting more features than those that come with our DIRECT CONNECT module you can create an account with one of our approved partners, (if you currently create your records with one of our approved partners they will have already established a CONVEY connection of their own which automatically SYNCs the records you create with them to the CONVEY Databank).<br><br>Many Workforce Management and Appraisal System providers, HRIS, ATS, and VMS providers have forseen the demand for an easy CONVEY connection and are in the process of linking their systems. If you already have an account with one of these approved providers you can gain instant access to the CONVEY Databank with just a couple of button clicks.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/gb/supplier.png" alt="sample image">
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
                            <h5>3. Use a Custom API Connection</h5>
                            <span class="title-border-left"></span>
                            <p>Large businesses with custom software can use the CONVEY API to create a custom connection, the API has been designed to connect to the CONVEY Databank via a standardized programmatic interface. The CONVEY API is a RESTful API based on HTTPs requests and JSON responses. <BR><BR>Developers with knowledge of your existing systems will be able to easily complete this process within 2-5 days.<BR><BR>

                                                Login to your account for more information about how to complete this process.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/api2.png" alt="sample image">
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
