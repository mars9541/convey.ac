@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Linee guida del marchio</h2>
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
                            <h5><br><br>Requisito di base.</h5>
                            <span class="title-border-left"></span>
                            <p> Per farti sfruttare più agevolmente la forza del
                                nostro marchio, abbiamo sviluppato questa
                                guida di base come schema per l&#39;uso
                                preapprovato. Ciò ti permetterà di utilizzare il
                                nostro LOGO senza dover prima richiedere il
                                permesso.
                            </p>
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
                            <h5><br><br>Aspetto.</h5>
                            <span class="title-border-left"></span>
                            <p>Possibilmente il nostro logo dovrebbe sempre essere mostrato a pieno colore, tuttavia comprendiamo che a volte potrebbe essere necessario utilizzare il nostro logo con un singolo colore. Questi esempi dimostrano come il nostro logo dovrebbe apparire in condizioni diverse. Scarica i nostri loghi qui:
                                <br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url('frontend_downloadable_file/convey_colour_logo')}}" class="color-black-light downloadable-tag">Colore logo</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_black_logo')}}" class="color-black-light downloadable-tag">Nero su logo bianco</a>&nbsp&nbsp|&nbsp&nbsp <a href="{{url('frontend_downloadable_file/convey_white_logo')}}" class="color-black-light downloadable-tag">Bianco su logo nero</a></p>
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
                            <h5><br>Spaziatura</h5>
                            <span class="title-border-left"></span>
                            <p>Al fine di garantire che il nostro logo sia presentato correttamente, assicurarsi che vengano seguite le indicazioni di spaziatura qui mostrate. Questa spaziatura minima garantisce che il nostro logo non sia ostruito e aiuta a massimizzare l'immagine del logo.</p>
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
                            <h5><br><br>Uso inaccettabile.</h5>
                            <span class="title-border-left"></span>
                            <p>Il nostro branding è importante per noi e vorremmo assicurarci che non sia svalutato in alcun modo. Questi sono alcuni esempi di cosa non fare con il nostro logo. </p>
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
                            <h5><br><br>Colori.</h5>
                            <span class="title-border-left"></span>
                            <p>Il nostro logo è composto da due colori presentati su uno sfondo bianco; quando il logo è stampato a colori questi colori devono essere utilizzati senza eccezioni. </p>
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
