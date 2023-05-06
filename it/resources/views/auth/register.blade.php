@include('auth.header')
<style>
    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 0px !important;
    border-radius: 0px !important;
}
.text-convey-green {
  color: #3bc850!important;
}
.loginPage{
  position: relative;
}

label.error{
    display: none!important;
}
input.error, select.error{
    border:1px solid red;
    box-shadow: 0px 0px 4px red !important;
}

</style>
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
          <div id="form_overlay">
            <div class="form_overlay_message">
                <a href="{{url('/')}}"><img src="{{asset('front')}}/images/logo-dark.png" alt="logo" style="width: 70%"></a>
                <div style="height: 40px;"></div>
              <span class="m-t-25">Creazione dell’account in corso <br> Attendere prego.</span>
            </div>
          </div>
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('front')}}/images/logo-dark.png" alt="logo"></a>
            </div>
            <ul class="hidden">
                <li class="active" id="tab_1"></li>
                <li class="" id="tab_2"></li>
                <li class="" id="tab_3"></li>
                <li class="" id="tab_4"></li>
            </ul>
            <form action="#" id="register_form" method="post" >
            <div class="loginDetail">
                <div class="col-sm-12 alert alert-convey-success alert-dismissible fade hidden text-white" style="background-color: #3BC850;"  id="alert">

                    <strong>Attenzione!</strong><span id="alert_text"> Si prega di compilare tutti i campi richiesti.</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2>{{__('ISCRIVITI ORA')}} <span>(FASE 1 DI 4)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">A quale Paese vuoi accedere?</option>
                        @foreach($country as $c)
                            @if($c->country_code == 'ru')
                                @continue;
                            @endif

                            <option value="{{$c->country_code}}">{{$c->country_name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> Che tipo di account desideri?</option>
                        <option value="business"> Per aziende (Aggiungi e cerca registri)</option>
                        <option value="advisors"> Per Reclutatori/sviluppatori/collaboratori/redattori</option>
                        <option value="hris"> Per fornitori di software HRIS/ATS/VMS</option>
                        <option value="citizen"> Per me stesso, così posso trovare i miei registri personali</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div>
                            <input type="radio" name="hris_type"  id="a" checked  value="software">
                            <label for="a" > Forniamo solo software HRIS </label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="b" value="tracking">
                            <label for="b"> Forniamo solo software ATS o VMS</label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="c" value="both">
                            <label for="c"> Forniamo una combinazione di quanto sopra</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div>
                            <input type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label for="aa" > Sviluppiamo sistemi/software aziendali</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label for="bb"> Forniamo servizi per le risorse umane</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="cc" value="writer">
                            <label for="cc"> Forniamo servizi di reclutamento</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>ISCRIVITI ORA <span>(passaggio 2 di 4)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">Che tipo di attività sei?</option>
                        <option value="company"> Società</option>
                        <option value="organisation"> Organizzazione</option>
                        <option value="selfemployed">Lavoratore autonomo</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">Qual è il tuo settore?</option>
                        @foreach($market as $m)
                        <option value="{{$m->market_value}}">{{$m->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">Quanti dipendenti hai ?</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>ISCRIVITI ORA <span>(FASE 3 DI 4)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Inserisci il tuo indirizzo e-mail" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">Non puoi usare un indirizzo e-mail gratuito.
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="Scegli una password" id="password" required>
                    <label class="note">Le password devono contenere almeno 8 caratteri</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ripeti la password" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="Referral Code (se qualcuno te ne ha dato uno)" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>ISCRIVITI ORA <span>(ultimo passaggio)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="Nome" required>
                        <input type="text" class="form-control" name="lastname" placeholder="Cognome" required>
                        <label>Data di nascita</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">Mese</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-sm-3 offset-1 form-control" >
                                <select class="select2" name="day" id="day" required>
                                    <option value="">Giorno</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">Anno</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="Paese" required>
                        <input type="text" class="form-control" name="nationality" placeholder="Nazionalità" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="Numero civico/edificio" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="Strada/Piazza" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Città" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="Codice postale" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality">
                        <label for="confidentiality">Accordo confidenziale</label>
                        <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">Visualizza qui</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms">
                        <label for="terms"> Termini e Condizioni</label>
                        <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">Visualizza qui</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy">
                        <label for="privacy">Accordo sulla privacy</label>
                        <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">Visualizza qui</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">Procedi</button>
            </div>

        </div>
    </div>
</section>
<div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="form-group" id="article_detail">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    function view_guide_detail(input) {
        $.ajax({
            url: "{{route('get_terms_temp')}}",
            method: "POST",
            data: {
                user_type: $('#user_type').val(),
                item: input,
            },
            dataType: "json",
            success: function (html) {
                $('#article_title').html('')
                $('#article_detail').html(html);
                $('.bs-example-modal-lg').modal('show');
            },
            error: function () {
                alert('server error');

            }
        })
    }

    $('#country').change(function () {
        if ($('#country').val() != '') {
            var locale = "{{app()->getLocale()}}";
            locale = '/' + locale + '/';
            var replace_country_code = '/' + $('#country').val() + '/';
            var url = window.location.href;
            if ($('#country').val() != locale) {
                var url = url.replace(locale, replace_country_code);
                window.location.href = url;
            }
        }
    })

    $('#user_type').on('change', function () {
        if ($('#user_type').val() == 'hris') {
            $('#hris_radio').removeClass('hidden');
        } else {
            if ($('#hris_radio').hasClass('hidden')) {
            } else {
                $('#hris_radio').addClass('hidden');
            }
        }
        if ($('#user_type').val() == 'advisors') {
            $('#advisors_radio').removeClass('hidden');
        } else {
            if ($('#advisors_radio').hasClass('hidden')) {
            } else {
                $('#advisors_radio').addClass('hidden');
            }
        }
        return true;
    })

    function changeDate(i) {
        var e = document.getElementById('day');

        while (e.length > 0) {
            e.remove(e.length - 1);
        }

        var j = -1;
        if (i == "") {
            k = 0;
        } else if (i == 2) {
            k = 28;
        } else if (i == 4 || i == 6 || i == 9 || i == 11) {
            k = 30;
        } else {
            k = 31;
        }

        while (j++ < k) {
            var s = document.createElement('option');
            var e = document.getElementById('day');

            if (j == 0) {
                s.text = "Day";
                s.value = "";

                try {
                    e.add(s, null);
                } catch (ex) {
                    e.add(s);
                }
            } else {
                s.text = j;
                s.value = j;

                try {
                    e.add(s, null);
                } catch (ex) {
                    e.add(s);
                }
            }
        }

        y = '{{date('Y')}}';
        while (y-- > 1920) {
            var s = document.createElement('option');
            var e = document.getElementById('year');

            s.text = y;
            s.value = y;

            try {
                e.add(s, null);
            } catch (ex) {
                e.add(s);
            }
        }
    }

    function reload() {
        $(".select2").select2();
        y = '{{date('Y')}}';

        while (y-- > 1920) {
            var s = document.createElement('option');
            var e = document.getElementById('year');

            s.text = y;
            s.value = y;

            try {
                e.add(s, null);
            } catch (ex) {
                e.add(s);
            }
        }
    }

$(document).ready(function(){
    var locale = "{{app()->getLocale()}}";
    $('#country').val(locale);

    $(".select2").select2();

    $('.submitBtn').click(function () {
        $('#alert').removeClass('show');

        var tab = $('li');

        for (var i = 0; i < tab.length; i++) {
            if ($('#tab_' + i).hasClass('active')) {
                if (validate()) {
                    if ($('#user_type').val() == 'citizen') {
                        $('li').removeClass('active');
                        $('#tab_' + (3)).addClass('active');
                        $('#step_' + 1).addClass('hidden');
                        $('#step_' + (3)).removeClass('hidden');
                        $('#alert').addClass('hidden');
                        $('#step_2').empty();
                    } else {
                        $('li').removeClass('active');
                        $('#tab_' + (i + 1)).addClass('active');
                        $('#step_' + i).addClass('hidden');
                        $('#step_' + (i + 1)).removeClass('hidden');
                        $('#alert').addClass('hidden');
                    }

                    break;
                }
            }
        }

        if ($('#tab_4').hasClass('active')) {
            if (validate()) {
                $('#form_overlay').show();
                $("html, body").animate({scrollTop: 0}, "slow");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{route('save_register')}}",
                    method: 'post',
                    data: $('#register_form').serialize(),
                    dataType: 'json',
                    success: function (result) {
                        window.location.href = result.link;
                    },
                    error: function () {
                        $('#form_overlay').hide();
                    }
                });

            }
        }
    })

    function validate() {
        if ($('#tab_1').hasClass('active')) {
            if ($('#country').val() == '' || $('#user_type').val() == '') {
                $('#submitBtn').click();
                return false;
            } else {
                if ($('#user_type').val() == 'hris') {
                    $('#business_type').empty();
                    $('#business_type').append('<option value="">Che tipo di attività sei?</option>\n' +
                        '                        <option value="company"> Società</option>\n' +
                        '                        <option value="organisation"> Organizzazione</option>');
                }

                return true;
            }
        }

        if ($('#tab_2').hasClass('active')) {
            if ($('#business_type').val() == '' || $('#market').val() == '' || $('#employees').val() == '') {
                $('#submitBtn').click();
                return false;
            } else {
                return true;
            }
        }

        if ($('#tab_3').hasClass('active')) {
            if ($('#free_email_error').css('display') != 'none')
                return false;
            if ($('#email').val() == '' || $('#password').val() == '' || $('#password_confirmation').val() == '') {
                $('#submitBtn').click();
                return false;
            } else {
                if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#email').val())) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('email_verify')}}",
                        method: 'post',
                        data: {
                            email: $('#email').val(),
                        },
                        success: function (result) {
                            if (result.status == false) {
                                $('#alert').addClass('hidden');
                                if (check_password())
                                    check_referral_code();
                            } else if(result.status == true) {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Questa e-mail esiste già!');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Invece di creare manualmente questo account, accedi al tuo account esistente e attiva "l\'accesso al paese" in modo che tutti i tuoi account siano collegati.');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('Inserisci un indirizzo e-mail valido!');
                    $('#alert').focus();
                    $("html, body").animate({scrollTop: 0}, "slow");
                    return false;
                }
            }
        }

        if ($('#tab_4').hasClass('active')) {
            // event.preventDefault();
            if ($("#register_form").valid()) {
                return true;
            } else {
                if ($('#month').val() == '') {
                    $('#month').parent().css('box-shadow', '0px 0px 4px red').css('border', '1px solid red');
                }

                if ($('#day').val() == '') {
                    $('#day').parent().css('box-shadow', '0px 0px 4px red').css('border', '1px solid red');
                }

                if ($('#year').val() == '') {
                    $('#year').parent().css('box-shadow', '0px 0px 4px red').css('border', '1px solid red');
                }

                if ($('#business_type').val() == 'company') {
                    var company_no = $('input[name=company_no]').val();

                    if (!/^([A-Za-z0-9]{11})$/.test(company_no)) {
                        $('input[name=company_no]').css('box-shadow', '0px 0px 4px red');
                        $('input[name=company_no]').css('margin-bottom', '0px');
                        $('#company_no_error').show();
                        $("html, body").animate({scrollTop: 0}, "slow");

                        return false;
                    } else {
                        $('input[name=company_no]').css('box-shadow', '');
                        $('input[name=company_no]').css('margin-bottom', '');

                        $('#company_no_error').hide();
                    }
                }

                if ($('#user_type').val() != 'citizen') {
                    var website_url = $('input[name=website]').val();
                    var url_array = website_url.split(' ');

                    if (website_url.substr(0, 4) != 'www.' || url_array.length > 1) {
                        $('input[name=website]').css('box-shadow', '0px 0px 4px red');
                        $('input[name=website]').css('margin-bottom', '0px');
                        $('#website_error').show();
                        $("html, body").animate({scrollTop: 100}, "slow");

                        return false;
                    } else {
                        $('input[name=website]').css('box-shadow', '');
                        $('input[name=website]').css('margin-bottom', '');

                        $('#website_error').hide();
                    }
                }

                return false;
            }
        }

    }

    $(document).on('input', 'input[name=company_no]', function () {
        var company_no = $('input[name=company_no]').val();
        if (!/^([A-Za-z0-9]{11})$/.test(company_no)) {
            $('input[name=company_no]').css('box-shadow', '0px 0px 4px red');
            $('input[name=company_no]').css('margin-bottom', '0px');

            $('#company_no_error').show();
        } else {
            $('input[name=company_no]').css('box-shadow', '');
            $('input[name=company_no]').css('margin-bottom', '');

            $('#company_no_error').hide();
        }
    })

    $(document).on('input', 'input[name=website]', function () {
        var website_url = $('input[name=website]').val();
        var url_array = website_url.split(' ');

        if (website_url.substr(0, 4) != 'www.' || url_array.length > 1) {
            $('input[name=website]').css('box-shadow', '0px 0px 4px red');
            $('input[name=website]').css('margin-bottom', '0px');

            $('#website_error').show();
        } else {
            $('input[name=website]').css('box-shadow', '');
            $('input[name=website]').css('margin-bottom', '');

            $('#website_error').hide();
        }
    })

    $('#email').on('input', function () {
        if ($('#user_type').val() == 'citizen') {
            $('input[name=email]').css('box-shadow', '');
            $('input[name=email]').css('margin-bottom', '');
            $('#free_email_error').hide();
            return false;
        }
        var str = "{{$freeEmailList}}";
        var freeEmails = str.split(',');
        var input_email = $('#email').val();
        for (let i = 0; i < freeEmails.length; i++) {
            if (input_email.indexOf(freeEmails[i]) < 0) {
                $('input[name=email]').css('box-shadow', '');
                $('input[name=email]').css('margin-bottom', '');
                $('#free_email_error').hide();
                continue;
            } else {
                $('input[name=email]').css('box-shadow', '0px 0px 4px red');
                $('input[name=email]').css('margin-bottom', '0px');
                $('#free_email_error').show();
                break;
            }
        }
    })

    $("#register_form").validate({
        focusInvalid: false,
        invalidHandler: function (form, validator) {

            if (!validator.numberOfInvalids())
                return;

            $('html, body').animate({
                scrollTop: $(validator.errorList[0].element).offset().top - 50
            }, 2000);

        }
    });

    function check_password() {
        if ($('#password').val().length >= 8) {
            if ($('#password').val() == $('#password_confirmation').val()) {
                return true;
            } else {
                $('#alert').removeClass('hidden');
                $('#alert').addClass('show');
                $('#alert_text').html('Inserisci una password di conferma valida!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('Le password devono contenere almeno 8 caratteri');
            $('#alert').focus();
            return false;
        }
    }

    function check_referral_code() {
        if ($('#referral_code').val() != "") {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('code_verify')}}",
                method: 'post',
                data: {
                    code: $('#referral_code').val(),
                },
                success: function (result) {
                    if (result == 'true') {
                        $('#alert').addClass('hidden');
                        change_detail();
                    } else {
                        $('#alert').removeClass('hidden');
                        $('#alert').addClass('show');
                        $('#alert_text').html('Referral_code non valido!');
                        $('#alert').focus();
                    }
                }
            })
        } else {
            $('#alert').addClass('hidden');
            change_detail();
        }
    }

    function change_detail()
    {
        var countries = '<option value="IT">Italia</option>' +
            '<option value="AF">Afghanistan</option>'+
            '<option value="AX">Isole Åland</option>'+
            '<option value="AL">Albania</option>'+
            '<option value="DZ">Algeria</option>'+
            '<option value="AS">Samoa Americane</option>'+
            '<option value="AD">Andorra</option>'+
            '<option value="AO">Angola</option>'+
            '<option value="AI">Anguilla</option>'+
            '<option value="AQ">Antarctica</option>'+
            '<option value="AG">Antigua e Barbuda</option>'+
            '<option value="AR">Argentina</option>'+
            '<option value="AM">Armenia</option>'+
            '<option value="AW">Aruba</option>'+
            '<option value="AU">Australia</option>'+
            '<option value="AT">Austria</option>'+
            '<option value="AZ">Azerbaigian</option>'+
            '<option value="BS">Bahamas</option>'+
            '<option value="BH">Bahrain</option>'+
            '<option value="BD">Bangladesh</option>'+
            '<option value="BB">Barbados</option>'+
            '<option value="BY">Bielorussia</option>'+
            '<option value="BE">Belgio</option>'+
            '<option value="BZ">Belize</option>'+
            '<option value="BJ">Benin</option>'+
            '<option value="BM">Bermuda</option>'+
            '<option value="BT">Bhutan</option>'+
            '<option value="BO">Bolivia</option>'+
            '<option value="BQ">Bonaire, Sint Eustatius e Saba</option>'+
            '<option value="BA">Bosnia ed Erzegovina</option>'+
            '<option value="BW">Botswana</option>'+
            '<option value="BV">Isola Bouvet</option>'+
            '<option value="BR">Brasile</option>'+
            '<option value="IO">Territori Britannici dell\'Oceano Indiano</option>'+
            '<option value="BN">Brunei</option>'+
            '<option value="BG">Bulgaria</option>'+
            '<option value="BF">Burkina Faso</option>'+
            '<option value="BI">Burundi</option>'+
            '<option value="KH">Cambogia</option>'+
            '<option value="CM">Camerun</option>'+
            '<option value="CA">Canada</option>'+
            '<option value="CV">Cape Verde</option>'+
            '<option value="KY">Isole Cayman</option>'+
            '<option value="CF">Repubblica Centrafricana</option>'+
            '<option value="TD">Ciad</option>'+
            '<option value="CL">Cile</option>'+
            '<option value="CN">Cina</option>'+
            '<option value="CX">Isola di Natale</option>'+
            '<option value="CC">Isole Cocos (Keeling)</option>'+
            '<option value="CO">Colombia</option>'+
            '<option value="KM">Comore</option>'+
            '<option value="CG">Congo</option>'+
            '<option value="CD">Congo, Repubblica Democratica del</option>'+
            '<option value="CK">Isole Cook</option>'+
            '<option value="CR">Costa Rica</option>'+
            '<option value="CI">Costa d’\\Avorio</option>'+
            '<option value="HR">Croazia</option>'+
            '<option value="CU">Cuba</option>'+
            '<option value="CW">Curaçao</option>'+
            '<option value="CY">Cipro</option>'+
            '<option value="CZ">Repubblica Ceca</option>'+
            '<option value="DK">Danimarca</option>'+
            '<option value="DJ">Gibuti</option>'+
            '<option value="DM">Dominica</option>'+
            '<option value="DO">Repubblica Dominicana</option>'+
            '<option value="EC">Ecuador</option>'+
            '<option value="EG">Egitto</option>'+
            '<option value="SV">El Salvador</option>'+
            '<option value="GQ">Guinea Equatoriale</option>'+
            '<option value="ER">Eritrea</option>'+
            '<option value="EE">Estonia</option>'+
            '<option value="ET">Etiopia</option>'+
            '<option value="FK">Isole Falkland (Malvine)</option>'+
            '<option value="FO">Isole Faroe</option>'+
            '<option value="FJ">Fiji</option>'+
            '<option value="FI">Finlandia</option>'+
            '<option value="FR">Francia</option>'+
            '<option value="GF">Guyana Francese</option>'+
            '<option value="PF">Polinesia Francese</option>'+
            '<option value="TF">Territori australi francesi</option>'+
            '<option value="GA">Gabon</option>'+
            '<option value="GM">Gambia</option>'+
            '<option value="GE">Georgia</option>'+
            '<option value="DE">Germania</option>'+
            '<option value="GH">Ghana</option>'+
            '<option value="GI">Gibilterra</option>'+
            '<option value="GR">Grecia</option>'+
            '<option value="GL">Groenlandia</option>'+
            '<option value="GD">Grenada</option>'+
            '<option value="GP">Guadalupa</option>'+
            '<option value="GU">Guam</option>'+
            '<option value="GT">Guatemala</option>'+
            '<option value="GG">Guernsey</option>'+
            '<option value="GN">Guinea</option>'+
            '<option value="GW">Guinea-Bissau</option>'+
            '<option value="GY">Guyana</option>'+
            '<option value="HT">Haiti</option>'+
            '<option value="HM">Isola Heard e Isole McDonald</option>'+
            '<option value="VA">Città del Vaticano</option>'+
            '<option value="HN">Honduras</option>'+
            '<option value="HK">Hong Kong</option>'+
            '<option value="HU">Ungheria</option>'+
            '<option value="IS">Islanda</option>'+
            '<option value="IN">India</option>'+
            '<option value="ID">Indonesia</option>'+
            '<option value="IR">Iran</option>'+
            '<option value="IQ">Iraq</option>'+
            '<option value="IE">Irlanda</option>'+
            '<option value="IM">Isola di Man</option>'+
            '<option value="IL">Israele</option>'+

            '<option value="JM">Giamaica</option>'+
            '<option value="JP">Giappone</option>'+
            '<option value="JE">Jersey</option>'+
            '<option value="JO">Giordania</option>'+
            '<option value="KZ">Kazakistan</option>'+
            '<option value="KE">Kenya</option>'+
            '<option value="KI">Kiribati</option>'+
            '<option value="KP">Corea del Nord</option>'+
            '<option value="KR">Corea del Sud</option>'+
            '<option value="KW">Kuwait</option>'+
            '<option value="KG">Kirghizistan</option>'+
            '<option value="LA">Laos</option>'+
            '<option value="LV">Lettonia</option>'+
            '<option value="LB">Libano</option>'+
            '<option value="LS">Lesotho</option>'+
            '<option value="LR">Liberia</option>'+
            '<option value="LY">Libia</option>'+
            '<option value="LI">Liechtenstein</option>'+
            '<option value="LT">Lituania</option>'+
            '<option value="LU">Lussemburgo</option>'+
            '<option value="MO">Macao</option>'+
            '<option value="MK">Macedonia del Nord</option>'+
            '<option value="MG">Madagascar</option>'+
            '<option value="MW">Malawi</option>'+
            '<option value="MY">Malesia</option>'+
            '<option value="MV">Maldive</option>'+
            '<option value="ML">Mali</option>'+
            '<option value="MT">Malta</option>'+
            '<option value="MH">Isole Marshall</option>'+
            '<option value="MQ">Martinica</option>'+
            '<option value="MR">Mauritania</option>'+
            '<option value="MU">Mauritius</option>'+
            '<option value="YT">Mayotte</option>'+
            '<option value="MX">Messico</option>'+
            '<option value="FM">Micronesia, Stati Federati di </option>'+
            '<option value="MD">Moldavia</option>'+
            '<option value="MC">Monaco</option>'+
            '<option value="MN">Mongolia</option>'+
            '<option value="ME">Montenegro</option>'+
            '<option value="MS">Montserrat</option>'+
            '<option value="MA">Morocco</option>'+
            '<option value="MZ">Mozambico</option>'+
            '<option value="MM">Myanmar</option>'+
            '<option value="NA">Namibia</option>'+
            '<option value="NR">Nauru</option>'+
            '<option value="NP">Nepal</option>'+
            '<option value="NL">Paesi Bassi</option>'+
            '<option value="NC">Nuova Caledonia</option>'+
            '<option value="NZ">Nuova Zelanda</option>'+
            '<option value="NI">Nicaragua</option>'+
            '<option value="NE">Niger</option>'+
            '<option value="NG">Nigeria</option>'+
            '<option value="NU">Niue</option>'+
            '<option value="NF">Isola Norfolk</option>'+
            '<option value="MP">Isole Marianne Settentrionali</option>'+
            '<option value="NO">Norvegia</option>'+
            '<option value="OM">Oman</option>'+
            '<option value="PK">Pakistan</option>'+
            '<option value="PW">Palau</option>'+
            '<option value="PS">Palestina</option>'+
            '<option value="PA">Panama</option>'+
            '<option value="PG">Papua Nuova Guinea</option>'+
            '<option value="PY">Paraguay</option>'+
            '<option value="PE">Peru</option>'+
            '<option value="PH">Filippine</option>'+
            '<option value="PN">Isole Pitcairn</option>'+
            '<option value="PL">Polonia</option>'+
            '<option value="PT">Portogallo</option>'+
            '<option value="PR">Porto Rico</option>'+
            '<option value="QA">Qatar</option>'+
            '<option value="RE">Riunione</option>'+
            '<option value="RO">Romania</option>'+
            '<option value="RU">Russia</option>'+
            '<option value="RW">Ruanda</option>'+
            '<option value="BL">Saint-Barthélemy</option>'+
            '<option value="SH">Sant\'Elena, Ascensione e Tristan da Cunha</option>'+
            '<option value="KN">Saint Kitts e Nevis</option>'+
            '<option value="LC">Santa Lucia</option>'+
            '<option value="MF">Saint Martin</option>'+
            '<option value="PM">Saint-Pierre e Miquelon</option>'+
            '<option value="VC">Saint Vincent e Grenadine</option>'+
            '<option value="WS">Samoa</option>'+
            '<option value="SM">San Marino</option>'+
            '<option value="ST">São Tomé e Príncipe</option>'+
            '<option value="SA">Arabia Saudita</option>'+
            '<option value="SN">Senegal</option>'+
            '<option value="RS">Serbia</option>'+
            '<option value="SC">Seychelles</option>'+
            '<option value="SL">Sierra Leone</option>'+
            '<option value="SG">Singapore</option>'+
            '<option value="SX">Sint Maarten</option>'+
            '<option value="SK">Slovacchia</option>'+
            '<option value="SI">Slovenia</option>'+
            '<option value="SB">Isole Salomone</option>'+
            '<option value="SO">Somalia</option>'+
            '<option value="ZA">Sudafrica</option>'+
            '<option value="GS">Georgia del Sud e Isole Sandwich Australi</option>'+
            '<option value="SS">Sudan del Sud</option>'+
            '<option value="ES">Spagna</option>'+
            '<option value="LK">Sri Lanka</option>'+
            '<option value="SD">Sudan</option>'+
            '<option value="SR">Suriname</option>'+
            '<option value="SJ">Svalbard e Jan Mayen</option>'+
            '<option value="SZ">eSwatini</option>'+
            '<option value="SE">Svezia</option>'+
            '<option value="CH">Svizzera</option>'+
            '<option value="SY">Siria</option>'+
            '<option value="TW">Taiwan</option>'+
            '<option value="TJ">Tagikistan</option>'+
            '<option value="TZ">Tanzania</option>'+
            '<option value="TH">Thailand</option>'+
            '<option value="TL">Timor Est</option>'+
            '<option value="TG">Togo</option>'+
            '<option value="TK">Tokelau</option>'+
            '<option value="TO">Tonga</option>'+
            '<option value="TT">Trinidad e Tobago</option>'+
            '<option value="TN">Tunisia</option>'+
            '<option value="TR">Turchia</option>'+
            '<option value="TM">Turkmenistan</option>'+
            '<option value="TC">Isole Turks e Caicos</option>'+
            '<option value="TV">Tuvalu</option>'+
            '<option value="UG">Uganda</option>'+
            '<option value="UA">Ucraina</option>'+
            '<option value="AE">Emirati Arabi Uniti</option>'+
            '<option value="GB">Regno Unito</option>' +
            '<option value="US">Stati Uniti</option>'+
            '<option value="UM">Isole Minori Esterne degli Stati Uniti</option>'+
            '<option value="UY">Uruguay</option>'+
            '<option value="UZ">Uzbekistan</option>'+
            '<option value="VU">Vanuatu</option>'+
            '<option value="VE">Venezuela</option>'+
            '<option value="VN">Vietnam</option>'+
            '<option value="VG">Isole Vergini Britanniche</option>'+
            '<option value="VI">Isole Vergini Americane</option>'+
            '<option value="WF">Wallis e Futuna</option>'+
            '<option value="EH">Sahara Occidentale</option>'+
            '<option value="YE">Yemen</option>'+
            '<option value="ZM">Zambia</option>'+
            '<option value="ZW">Zimbabwe</option>'
        ;
        $('li').removeClass('active');
        $('#tab_'+(4)).addClass('active');
        $('#step_'+3).addClass('hidden');
        $('#step_'+(4)).removeClass('hidden');

        if($('#business_type').val()=='organisation')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Nome dell\'organizzazione" required>\n' +
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="IVA (se disponibile)">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Sede dell\'organizzazione - Numero civico/edificio" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Sede dell\'organizzazione - Via/Piazza" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Sede dell\'organizzazione - Città" required>\n' +
                '        <input type="hidden" value="IT" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Sede dell\'organizzazione – Paese" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="IT">Italia</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Sede dell\'organizzazione – CAP" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Rappresentanti legali - Nome" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Rappresentanti legali - Cognome" required>\n' +
                '<label>Rappresentanti legali - Data di nascita</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mese</option>\n' +
                '                                <option value="1">1</option>\n' +
                '                                <option value="2">2</option>\n' +
                '                                <option value="3">3</option>\n' +
                '                                <option value="4">4</option>\n' +
                '                                <option value="5">5</option>\n' +
                '                                <option value="6">6</option>\n' +
                '                                <option value="7">7</option>\n' +
                '                                <option value="8">8</option>\n' +
                '                                <option value="9">9</option>\n' +
                '                                <option value="10">10</option>\n' +
                '                                <option value="11">11</option>\n' +
                '                                <option value="12">12</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-3 offset-1 form-control" >\n' +
                '                            <select class="select2" name="day" required id="day" required>\n' +
                '                                <option value="">Giorno</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Anno</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Rappresentanti legali – Paese" required>\n' +
                '<option value="">Rappresentanti legali – Paese</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Rappresentanti legali – Nazionalità" required>\n' +
                '<option value="">Rappresentanti legali – Nazionalità</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Rappresentanti legali - Numero civico/edificio" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Rappresentanti legali - Via/Piazza" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Rappresentanti legali - Città" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Rappresentanti legali - Codice postale" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL del sito" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Deve iniziare con "www" e senza spazi.\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="Nome" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Cognome" required>\n' +
                '<label>Date Of Birth</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mese</option>\n' +
                '                                <option value="1">1</option>\n' +
                '                                <option value="2">2</option>\n' +
                '                                <option value="3">3</option>\n' +
                '                                <option value="4">4</option>\n' +
                '                                <option value="5">5</option>\n' +
                '                                <option value="6">6</option>\n' +
                '                                <option value="7">7</option>\n' +
                '                                <option value="8">8</option>\n' +
                '                                <option value="9">9</option>\n' +
                '                                <option value="10">10</option>\n' +
                '                                <option value="11">11</option>\n' +
                '                                <option value="12">12</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-3 offset-1 form-control" >\n' +
                '                            <select class="select2" name="day" required id="day" required>\n' +
                '                                <option value="">Giorno</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Anno</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="IT" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="Paese" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="IT">Italia</option>' +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Nazionalità" required>\n' +
                '<option value="">Nationality</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="Denominazione commerciale" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="IVA (se disponibile)">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Numero civico/edificio" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Strada/Piazza" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Città" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Codice postale" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL del sito" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Deve iniziare con "www" e senza spazi.\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Nome dell’azienda" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="Numero aziendale" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   Indicare un numero di almeno 11 cifre di una società del Italia.\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Sede dell\'azienda - Numero civico/edificio" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Sede Aziendale - Via/Piazza" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Sede Aziendale - Città" required>\n' +
                '        <input type="hidden" value="IT" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Sede Aziendale – Paese" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="IT">Italia</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Sede dell\'azienda – CAP" required>'+
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="IVA (se disponibile)">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Direttore - Nome" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Direttore - Cognome" required>\n' +
                '<label>Direttore - Data di nascita</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mese</option>\n' +
                '                                <option value="1">1</option>\n' +
                '                                <option value="2">2</option>\n' +
                '                                <option value="3">3</option>\n' +
                '                                <option value="4">4</option>\n' +
                '                                <option value="5">5</option>\n' +
                '                                <option value="6">6</option>\n' +
                '                                <option value="7">7</option>\n' +
                '                                <option value="8">8</option>\n' +
                '                                <option value="9">9</option>\n' +
                '                                <option value="10">10</option>\n' +
                '                                <option value="11">11</option>\n' +
                '                                <option value="12">12</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-3 offset-1 form-control" >\n' +
                '                            <select class="select2" name="day" required id="day" required>\n' +
                '                                <option value="">Giorno</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Anno</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Direttore – Paese" required>\n' +
                '<option value="">Direttore – Paese</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="Direttore – Nazionalità" required>\n' +
                '<option value="">Direttore – Nazionalità</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Indirizzo postale - Numero civico/edificio" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Indirizzo postale - Strada/Piazza" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Indirizzo postale - Città" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Indirizzo postale – Codice postale" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL del sito" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Deve iniziare con "www" e senza spazi.\n'+
                '</small>\n');
        }
        if($('#user_type').val()=='citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="Nome" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="Cognome" required>\n' +
                '                    <label>Data di nascita</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mese</option>\n' +
                '                                <option value="1">1</option>\n' +
                '                                <option value="2">2</option>\n' +
                '                                <option value="3">3</option>\n' +
                '                                <option value="4">4</option>\n' +
                '                                <option value="5">5</option>\n' +
                '                                <option value="6">6</option>\n' +
                '                                <option value="7">7</option>\n' +
                '                                <option value="8">8</option>\n' +
                '                                <option value="9">9</option>\n' +
                '                                <option value="10">10</option>\n' +
                '                                <option value="11">11</option>\n' +
                '                                <option value="12">12</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-3 offset-1 form-control" >\n' +
                '                            <select class="select2" name="day" id="day" required>\n' +
                '                                <option value="">Giorno</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">Anno</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="IT" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="Paese" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="IT">Italia</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="Nazionalità" required>\n' +
                '<option value="">Nazionalità</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="Numero civico/edificio" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="Strada/Piazza" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="Città" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="Codice postale" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
