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
        <input type="hidden" value="<?php echo e(asset('landing_front')); ?>/images/country/" id="asset_url" />
        <input type="hidden" value="<?php echo e(url('/')); ?>" id="route_url" />
        <div class="row">
            <div class="col-md-12">
                <div class="business-main-menu">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light btco-hover-menu">
                        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                            <img src="<?php echo e(asset('landing_front')); ?>/images/logo-dark.png" class="d-inline-block align-top" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto business-nav left-nav hidden-lg hidden-md hidden-sm hidden-xs">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Übersicht</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/benefits')); ?>">Vorteile</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/price')); ?>">Preis</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/secure')); ?>">Sicherheit</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/upgrade')); ?>">Upgraden</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/more')); ?>">MEHR</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ml-auto right-nav business-nav">
                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Overview</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="<?php echo e(url('/benefits')); ?>">Benefits</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="<?php echo e(url('/price')); ?>">Price</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="<?php echo e(url('/secure')); ?>">Secure</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="<?php echo e(url('/upgrade')); ?>">Upgrade</a>
                                </li>

                                <li class="nav-item hidden-xl">
                                    <a class="nav-link" href="<?php echo e(url('/more')); ?>">MORE</a>
                                </li>

                                <li class="nav-item hidden-md hidden-sm hidden-xs">
                                    <a class="nav-link d-inline-flex align-items-center" href="javascript:void(0)" >
                                        <input type="hidden" value="de" id="login_url" />
                                        <img id="img_country" src="<?php echo e(asset('landing_front')); ?>/images/country/germany.png" style="width: 20px; height: 20px;" alt="Germany">
                                        <span class="ml-1">Land</span>
                                    </a>

                                    <ul class="cntry">
                                        <span class="title">Wählen Sie Ihr Land</span>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('england', 'gb')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/england.png" width="30px" alt="England">
                                                <span class="cnt-spn">UK</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('usa', 'us')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/usa.png" width="30px" alt="USA">
                                                <span class="cnt-spn">USA</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('ireland', 'ie')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/ireland.png" width="30px" alt="ireland">
                                                <span class="cnt-spn">Irland</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('canada', 'ca')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/canada.png" width="30px" alt="Canada">
                                                <span class="cnt-spn">Kanada</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('australia', 'au')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/australia.png" width="30px" alt="australia">
                                                <span class="cnt-spn">Australien</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('france', 'fr')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/france.png" width="30px" alt="france">
                                                <span class="cnt-spn">Frankreich</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('germany', 'de')" style="padding-right: 10px">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/germany.png" width="30px" alt="germany">
                                                <span class="cnt-spn">Deutschland</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('spain', 'es')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/spain.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Spanien</span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('italy', 'it')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/italy.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Italien</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('japan', 'jp')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/japan.png" width="30px" alt="Spain">
                                                <span class="cnt-spn">Japan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item hidden-xl hidden-lg">
                                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#countryModal">Land</a>
                                </li>

                                <li class="nav-item lgin-sgn-item">
                                    <a class="nav-link" id="a_login" href="<?php echo e(route('login')); ?>">Anmeldung</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" style="padding-right: 1px!important; padding-left: 0px!important;" id="a_signup" href="<?php echo e(route('register')); ?>">
                                        <span class="highlight px-3">JETZT UPGRADEN</span>
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
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/layouts/frontend-topbar.blade.php ENDPATH**/ ?>