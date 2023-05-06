
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
                            <ul class="navbar-nav ml-auto business-nav left-nav hidden-lg hidden-md hidden-sm hidden-xs mr-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Aperçu</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/benefits')); ?>">Avantages</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/price')); ?>">Prix</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/secure')); ?>">Sécurisé</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/upgrade')); ?>">Mise à niveau</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(url('/more')); ?>">PLUS</a>
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
                                        <input type="hidden" value="fr" id="login_url" />
                                        <img id="img_country" src="<?php echo e(asset('landing_front')); ?>/images/country/france.png" style="width: 20px; height: 20px;" alt="France">
                                        <span class="ml-1">Pays</span>
                                    </a>

                                    <ul class="cntry">
                                        <span class="title">Sélectionnez votre pays</span>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('england', 'gb')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/england.png" width="30px" alt="Royaume-Uni">
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
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/ireland.png" width="30px" alt="Irlande">
                                                <span class="cnt-spn">Irlande</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('canada', 'ca')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/canada.png" width="30px" alt="Canada">
                                                <span class="cnt-spn">Canada</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('australia', 'au')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/australia.png" width="30px" alt="Australie">
                                                <span class="cnt-spn">Australie</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('france', 'fr')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/france.png" width="30px" alt="France">
                                                <span class="cnt-spn">France</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('germany', 'de')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/germany.png" width="30px" alt="Allemagne">
                                                <span class="cnt-spn">Allemagne</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('spain', 'es')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/spain.png" width="30px" alt="Espagne">
                                                <span class="cnt-spn">Espagne</span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('italy', 'it')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/italy.png" width="30px" alt="Italie">
                                                <span class="cnt-spn">Italie</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="country-class" onclick="onSelectCountry('japan', 'jp')">
                                                <img src="<?php echo e(asset('landing_front')); ?>/images/country/japan.png" width="30px" alt="Japon">
                                                <span class="cnt-spn">Japon</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item hidden-xl hidden-lg">
                                    <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#countryModal">Pays</a>
                                </li>

                                <li class="nav-item lgin-sgn-item">
                                    <a class="nav-link" id="a_login" href="<?php echo e(route('login')); ?>">Connexion</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="a_signup" href="<?php echo e(route('register')); ?>">
                                        <span class="highlight px-3" style="font-size: 12px; padding-right: 4px!important;padding-left: 4px!important;">
                                            METTRE À NIVEAU MAINTENANT
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
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/fr/resources/views/layouts/frontend-topbar.blade.php ENDPATH**/ ?>