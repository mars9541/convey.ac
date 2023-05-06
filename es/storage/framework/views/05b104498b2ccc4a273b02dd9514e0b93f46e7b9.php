<!doctype html>
<html lang="en">
  <head>
    <title>Convey</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('front')); ?>/images/favicon.png"/>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('front')); ?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawsome -->
    <link href="<?php echo e(asset('front')); ?>/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate CSS-->
    <link href="<?php echo e(asset('front')); ?>/css/animate.css" rel="stylesheet">
    <!-- menu CSS-->
    <link href="<?php echo e(asset('front')); ?>/css/bootstrap-4-navbar.css" rel="stylesheet">
    <!-- Portfolio Gallery -->
    <link href="<?php echo e(asset('front')); ?>/css/filterizer.css" rel="stylesheet">
    <!-- Lightbox Gallery -->
    <link href="<?php echo e(asset('front')); ?>/inc/lightbox/css/jquery.fancybox.css" rel="stylesheet">
    <!-- OWL Carousel -->
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/css/owl.theme.default.min.css">
    <!-- Preloader CSS-->
    <link href="<?php echo e(asset('front')); ?>/css/fakeLoader.css" rel="stylesheet">
    <!-- Main CSS -->
    <link href="<?php echo e(asset('front')); ?>/style.css" rel="stylesheet">
    <!-- Default CSS Color -->
    <link href="<?php echo e(asset('front')); ?>/color/default.css" rel="stylesheet">
     <!-- Color CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/color/color-switcher.css">
    <!-- Default CSS Color -->
    <link href="<?php echo e(asset('front')); ?>/color/default.css" rel="stylesheet">
     <!-- Color CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('front')); ?>/color/color-switcher.css">
    <!-- Responsive CSS -->
    <link href="<?php echo e(asset('front')); ?>/css/responsive.css" rel="stylesheet">
    <link href="<?php echo e(asset('plugins')); ?>/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('plugins')); ?>/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets')); ?>/scss/_form-advanced.scss" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/convey.css')); ?>" rel="stylesheet" type="text/css">


<style>
    .test-font-16 {
        font-size: 16px;
    }
    .hidden {
        display: none;
    }
</style>



 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo e(asset('front')); ?>/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(asset('front')); ?>/js/bootstrap.min.js"></script>

    <!-- Wow Script -->
    <script src="<?php echo e(asset('front')); ?>/js/wow.min.js"></script>
    <!-- Counter Script -->
    <script src="<?php echo e(asset('front')); ?>/js/waypoints.min.js"></script>
    <script src="<?php echo e(asset('front')); ?>/js/jquery.counterup.min.js"></script>
    <!-- Masonry Portfolio Script -->
    <script src="<?php echo e(asset('front')); ?>/js/jquery.filterizr.min.js"></script>
    <script src="<?php echo e(asset('front')); ?>/js/filterizer-controls.js"></script>
    <!-- OWL Carousel js-->
    <script src="<?php echo e(asset('front')); ?>/js/owl.carousel.min.js"></script>
    <!-- Lightbox js -->
    <script src="<?php echo e(asset('front')); ?>/inc/lightbox/js/jquery.fancybox.pack.js"></script>
    <script src="<?php echo e(asset('front')); ?>/inc/lightbox/js/lightbox.js"></script>
    <!-- Google map js -->
    <!-- <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk&callback=initMap"></script>    -->
    <!-- <script src="<?php echo e(asset('front')); ?>/js/map.js"></script> -->
    <!-- loader js-->
    <script src="<?php echo e(asset('front')); ?>/js/fakeLoader.min.js"></script>
    <!-- Scroll bottom to top -->
    <script src="<?php echo e(asset('front')); ?>/js/scrolltopcontrol.js"></script>
    <!-- menu -->
    <script src="<?php echo e(asset('front')); ?>/js/bootstrap-4-navbar.js"></script>
    <!-- Stiky menu -->
    <script src="<?php echo e(asset('front')); ?>/js/jquery.sticky.js"></script>
    <!-- youtube popup video -->
    <script src="<?php echo e(asset('front')); ?>/js/jquery.magnific-popup.min.js"></script>
    <!-- Color switcher js -->
    <!-- <script src="<?php echo e(asset('front')); ?>/js/color-switcher.js"></script>  -->
    <!-- Color-switcher-active -->
    <!-- <script src="<?php echo e(asset('front')); ?>/js/color-switcher-active.js"></script>       -->
    <!-- Custom script -->
    <script src="<?php echo e(asset('front')); ?>/js/custom.js"></script>
    <script src="<?php echo e(asset('plugins/parsleyjs/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins')); ?>/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(asset('plugins')); ?>/select2/js/select2.min.js"></script>
  </head>
  <body>

   <!-- Preloader -->
    <div id="fakeloader"></div>
<section class="login">
        <div class="container login-container">
            <div class="loginPage loginForm">
                <div class="logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
                </div>
                <form action="<?php echo e(route('branch_login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                <div class="loginDetail" >
                    <div class="loginDetail-inner" style="max-width: 440px;margin: 0 auto;">
                        <h2>Sign In</h2>
                        <?php if(Session::has('error')): ?>
                        <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong> <?php echo e(session('error')); ?></strong>
                        </div>
                        <?php endif; ?>

                        <?php if(session('captch_error')): ?>
                            <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo e(session('captch_error')); ?>

                            </div>
                        <?php endif; ?>

                        <input type="text" class="form-control" name="ID_code" placeholder="Branch ID" required value="<?php echo e(old('ID_code')); ?>" autocomplete="off">
						<input type="password" name="password" class="form-control" placeholder="Enter Your Password" autocomplete="off">
                        <img id="captcha" src="<?php echo e(url('vendor')); ?>/securimage/securimage_show.php" alt="CAPTCHA Image" />
                        <input type="text" name="captcha_code" size="28" maxlength="6" required placeholder="Solve and enter the above sum" style="padding-inline:5px;" autocomplete="off"/>
                        <a href="#" onclick="document.getElementById('captcha').src = '<?php echo e(url('vendor')); ?>/securimage/securimage_show.php?' + Math.random(); return false" class="text-convey-green" >Change Image</a>
                    </div>
                </div>
                <div class="loginBottom" style="width: 440px;margin: 0 auto;">
					<button  class="btn btn-primary submitBtn">Sign In</button>

                </div>
                </form>
            </div>
        </div>
    </section>
  </body>
</html>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/front/branch/login.blade.php ENDPATH**/ ?>