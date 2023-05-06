
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
                                    <a class="nav-link" href="{{url('/')}}">Overview</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/benefits')}}">Benefits</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/price')}}">Price</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/secure')}}">Secure</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/upgrade')}}">Upgrade</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/more')}}">MORE</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ml-auto right-nav business-nav">
                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/')}}">Overview</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/benefits')}}">Benefits</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/price')}}">Price</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/secure')}}">Secure</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/upgrade')}}">Upgrade</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="{{url('/more')}}">MORE</a>
                                </li>

                                <li class="nav-item hidden-md hidden-sm hidden-xs">
                                    <a class="nav-link d-inline-flex align-items-center" href="javascript:void(0)" >
                                        <input type="hidden" value="us" id="login_url" />
                                        <img id="img_country" src="{{asset('landing_front')}}/images/country/australia.png" style="width: 20px; height: 20px;" alt="Australia">
                                        <span class="ml-1">Country</span>
                                    </a>

                                    <ul class="cntry">
                                        <span class="title">Select your country</span>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('england', 'gb')">
                                                <img src="{{asset('landing_front')}}/images/country/england.png" width="30px" alt="England">
                                                <span class="cnt-spn">UK</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('usa', 'us')">
                                                <img src="{{asset('landing_front')}}/images/country/usa.png" width="30px" alt="USA">
                                                <span class="cnt-spn">USA</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('ireland', 'ie')">
                                                <img src="{{asset('landing_front')}}/images/country/ireland.png" width="30px" alt="ireland">
                                                <span class="cnt-spn">Ireland</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('canada', 'ca')">
                                                <img src="{{asset('landing_front')}}/images/country/canada.png" width="30px" alt="Canada">
                                                <span class="cnt-spn">Canada</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('australia', 'au')">
                                                <img src="{{asset('landing_front')}}/images/country/australia.png" width="30px" alt="australia">
                                                <span class="cnt-spn">Australia</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('france', 'fr')">
                                                <img src="{{asset('landing_front')}}/images/country/france.png" width="30px" alt="france">
                                                <span class="cnt-spn">France</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('germany', 'de')">
                                                <img src="{{asset('landing_front')}}/images/country/germany.png" width="30px" alt="germany">
                                                <span class="cnt-spn">Germany</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('spain', 'es')">
                                                <img src="{{asset('landing_front')}}/images/country/spain.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Spain</span>
                                            </a>
                                        </li>
                                        {{--<li>
                                            <a class="country-class" onclick="onSelectCountry('russia', 'ru')">
                                                <img src="{{asset('landing_front')}}/images/country/russia.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Russia</span>
                                            </a>
                                        </li>--}}
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('italy', 'it')">
                                                <img src="{{asset('landing_front')}}/images/country/italy.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Italy</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('japan', 'jp')">
                                                <img src="{{asset('landing_front')}}/images/country/japan.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Japan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item hidden-xl hidden-lg">
                                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#countryModal">Country</a>
                                </li>

                                <li class="nav-item lgin-sgn-item">
                                    <a class="nav-link" id="a_login" href="{{route('login')}}">Login</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="a_signup" href="{{route('register')}}"><span class="highlight px-3">UPGRADE NOW</span></a>
                                </li>

                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
