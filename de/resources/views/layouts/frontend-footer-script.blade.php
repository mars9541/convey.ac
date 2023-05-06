<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('landing_front')}}/js/bootstrap.min.js"></script>

<!-- Wow Script -->
<script src="{{asset('landing_front')}}/js/wow.min.js"></script>
<!-- Counter Script -->
<script src="{{asset('landing_front')}}/js/waypoints.min.js"></script>
<script src="{{asset('landing_front')}}/js/jquery.counterup.min.js"></script>
<!-- Masonry Portfolio Script -->
<script src="{{asset('landing_front')}}/js/jquery.filterizr.min.js"></script>
<script src="{{asset('landing_front')}}/js/filterizer-controls.js"></script>
<!-- OWL Carousel js-->
<script src="{{asset('landing_front')}}/js/owl.carousel.min.js"></script>
<!-- Lightbox js -->
<script src="{{asset('landing_front')}}/inc/lightbox/js/jquery.fancybox.pack.js"></script>
<script src="{{asset('landing_front')}}/inc/lightbox/js/lightbox.js"></script>
<!-- Google map js -->
{{--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJnKEvlwpyjXfS_h-J1Cne2fPMqeb44Mk&callback=initMap"></script>--}}
{{--<script src="{{asset('landing_front')}}/js/map.js"></script>--}}
<!-- loader js-->
<script src="{{asset('landing_front')}}/js/fakeLoader.min.js"></script>
<!-- Scroll bottom to top -->
<script src="{{asset('landing_front')}}/js/scrolltopcontrol.js"></script>
<!-- menu -->
<script src="{{asset('landing_front')}}/js/bootstrap-4-navbar.js"></script>
<!-- Stiky menu -->
<script src="{{asset('landing_front')}}/js/jquery.sticky.js"></script>
<!-- youtube popup video -->
<script src="{{asset('landing_front')}}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ URL::asset('plugins/alertify/js/alertify.js') }}"></script>
<!-- Color switcher js -->
{{--<script src="{{asset('landing_front')}}/js/color-switcher.js"></script>--}}
<!-- Color-switcher-active -->
{{--<script src="{{asset('landing_front')}}/js/color-switcher-active.js"></script>--}}
<!-- Custom script -->
<script src="{{asset('landing_front')}}/js/custom.js"></script>

<script type="text/javascript">
    function onSelectCountry(country_name, short) {
        var url = $('#asset_url').val() + country_name + '.png';
        var site_url = $('#route_url').val().substring(0, $('#route_url').val().length - 2);
        var home_url = site_url + short;
        var login_url = home_url + '/login';
        var register_url = home_url + '/register';
        $('#img_country').attr('src', url);
        $('#a_login').attr('href', login_url);
        $('#a_signup').attr('href', register_url);
        $('#cntry').css('display', 'none');
        window.location.href = home_url;
    }

    function onOpenModal(type) {
        if(type == 'cookies') {
            $('#cookies_modal').modal('show');
        } else if(type == 'privacy') {
            $('#privacy_modal').modal('show');
        } else if(type == 'legal') {
            $('#legal_modal').modal('show');
        }

    }

    function onCountrySite(country_code) {
        var site_url = $('#route_url').val().substring(0, $('#route_url').val().length - 2);
        var home_url = site_url + country_code;
        window.location.href = home_url;
    }
</script>
@yield('script')

@yield('script-bottom')
