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
                            <ul class="navbar-nav ml-auto business-nav left-nav hidden-lg hidden-md hidden-sm hidden-xs">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/')}}">概要</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/benefits')}}">利点</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/price')}}">料金</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/secure')}}">セキュリティ</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/upgrade')}}">アップグレード</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/more')}}">詳細</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ml-auto right-nav business-nav">
                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/')}}">概要</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/benefits')}}">利点</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/price')}}">料金</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/secure')}}">セキュリティ</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/upgrade')}}">アップグレード</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/more')}}">詳細</a>
                                </li>

                                <li class="nav-item hidden-md hidden-sm hidden-xs">
                                    <a class="nav-link d-inline-flex align-items-center" href="javascript:void(0)" >
                                        <input type="hidden" value="jp" id="login_url" />
                                        <img id="img_country" src="{{asset('landing_front')}}/images/country/japan.png" style="width: 20px; height: 20px;" alt="Japan">
                                        <span class="ml-1">国選択</span>
                                    </a>

                                    <ul class="cntry">
                                        <span class="title">国を選択してください</span>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('england', 'gb')">
                                                <img src="{{asset('landing_front')}}/images/country/england.png" width="30px" alt="イギリス">
                                                <span class="cnt-spn">イギリス</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('usa', 'us')">
                                                <img src="{{asset('landing_front')}}/images/country/usa.png" width="30px" alt="アメリカ">
                                                <span class="cnt-spn">アメリカ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('ireland', 'ie')" style="padding-right: 0px;">
                                                <img src="{{asset('landing_front')}}/images/country/ireland.png" width="30px" alt="アイルランド">
                                                <span class="cnt-spn">アイルランド</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('canada', 'ca')">
                                                <img src="{{asset('landing_front')}}/images/country/canada.png" width="30px" alt="カナダ">
                                                <span class="cnt-spn">カナダ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('australia', 'au')" style="padding-right: 0px;padding-left: 10px;">
                                                <img src="{{asset('landing_front')}}/images/country/australia.png" width="30px" alt="オーストラリア">
                                                <span class="cnt-spn">オーストラリア</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('france', 'fr')">
                                                <img src="{{asset('landing_front')}}/images/country/france.png" width="30px" alt="フランス">
                                                <span class="cnt-spn">フランス</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('germany', 'de')">
                                                <img src="{{asset('landing_front')}}/images/country/germany.png" width="30px" alt="ドイツ">
                                                <span class="cnt-spn">ドイツ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('spain', 'es')">
                                                <img src="{{asset('landing_front')}}/images/country/spain.png" width="30px" alt="スペイン">
                                                <span class="cnt-spn">スペイン</span>
                                            </a>
                                        </li>
                                        {{--<li>
                                            <a class="country-class" onclick="onSelectCountry('russia', 'ru')">
                                                <img src="{{asset('landing_front')}}/images/country/russia.png" width="30px" alt="ロシア">
                                                <span class="cnt-spn">ロシア</span>
                                            </a>
                                        </li>--}}
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('italy', 'it')">
                                                <img src="{{asset('landing_front')}}/images/country/italy.png" width="30px" alt="イタリア">
                                                <span class="cnt-spn">イタリア</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('japan', 'jp')">
                                                <img src="{{asset('landing_front')}}/images/country/japan.png" width="30px" alt="日本">
                                                <span class="cnt-spn">日本</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item hidden-xl hidden-lg">
                                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#countryModal">国選択</a>
                                </li>

                                <li class="nav-item lgin-sgn-item">
                                    <a class="nav-link" id="a_login" href="{{route('login')}}">ログイン</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="a_signup" href="{{route('register')}}"><span class="highlight px-3">今すぐアップグレード</span></a>
                                </li>

                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
