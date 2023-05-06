<!-- Start Footer 2x -->
<footer class="business-footer-2x">
    <div class="business-footer-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="business-footer-address-left">
                        <a href="{{url('/')}}"><img src="{{asset('landing_front')}}/images/logo-dark.png" alt="Logo"></a><br>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="business-footer-address-left">
                        <ul>
                            <li><a href="{{url('/brand')}}">Руководство по бренду</a></li>
                            <li><a href="{{url('/getintouch')}}"> Контакты</a></li>
                            <li><a href="javascript:onOpenModal('cookies')"> Cookies</a></li>
                            <li><a href="javascript:onOpenModal('privacy')"> Конфиденциальность</a></li>
                            <li><a href="javascript:onOpenModal('legal')"> Правовые аспекты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div class="business-footer-address-left">
                        <ul style="margin: 40px 0 5px 0;">
                            <li class="float-none">
                                <a onclick="onCountrySite('gb')">
                                    <img src="{{asset('landing_front')}}/images/country/england.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="CK">
                                    <span>CK</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('us')">
                                    <img src="{{asset('landing_front')}}/images/country/usa.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="США">
                                    <span>США</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('ca')">
                                    <img src="{{asset('landing_front')}}/images/country/canada.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Канада">
                                    <span>Канада</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('ie')">
                                    <img src="{{asset('landing_front')}}/images/country/ireland.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Ирландия">
                                    <span>Ирландия</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('au')">
                                    <img src="{{asset('landing_front')}}/images/country/australia.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Австралия">
                                    <span>Австралия</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('es')">
                                    <img src="{{asset('landing_front')}}/images/country/spain.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Испания">
                                    <span>Испания</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('de')">
                                    <img src="{{asset('landing_front')}}/images/country/germany.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Германия">
                                    <span>Германия</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('fr')">
                                    <img src="{{asset('landing_front')}}/images/country/france.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Франция">
                                    <span>Франция</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('it')">
                                    <img src="{{asset('landing_front')}}/images/country/italy.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Италия">
                                    <span>Италия</span>
                                </a>
                            </li>
                            <li class="float-none">
                                <a onclick="onCountrySite('jp')">
                                    <img src="{{asset('landing_front')}}/images/country/japan.png" style="width: 20px; height: 20px; margin-bottom: 5px;" alt="Япония">
                                    <span>Япония</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="container footer-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="footer-info-left">
                                    <p>
                                        @2020 CONVEY Databank Ltd<br> 85 Great Portland Street, First Floor, London, W1W7LT <br>
                                        CRN:  13704164 &nbsp;&nbsp;&nbsp;VAT: 393 5125 86 &nbsp;&nbsp;&nbsp;ICO:00018153053
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="footer-info-right">
                                    {{--<ul>
                                        <li><a href="https://www.facebook.com/conveyDATA"> <i class="fa fa-facebook"></i> </a></li>
                                        <li><a href="https://twitter.com/conveyDATA"> <i class="fa fa-twitter"></i> </a></li>
                                        <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>

                                    </ul>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</footer>

<!-- End Footer -->

<!-- Modal  -->
<div id="countryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <ul class="cntry">
                    <span class="title">Select your country</span>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/england.png" width="30px" alt="England">
                            <span class="cnt-spn">UK</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/usa.png" width="30px" alt="USA">
                            <span class="cnt-spn">USA</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/ireland.png" width="30px" alt="ireland">
                            <span class="cnt-spn">Ireland</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/canada.png" width="30px" alt="Canada">
                            <span class="cnt-spn">Canada</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/australia.png" width="30px" alt="australia">
                            <span class="cnt-spn">Australia</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/france.png" width="30px" alt="france">
                            <span class="cnt-spn">France</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/germany.png" width="30px" alt="germany">
                            <span class="cnt-spn">Germany</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="{{asset('landing_front')}}/images/country/spain.png" width="30px" alt="Spain">
                            <span class="cnt-spn">Spain</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="cookies_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title">CONVEY Cookie Policy</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body" style="padding: 1.75rem!important;">
                <div class="form-group" id="article_detail">
                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        Introduction
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        This Cookie Policy is available in English only to prevent misunderstandings due to errors in translation.
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        This Cookie Policy ("Policy") describes how CONVEY and its partners (collectively referred to as “CONVEY,” “we,” “us,” or "our") collect and process information about you on the CONVEY website/platform through the use of cookies. We use the term "cookies" in this Policy to refer to website cookies and also to similar technologies that may collect information automatically when you visit the CONVEY Sites (such as pixel tags and web beacons).
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        What is a cookie?
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        A cookie is a small text file that a web server places on your computer or mobile device when you visit a website. This small text file may include a unique identifier that distinguishes your computer or mobile device from other devices. Cookies serve a number of purposes such as letting you navigate between webpages efficiently, remembering your preferences, and generally improving the user experience. Cookies may tell us, for example, whether you have visited the CONVEY Sites before or whether you are a new visitor. They can also help to ensure that content we display, advertisements you see online, and marketing messages are more relevant to you and your interests.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        How long do cookies last?
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        Cookies can remain on your computer or mobile device for different periods of time. Some cookies are “session cookies.” These exist only while your browser is open and are deleted automatically once you close your browser. Other cookies are “persistent cookies.” These cookies survive after your browser is closed until a defined expiration date. They can be used by websites to recognize your computer when you open your browser and browse the Internet again.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        What other technologies are used to track my website visits?
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        We and others may also use other technologies for tracking, such as pixel tags and web beacons. Web beacons and pixel tags are electronic images that may be used on CONVEY Sites or in our emails. We use web beacons, for example, to deliver cookies, to count visits, to understand usage of the CONVEY Sites and CONVEY’s services, to analyze the effectiveness of CONVEY Site features and campaigns, and to tell if an email has been opened and acted upon.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        What kind of cookies are served through the CONVEY Sites?
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        The following sets out some ways in which CONVEY uses cookies to track visitors to the CONVEY Sites.
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        Essential or required cookies:
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        Required cookies enable you to navigate the CONVEY Sites and use their features, such as accessing secure areas of the Sites and using CONVEY services. They also recognize your login credentials and provide form tracking so you don’t have to re-enter information.
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        Targeting or advertising cookies:
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        We and our third party partners may use information collected using cookies in our services
                        and in our emails to deliver ads about our services displayed to you on third-party websites
                        and applications. We also may use cookies to know when you return to our services after
                        visiting these third-party websites and applications. Our third-party partners may also use
                        this information for third-party advertising. These third parties may automatically collect
                        information about your use of our services, visits to the CONVEY Sites and other websites,
                        your IP address, your internet service provider, and the browser you use to visit the CONVEY Sites.

                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        Analytics cookies:
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        We use analytics, including analytics conducted by third party services, to help analyze how users use the CONVEY Sites and our services. To do this, we and our third party service providers use cookies and scripts to collect and store information such as how users interact with our services, errors users encounter when using our services, device identifiers, how often and for how long users visit and use the services, what pages they visit on our services, whether they act on or open emails, and what other sites they used prior to coming to the CONVEY Sites. We use this information to improve our site and your user experience, such as remembering you when you return to the CONVEY Sites, understanding your preferences and interests, and knowing which of our web pages are visited and what services are most often used.

                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        How to manage or delete cookies on CONVEY Sites
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        Many web browsers accept cookies by default. If you prefer, you can usually change your browser's settings to reject and/or to remove many cookies. On some browsers, you can choose to let the CONVEY Sites place cookies, but choose to reject cookies from certain third parties (such as analytics companies and advertising companies). As the precise means by which you may do this will vary from browser to browser, please visit your browser's help or settings menu for more information. Please note also that if you choose to reject or remove cookies, this may prevent certain features or services of CONVEY Sites from working properly. Since your cookie opt-out preferences are also stored in a cookie in your website browser, please also note that if you delete all cookies, use a different browser, or buy a new computer, you will need to renew your opt-out choices.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        E-mail tracking
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        CONVEY may also use e-mail tracking technologies to monitor the success of e-mail campaigns it operates (for example, recording how many e-mails in a campaign were opened). If you do not want us to track emails we send you, some email services let you change your display to turn off HTML or disable download of images and exercising these rights should effectively disable our email tracking. In addition, you may also unsubscribe from our marketing emails as described in those emails.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        Do Not Track
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        Some Internet browsers include the ability to transmit “Do Not Track” signals. Since uniform standards for “Do Not Track” signals have not been adopted, the CONVEY Sites do not currently process or respond to “Do Not Track” signals. To learn more about “Do Not Track”, please visit “All About Do Not Track" (<a href="http://www.allaboutdnt.com/" target="_blank" style="color: #f5620ce0">http://www.allaboutdnt.com/</a>). In addition to “Do Not Track”, there are many ways that web browser signals and similar mechanisms can indicate your tracking choices, and we may not be aware of nor honour every mechanism.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        Modifications
                    </p>
                    <p style="margin-bottom: 1rem!important; line-height: 25px!important;">
                        This Policy was last updated on April,22, 2021.
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        We may amend this Policy at any time by posting the amended version on the CONVEY Sites or by providing such notice about or obtaining consent to changes as may be required by applicable law. By continuing to use the CONVEY Sites, you confirm your continued acceptance of this Policy and any associated changes.
                    </p>

                    <p style="margin-bottom: 1rem!important; font-weight: bold;">
                        Contact Information
                    </p>
                    <p style="margin-bottom: 2rem!important; line-height: 25px!important;">
                        If you have any questions regarding this Policy, please email CONVEY using the site form.
                    </p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-lg" id="privacy_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title">Политика конфиденциальности</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body" style="padding: 1.75rem!important;">
                <div class="form-group" id="article_detail">
                    <p style="margin-bottom: 1rem!important;">Название компании: CONVEY Databank Ltd <br>
                        Адрес компании:  85 Great Portland Street, первый этаж, Лондон, W1W7LT
                    </p>
                    <p style="margin-bottom: 1rem!important;">
                        В CONVEY мы заботимся о вашей конфиденциальности.
                    </p>
                    <p style="margin-bottom: 0.5rem!important; line-height: 25px!important;">
                        Именно поэтому мы собираем ваши личные данные только в том случае, если у нас есть на то веские причины, и именно поэтому мы хотим прозрачно сообщать, что мы делаем с вашими личными данными. Политика конфиденциальности немного отличается в зависимости от того, как вы используете CONVEY, например, частное лицо, использующее CONVEY для поиска записей о себе, будет иметь немного другую политику, чем компания, использующая CONVEY для создания записей.
                    </p>
                    <p style="margin-bottom: 0.5rem!important; line-height: 25px!important;">
                        Полные и соответствующие условия использования доступны для просмотра в процессе создания учетной записи.
                    </p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-lg" id="legal_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title">Правовые аспекты</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body" style="padding: 2rem!important;">
                <div class="form-group" id="article_detail">
                    <p style="margin-bottom: 0.7rem!important;">Название компании: CONVEY Databank Ltd </p>
                    <p style="margin-bottom: 0.7rem!important;">Адрес компании:  85 Great Portland Street, First Floor, London, W1W7LT </p>
                    <p style="margin-bottom: 0.5rem!important; line-height: 25px!important;">
                        Сайт CONVEY.ac, доступный по следующему URL: https://www.convey.ac, является собственностью CONVEY Databank Ltd, частной компании с ограниченной ответственностью, зарегистрированной в Великобритании, имеющей зарегистрированный офис по адресу: 85 Great Portland Street, First Floor, London, W1W7LT.
                    </p>
                    <p style="margin-bottom: 0.5rem!important; line-height: 25px!important;">
                        Сайт был разработан и поддерживается CONVEY Databank Ltd, с географическим размещением в Великобритании, ЕС и США.
                    </p>
                    <p style="margin-bottom: 0.5rem!important; line-height: 25px!important;">
                        Полные условия использования доступны для просмотра в процессе создания учетной записи.
                    </p>
                    <p style="line-height: 25px!important;">
                        Для поддержки/жалоб: Пожалуйста, используйте контактную форму на сайте.
                    </p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
