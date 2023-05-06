<style>
    @media (min-width: 992px) {
        .business-main-menu .navbar-nav .nav-link {
            padding-right: 10px;
            padding-left: 5px;
        }

        .lgin-sgn-item:before {
            content: '';
            border-left: 1px solid #212127;
            height: 16px;
            position: absolute;
            top: 18px;
            left: -3px;
        }
    }
</style>

<div class="bussiness-main-menu-1x">
    <div class="container">
        <input type="hidden" value="{{asset('landing_front')}}/images/country/" id="asset_url" />
        <input type="hidden" value="{{url('/')}}" id="route_url" />
        <div class="row">
            <div class="col-md-12">
                <div class="business-main-menu">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light btco-hover-menu">
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{asset('landing_front')}}/images/logo-dark.png" class="d-inline-block align-top" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto business-nav left-nav hidden-lg hidden-md hidden-sm hidden-xs" style="margin-right: 25px!important;">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/')}}">Обзор</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/benefits')}}">Преимущества</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/price')}}">Стоимость</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/secure')}}">Безопасность</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/upgrade')}}">Обновить</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/more')}}">ЕЩЕ</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ml-auto right-nav business-nav">
                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/')}}">Обзор</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/benefits')}}">Преимущества</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/price')}}">Стоимость</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/secure')}}">Безопасность</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/upgrade')}}">Обновить</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/more')}}">ЕЩЕ</a>
                                </li>

                                <li class="nav-item hidden-md hidden-sm hidden-xs">
                                    <a class="nav-link d-inline-flex align-items-center" href="javascript:void(0)" >
                                        <input type="hidden" value="ru" id="login_url" />
                                        <img id="img_country" src="{{asset('landing_front')}}/images/country/russia.png" style="width: 20px; height: 20px;" alt="Russia">
                                        <span class="ml-1">Страна</span>
                                    </a>

                                    <ul class="cntry">
                                        <span class="title">Выберите свою страну</span>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('england', 'gb')">
                                                <img src="{{asset('landing_front')}}/images/country/england.png" width="30px" alt="CK">
                                                <span class="cnt-spn">CK</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('usa', 'us')">
                                                <img src="{{asset('landing_front')}}/images/country/usa.png" width="30px" alt="США">
                                                <span class="cnt-spn">США</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('ireland', 'ie')">
                                                <img src="{{asset('landing_front')}}/images/country/ireland.png" width="30px" alt="Ирландия">
                                                <span class="cnt-spn">Ирландия</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('canada', 'ca')">
                                                <img src="{{asset('landing_front')}}/images/country/canada.png" width="30px" alt="Канада">
                                                <span class="cnt-spn">Канада</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('australia', 'au')">
                                                <img src="{{asset('landing_front')}}/images/country/australia.png" width="30px" alt="Австралия">
                                                <span class="cnt-spn">Австралия</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('france', 'fr')">
                                                <img src="{{asset('landing_front')}}/images/country/france.png" width="30px" alt="Франция">
                                                <span class="cnt-spn">Франция</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('germany', 'de')">
                                                <img src="{{asset('landing_front')}}/images/country/germany.png" width="30px" alt="Германия">
                                                <span class="cnt-spn">Германия</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('spain', 'es')">
                                                <img src="{{asset('landing_front')}}/images/country/spain.png" width="30px" alt="Испания">
                                                <span class="cnt-spn">Испания</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('russia', 'ru')">
                                                <img src="{{asset('landing_front')}}/images/country/russia.png" width="30px" alt="Россия">
                                                <span class="cnt-spn">Россия</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('italy', 'it')">
                                                <img src="{{asset('landing_front')}}/images/country/italy.png" width="30px" alt="Италия">
                                                <span class="cnt-spn">Италия</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('japan', 'jp')">
                                                <img src="{{asset('landing_front')}}/images/country/japan.png" width="30px" alt="Япония">
                                                <span class="cnt-spn">Япония</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item hidden-xl hidden-lg">
                                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#countryModal">Страна</a>
                                </li>

                                <li class="nav-item lgin-sgn-item">
                                    <a class="nav-link" id="a_login" href="{{route('login')}}">Войти</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="a_signup" href="{{route('register')}}" style="padding-right: 0px; padding-left: 0px;">
                                        <span class="highlight px-3" style="font-size: 15px; padding-right: 5px!important; padding-left: 5px!important;">
                                            ОБНОВИТЬ СЕЙЧАС
                                        </span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
