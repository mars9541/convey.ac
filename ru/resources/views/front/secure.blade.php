@extends('layouts.frontend-master')
@section('content')
    <div class="padding-top-large"></div>

    <div class="bussiness-component-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Защита данных</h2>
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
                    <p>Все передаваемые записи надежно сохраняются в базе данных CONVEY DATABANK. Это централизованный ресурс, расположенный на платформе CONVEY. Платформа CONVEY была построена по принципу защиты персональных данных на этапе проектирования системы их обработки и по умолчанию, что означает, что безопасность и конфиденциальность данных являются основным элементом системы, вокруг которого строится все остальное. Этот принцип изложен в статье 25 GDPR и охватывает все, начиная от поступления данных на платформу в зашифрованном виде (безопасность транспортного уровня, TLS), благодаря чему данные невозможно прочитать во время передачи, до записи и шифрования полей и даже удаления записей при успешном запросе.</p>
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
                            <h5>БЕЗОПАСНОЕ хранение данных</h5>
                            <span class="title-border-left"></span>
                            <p>Платформа CONVEY размещена в надежно защищенных центрах обработки данных, сертифицированных по стандарту ISO27001:2013, и оснащенных системой круглосуточного видеонаблюдения с помощью Photo ID и входа по специальным картам. Чтобы обеспечить максимальное время безотказной работы платформы CONVEY, организовано энергообеспечения оборудования с помощью резервных ресурсов и источников бесперебойного питания.<br>
                                <br>Наша инфраструктура также включает систему защиты от DDoS (распределённая атака типа "отказ в обслуживании") со скоростью 1 Тб/с. DDOS-атаки могут вывести из строя многие серверы, однако благодаря наличию этой системы платформа CONVEY в случае атаки сможет обеспечить бесперебойную обработку данных.</p>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/ru/sec.png" alt="sample image">
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
                                    <h5 class="mt-0">Безопасность электронной почты.<br><br> Для обеспечения безопасности наших систем все электронные письма, отправляемые на платформу CONVEY и с нее, проходят современную трехуровневую проверку, защищающую от вирусов и спама.<br><br></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/world-map.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">Вредоносные атаки.<br><br> Наш брандмауэр веб-приложений выполняет миллисекундную проверку каждого HTTP-запроса на предмет внедрений SQL-кодов, троянов, межсайтовых сценариев, обхода пути и многих других типов атак.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-features">
                            <div class="media">
                                <img class="mr-3" src="{{asset('landing_front')}}/images/icon/money.png" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0">РЕЗЕРВНЫЕ КОПИИ.<br><br> Платформа CONVEY осуществляет автоматическое резервное копирование в определенные моменты в течение дня. Эти резервные копии обеспечивают возможность полного восстановления наших систем в случае необходимости.<br></h5>
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
