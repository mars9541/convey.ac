@extends('layouts.frontend-master')
@section('content')
<div class="business-main-slider">
    <div class="owl-carousel main-slider">
        <div class="item">
            <div class="hvrbox">
                <img src="{{asset('landing_front')}}/images/icon/shape.svg" alt="" class="hvrbox-layer_bottom">
                <div class="hvrbox-layer_top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="overlay-text text-center">
                                    <h3 data-animation-in="slideInDown" data-animation-out="animate-out slideOutUp">Повышайте вовлеченность сотрудников</h3>
                                    <h3 data-animation-in="slideInDown" data-animation-out="animate-out slideOutUp">с помощью передаваемых записей</h3>
                                    <a href="{{route('register')}}">
                                        <span class="highlight">ОБНОВИТЬ СЕЙЧАС</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="shape-sc">
                                    <p data-animation-in="slideInDown" data-animation-out="animate-out fadeOut">
                                    <div class="row">
                                        <div class="col-md-12 no-padding">
                                            <div class="single-features">
                                                <div class="media">
                                                    <img src="{{asset('landing_front')}}/images/icon/checked.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">Улучшайте продуктивность</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding">
                                            <div class="single-features">
                                                <div class="media">
                                                    <img src="{{asset('landing_front')}}/images/icon/checked.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">Повышайте пунктуальность</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding">
                                            <div class="single-features">
                                                <div class="media">
                                                    <img src="{{asset('landing_front')}}/images/icon/checked.png" alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">Находите новых кандидатов еще эффективнее, чем раньше</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="business-feature-1x business-feature-onslider">
        <div class="">
            <div class="business-features">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                            <div class="single-features">
                                <div class="media">
                                    <!-- <img src="images/icon/checked.png" alt="Generic placeholder image"> -->
                                    <div class="media-body">
                                        <h5 class="mt-0 text-center"><i><strong>Извлекайте</strong> максимум пользы из своих записей, сделав их доступными для <strong>передачи</strong></i></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4 no-padding">
                            <div class="single-features active">
                                <div class="media">
                                  <img src="images/icon/checked.png" alt="Generic placeholder image">
                                  <div class="media-body">
                                    <h5 class="mt-0">Improve Punctuality and Attendance<br></h5>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 no-padding">
                            <div class="single-features">
                                <div class="media">
                                  <img src="images/icon/checked.png" alt="Generic placeholder image">
                                  <div class="media-body">
                                    <h5 class="mt-0">Screen New Employees More Effectively</h5>
                                  </div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row" style="align-items: flex-end;">
                    <div class="col-md-8">
                        <div class="about-business-left-2x">
                            <h5 style="font-size: 40px;">Квантовый скачок вперед</h5>
                            <span class="title-border-left"></span>
                            <p>Передаваемые записи о трудоустройстве – это цифровые файлы, которые CONVEY передает от одного работодателя к другому, помогая сотруднику сохранить историю его трудовых достижений даже при смене места работы.<br><br>Компании, которые применяют этот перспективный подход, легче привлекают новых сотрудников, так как представляют для них дополнительную ценность. Данное нововведение также способствует повышению уровня продуктивности, пунктуальности и снижению количества «ненастоящих» больничных дней.<br><br>
                                В отличие от сети linkedin, которая в большей степени сориентирована на профессионалов, передаваемые записи о трудоустройстве используются для привлечения сотрудников, работающих на базовых уровнях бизнеса – то есть в той области, в которой задействована большая часть рабочей силы.
                        </div>
                    </div>

                    <div class="col-md-4 pb-lg-4">
                        <div class="about-business-right-2x">
                            <img class="img-responsive" src="{{asset('landing_front')}}/images/ru/1.jpeg" alt="sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="padding-top-large"></div>

    <div class="business-cta-1x">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cta-content">
                        <h3>CONVEY помогает Русский бизнесу ставить сотрудников на первое место</h3>
                        <h2>Новый уровень вовлеченности</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="business-service-3x">
        <div class="container">
            <div class="business-service-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="business-title-middle">
                            <h2>Повышение производительности</h2>
                            <span class="title-border-middle"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bussiness-highlight-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Как работодатель вы можете помочь своим сотрудникам добиться успеха в будущем, независимо от того, будет ли этот успех связан с вашей компанией или с другим работодателем. Долгосрочный подход показывает сотрудникам, что ваш интерес к ним выходит за рамки потребностей бизнеса. Это повышает вовлеченность сотрудников и ничего вам не стоит. <br><br>Вы сами выбираете, какие типы записей сделать передаваемыми. Одни компании используют только итоговую оценку работы сотрудника, заменяя этим привычные рекомендации, другие также отправляют обзор эффективности, а некоторые передают весь объем данных, включая:</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 service-center">
        <div class="row">
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-1.png" alt="Generic placeholder image">
                    <a href="#">Обзор эффективности</a>
                    <p>Периодические комментарии<br> и мнения<br> от руководителей</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-2.png" alt="Generic placeholder image">
                    <a href="#">Сертификаты сотрудника</a>
                    <p>Сертификаты и <br> свидетельства о повышении квалификации <br> общепризнанные</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-4.png" alt="Generic placeholder image">
                    <a href="#">Оценка итогов трудоустройства</a>
                    <p>Подведение итогов<br>работы сотрудника<br> после его ухода из компании</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-3.png" alt="Generic placeholder image">
                    <a href="#">Награды сотрудника</a>
                    <p>Внутренние награды<br>признание достижений<br>и вклада в общее дело</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-5.png" alt="Generic placeholder image">
                    <a href="#">Отчеты об использовании больничных</a>
                    <p>Сравнение количества дней, <br>проведенных на больничном и <br> на рабочем месте</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-center text-center">
                    <img src="{{asset('landing_front')}}/images/icon/icon-6.png" alt="Generic placeholder image">
                    <a href="#">Отчеты о посещаемости и пунктуальности</a>
                    <p>Анализ особенностей поведения,<br>эпизодических <br> или постоянных</p>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="padding-top-large"></div>

