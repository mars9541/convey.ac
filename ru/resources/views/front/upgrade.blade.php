@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>3 способа выполнить обновление<h2>
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
                            <h5>1. С помощью модуля DIRECT CONNECT</h5>
                            <span class="title-border-left"></span>
                            <p> Самый простой способ начать использовать передаваемые записи о трудоустройстве – войти в свою учетную запись и использовать наш модуль DIRECT CONNECT для создания новых записей. Данный модуль – это основной инструмент, который уже используют для создания записей многие представители малого бизнеса (и компании, не имеющие существующей системы проверки сотрудников).<br><br> Модуль DIRECT CONNECT можно использовать БЕСПЛАТНО без ограничений по количеству добавляемых сотрудников или создаваемых записей, что делает его подходящим для большинства предприятий.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/ru/CONTROLPANEL.png" alt="sample image">
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
                            <h5>2. С помощью утвержденного провайдера</h5>
                            <span class="title-border-left"></span>
                            <p>Если вам нужны функции, отсутствующие в нашем модуле DIRECT CONNECT, вы можете создать учетную запись с помощью одного из наших утвержденных партнеров (если вы уже создаете записи через одного из наших утвержденных партнеров, они автоматически синхронизируются с CONVEY DATABANK).<br><br>Многие поставщики систем управления персоналом и аттестациями, включая HRIS, ATS и VMS, предвидели потребность в простом соединении с CONVEY и сейчас работают над этим. Если у вас уже есть учетная запись у одного из утвержденных поставщиков, вы можете получить мгновенный доступ к базе данных CONVEY DATABANK за пару кликов.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/ru/supplier.png" alt="sample image">
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
                            <h5>3. С помощью настраиваемого соединения API</h5>
                            <span class="title-border-left"></span>
                            <p>Крупные компании с индивидуальным программным обеспечением могут использовать CONVEY API для создания настраиваемого соединения. API был разработан для подключения к CONVEY DATABANK через стандартизованный программный интерфейс. CONVEY API – это RESTful API, основанный на HTTP-запросах и JSON-ответах. <br><br>Разработчики, знакомые с вашими существующими системами, смогут с легкостью выполнить этот процесс в течение 2-5 дней.<br><br>

                                Войдите в свою учетную запись, чтобы получить дополнительную информацию о том, как это сделать.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/ru/api2.png" alt="sample image">
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
                            <h2>Квантовый скачок вперед ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="{{route('register')}}" class=" btn bussiness-btn-larg">ОБНОВИТЬ СЕЙЧАС</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

@endsection
