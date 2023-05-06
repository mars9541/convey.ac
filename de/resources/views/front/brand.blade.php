@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Markenrichtlinien<h2>
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



    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5><br><br>Grundvoraussetzung.</h5>
                            <span class="title-border-left"></span>
                            <p> Um es Ihnen zu erleichtern, die Stärke unserer Marke zu nutzen, haben wir diesen grundlegenden Leitfaden als Übersicht über die vorab genehmigte Verwendung entwickelt. So können Sie unser LOGO verwenden, ohne erst eine Genehmigung einholen zu müssen.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/basiclogo.png" alt="sample image">
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
                            <h5><br><br>Erscheinungsbild.</h5>
                            <span class="title-border-left"></span>
                            <p>Idealerweise sollte unser Logo immer vollfarbig dargestellt werden. Wir verstehen jedoch, dass Sie unser Logo manchmal einfarbig verwenden müssen. Die hier gezeigten Beispiele zeigen, wie unser Logo unter verschiedenen Bedingungen aussehen sollte. Laden Sie unsere Logos hier herunter:
                                <br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url('frontend_downloadable_file/convey_colour_logo')}}" class="color-black-light downloadable-tag">Farbiges Logo</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_black_logo')}}" class="color-black-light downloadable-tag">Schwarz auf Weiß Logo</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_white_logo')}}" class="color-black-light downloadable-tag">Weiß auf Schwarz Logo</a></p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/appearance.png" alt="sample image">
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
                            <h5><br>Abstände</h5>
                            <span class="title-border-left"></span>
                            <p>Um sicherzustellen, dass unser Logo korrekt dargestellt wird, stellen Sie bitte sicher, dass die hier gezeigten Abstände eingehalten werden. Dieser Mindestabstand stellt sicher, dass unser Logo nicht verdeckt wird und trägt dazu bei, das Image des Logos zu maximieren.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/spacing.png" alt="sample image">
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
                            <h5><br><br>Inakzeptable Verwendung.</h5>
                            <span class="title-border-left"></span>
                            <p>Unser Markenzeichen ist uns wichtig und wir möchten sicherstellen, dass es in keiner Weise entwertet wird. Hier sind einige Beispiele dafür, was Sie mit unserem Logo nicht tun sollten.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/unacceptable.png" alt="sample image">
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
                            <h5><br><br>Farben.</h5>
                            <span class="title-border-left"></span>
                            <p>Unser Logo besteht aus zwei Farben, die auf weißem Hintergrund dargestellt sind. Wenn das Logo in Farbe gedruckt wird, müssen diese Farben ausnahmslos verwendet werden.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/colours.png" alt="sample image">
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
