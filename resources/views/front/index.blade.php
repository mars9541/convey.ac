<!doctype html>
<html lang="en">
  <head>
    <title>Convey</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  
    
	<!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('front')}}/images/favicon.png">
	
	<!-- Bootstrap -->
    <link href="{{asset('front')}}/css/bootstrap.min.css" rel="stylesheet">
	<!-- Fontawsome -->
    <link href="{{asset('front')}}/css/font-awesome.min.css" rel="stylesheet">
    <!-- Animate CSS-->
    <link href="{{asset('front')}}/css/animate.css" rel="stylesheet">
    <!-- menu CSS-->
    <link href="{{asset('front')}}/css/bootstrap-4-navbar.css" rel="stylesheet">	
	<!-- Portfolio Gallery -->
    <link href="{{asset('front')}}/css/filterizer.css" rel="stylesheet">
	<!-- Lightbox Gallery -->
    <link href="{{asset('front')}}/inc/lightbox/css/jquery.fancybox.css" rel="stylesheet">
	<!-- OWL Carousel -->
	<link rel="stylesheet" href="{{asset('front')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{asset('front')}}/css/owl.theme.default.min.css">
    <!-- Preloader CSS-->
    <link href="{{asset('front')}}/css/fakeLoader.css" rel="stylesheet">
	<!-- Main CSS -->
    <link href="{{asset('front')}}/style.css" rel="stylesheet">
    <!-- Default CSS Color --> 
    <link href="{{asset('front')}}/color/default.css" rel="stylesheet">
     <!-- Color CSS --> 
    <link rel="stylesheet" href="{{asset('front')}}/color/color-switcher.css">
    <!-- Default CSS Color --> 
    <link href="{{asset('front')}}/color/default.css" rel="stylesheet">
     <!-- Color CSS --> 
    <link rel="stylesheet" href="{{asset('front')}}/color/color-switcher.css">
	<!-- Responsive CSS -->
    <link href="{{asset('front')}}/css/responsive.css" rel="stylesheet">


  </head>
  <body>
  
   <!-- Preloader -->
    <div id="fakeloader"></div>
	
    <div class="top-menu-3x">
		<div class="container">
			<div class="row">		
                <div class="col-md-6">
					<div class="top-menu-left-3 col-md-5">
						<select class="form-control" id="country">
							@foreach($country as $c)
							<option value="{{$c->country_code}}">{{$c->country_name}}</option>
							@endforeach
							
						</select>
					</div>				
				</div>
				<div class="col-md-4">
					<div class="top-menu-middle-3">
						<div class="footer-info-right">								
						</div>					
					</div>				
				</div>
				<div class="col-md-2">
					<div class="top-menu-right-3 top-menu-right">
						<a href="{{route('register')}}"><i class="fa fa-sign-in"></i> Sign Up </a>| <a href="{{route('login')}}">Log In</a>                     		
					</div>				
				</div>
			</div>
		</div>
	</div>	 

	     
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('front')}}/js/jquery-3.2.1.min.js"></script>
    <script src="{{asset('front')}}/js/bootstrap.min.js"></script>

	<!-- Wow Script -->
	<script src="{{asset('front')}}/js/wow.min.js"></script>
	<!-- Counter Script -->
	<script src="{{asset('front')}}/js/waypoints.min.js"></script>
	<script src="{{asset('front')}}/js/jquery.counterup.min.js"></script>
	<!-- Masonry Portfolio Script -->
    <!-- <script src="{{asset('front')}}/js/jquery.filterizr.min.js"></script> -->
    <!-- <script src="{{asset('front')}}/js/filterizer-controls.js"></script> -->
    <!-- OWL Carousel js-->
	<!-- <script src="{{asset('front')}}/js/owl.carousel.min.js"></script>   -->
	<!-- Lightbox js -->
	<script src="{{asset('front')}}/inc/lightbox/js/jquery.fancybox.pack.js"></script>
	<script src="{{asset('front')}}/inc/lightbox/js/lightbox.js"></script>
	<!-- Google map js -->
	<!-- <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk&callback=initMap"></script>	 -->
<!-- 	<script src="{{asset('front')}}/js/map.js"></script> -->
	<!-- loader js-->
    <script src="{{asset('front')}}/js/fakeLoader.min.js"></script>
	<!-- Scroll bottom to top -->
	<script src="{{asset('front')}}/js/scrolltopcontrol.js"></script>
	<!-- menu -->
	<script src="{{asset('front')}}/js/bootstrap-4-navbar.js"></script>    
    <!-- Stiky menu -->
	<script src="{{asset('front')}}/js/jquery.sticky.js"></script>  
    <!-- youtube popup video -->
	<script src="{{asset('front')}}/js/jquery.magnific-popup.min.js"></script>  
    <!-- Color switcher js -->
	<script src="{{asset('front')}}/js/color-switcher.js"></script> 
    <!-- Color-switcher-active -->  
    <script src="{{asset('front')}}/js/color-switcher-active.js"></script>      
	<!-- Custom script -->
    <script src="{{asset('front')}}/js/custom.js"></script>
	<script>
		
		$('#country').on('change', function(){
		 window.location.href="{{url('/') }}/"+$(this).val();
		})
	</script>
  </body>
</html>     