<div class="business-cta-1x">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cta-content">
                    <h3>Решения для крупных и мелких работодателей</h3>
                    <h2>100% соответствие GDPR</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>
<div class="padding-top-large"></div>
<div class="about-business-2x">
    <div class="container">
        <div class="about-business-content-2x">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-business-left-2x">
                        <h5 style="font-size: 40px;">Привлекайте тех, кто вам нужен... </h5>
                        <span class="title-border-left"></span>
                        <p>Используя передаваемые записи о трудоустройстве, вы сможете привлекать и удерживать продуктивных сотрудников, способных быстро адаптироваться к новой деловой культуре.<br><br> Такие люди понимают, что наличие системы передаваемых записей поможет им, если обстоятельства изменятся, и им придется искать другую работу. Они осознают, что благодаря данной системе все их успехи и достижения будут отражены в удобном файле, который пригодится им на новом месте.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/ru/fas2.png" alt="sample image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>
<div class="padding-top-large"></div>
<div class="business-app-present-1x">
    <div class="app-present-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="app-present-left">
                        <img src="{{asset('landing_front')}}/images/introduct-design2.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>Отбор кандидатов</h3>
                        <h2>ПОЛУЧАЙТЕ ИНФОРМАЦИЮ<br>...ЕЩЕ БЫСТРЕЕ!</h2>
                        <p>Резюме и собеседования редко дают достаточно информации, чтобы принять полностью обоснованное решение о трудоустройстве нового сотрудника.<br><br>Используя передаваемые записи о трудоустройстве, вы сможете быстро получить доступ к соответствующему файлу о соискателе с предыдущего места работы, что даст вам более глубокое представление об особенностях занятости соискателя. Кроме того, вам больше не придется запрашивать справки, которые как правило приходят с опозданием и содержат мало действительно ценной информации.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="padding-top-middle"></div>

<div class="padding-top-large"></div>

<div class="about-business-2x">
    <div class="container">
        <div class="about-business-content-2x">
            <div class="row">
                <div class="col-md-8">
                    <div class="about-business-left-2x">
                        <h5 style="font-size: 40px;">Время ... деньги</h5>
                        <span class="title-border-left"></span>
                        <p>Работодателям регулярно приходится писать рекомендации об уволившихся сотрудниках, когда другие компании рассматривают их в качестве кандидатов на свои вакансии. После того, как вы перейдете на переносимые записи о трудоустройстве, это прекратится, потому что рекрутеры будут получать всю необходимую им информацию из ранее созданных вами файлов.<br><br>Помимо экономии времени и денег, использование таких записей поможет сохранить хорошие отношения с бывшими сотрудниками, т.к. им больше не придется ждать рекомендаций от вас.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about-business-right-2x">
                        <img class="img-responsive" src="{{asset('landing_front')}}/images/fas1.png" alt="sample image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="padding-top-large"></div>

<div class="business-app-present-1x">
    <div class="app-present-content">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="app-present-left">
                        <img src="{{asset('landing_front')}}/images/introduct-design3.png" alt="Mountains" class="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="app-present-right">
                        <h3>Успех бизнеса</h3>
                        <h2>ЭТО УСПЕХ ЕГО СОТРУДНИКОВ</h2>
                        <p>Переход на систему передаваемых записей повышает важность компании в глазах сотрудников, что, в свою очередь, приводит к повышению эффективности.<br><br> По мере увеличения количества предприятий, использующих файлы CONVEY при отборе кандидатов на работу, сотрудники оценят важность создания подобных записей и с благодарностью воспользуются предоставленной вами возможностью. <br><br> CONVEY ... все в выигрыше.<br></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<div class="padding-top-large"></div>







@endsection
