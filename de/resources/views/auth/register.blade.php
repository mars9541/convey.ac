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
              <span class="m-t-25">Kontoerstellung in Bearbeitung <br> Bitte haben Sie einen Moment Geduld.</span>
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

                    <strong>Achtung!</strong><span id="alert_text"> Bitte füllen Sie alle erforderlichen Angaben aus.</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2>{{__('JETZT ANMELDEN')}} <span>(SCHRITT 1 VON 4)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">Auf welches Land möchten Sie zugreifen?</option>
                        @foreach($country as $c)
                            @if($c->country_code == 'ru')
                                @continue;
                            @endif
                        <option value="{{$c->country_code}}">{{$c->country_name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> Welche Art von Konto möchten Sie?</option>
                        <option value="business"> Eines für Unternehmen (Datensätze hinzufügen & suchen)</option>
                        <option value="advisors"> Eines für Personalvermittler/Entwickler/Berater/Schriftsteller</option>
                        <option value="hris"> Eines für HRIS/ATS/VMS-Software-Anbieter</option>
                        <option value="citizen"> Eines für mich selbst, damit ich meine persönlichen Datensätze finden kann</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="a" checked  value="software">
                            <label class="d-inline" for="a" > Wir bieten nur HRIS-Software an </label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="b" value="tracking">
                            <label class="d-inline" for="b"> Wir bieten nur ATS- oder VMS-Software an</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="c" value="both">
                            <label class="d-inline" for="c"> Wir bieten eine Kombination aus den oben genannten Produkten</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label class="d-inline" for="aa" > Wir entwickeln Business-Systeme/Software</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label class="d-inline" for="bb"> Wir bieten HR-Dienstleistungen an</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="cc" value="writer">
                            <label class="d-inline" for="cc"> Wir bieten Rekrutierungsdienstleistungen an</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>Jetzt anmelden <span>(Schritt 2 von 4)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">Welche Art von Unternehmen sind Sie?</option>
                        <option value="company"> Unternehmen</option>
                        <option value="organisation"> Organisation</option>
                        <option value="selfemployed">Selbstständig</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">In welchem Markt sind Sie tätig?</option>
                        @foreach($market as $m)
                        <option value="{{$m->market_value}}">{{$m->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">Wie viele Mitarbeiter haben Sie?</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>Jetzt anmelden <span>(Schritt 3 von 4)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Geben Sie Ihre E-Mail Adresse ein" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">Sie können keine kostenlose E-Mail Adresse verwenden.
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="Wählen Sie ein Passwort" id="password" required>
                    <label class="note">Passwörter müssen mindestens 8 Zeichen lang sein</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Passwort wiederholen" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="Referal Code (wenn Ihnen jemand einen gegeben hat)" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>Jetzt anmelden <span>(letzter Schritt)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="Vorname" required>
                        <input type="text" class="form-control" name="lastname" placeholder="Nachname" required>
                        <label>Geburtsdatum</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">Monat</option>
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
                                    <option value="">Tag</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">Jahr</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="Land" required>
                        <input type="text" class="form-control" name="nationality" placeholder="Nationalität" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="Haus/Gebäudenummer" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="Straße/Straße" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Stadt/Ort" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="Postleitzahl" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality">
                        <label for="confidentiality">Vertraulichkeitsvereinbarung</label>
                        <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">Hier ansehen</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms">
                        <label for="terms"> Bedingungen und Konditionen</label>
                        <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">Hier ansehen</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy">
                        <label for="privacy">Datenschutz-Vereinbarung </label>
                        <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">Hier ansehen</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">Weiter</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
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
                    $('#business_type').append('<option value="">Welche Art von Unternehmen sind Sie?</option>\n' +
                        '                        <option value="company"> Unternehmen</option>\n' +
                        '                        <option value="organisation"> Organisation</option>');
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
                            user_type: $('#user_type').val(),
                        },
                        success: function (result) {
                            if (result.status == false) {
                                $('#alert').addClass('hidden');
                                if (check_password())
                                    check_referral_code();
                            } else if(result.status == true) {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Diese E-Mail ist bereits vorhanden!');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Anstatt dieses Konto manuell anzulegen, melden Sie sich bitte bei Ihrem bestehenden Konto an und aktivieren Sie den "Länderzugang", damit alle Ihre Konten miteinander verknüpft werden.');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('Gültige Email eingeben!');
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

                    if (!/^([A-Za-z0-9]{1,})$/.test(company_no)) {
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
        if (!/^([A-Za-z0-9]{1,})$/.test(company_no)) {
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
                $('#alert_text').html('Gültiges Passwort zur Bestätigung eingeben!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('Passwörter müssen mindestens 8 Zeichen lang sein');
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
                        $('#alert_text').html('Ungültiger Referral_code!');
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
        var countries = '<option value="DE">Deutschland</option>'+
            '<option value="AF">Afghanistan</option>'+
            '<option value="AX">AX Åland-Inseln</option>'+
            '<option value="AL">Albanien</option>'+
            '<option value="DZ">Algerien</option>'+
            '<option value="AS">Amerikanisch-Samoa</option>'+
            '<option value="AD">Andorra</option>'+
            '<option value="AO">Angola</option>'+
            '<option value="AI">Anguilla</option>'+
            '<option value="AQ">Antarktis</option>'+
            '<option value="AG">Antigua und Barbuda</option>'+
            '<option value="AR">Argentinien</option>'+
            '<option value="AM">Armenien</option>'+
            '<option value="AW">Aruba</option>'+
            '<option value="AU">Australien</option>'+
            '<option value="AT">Österreich</option>'+
            '<option value="AZ">Aserbaidschan</option>'+
            '<option value="BS">Bahamas</option>'+
            '<option value="BH">Bahrain</option>'+
            '<option value="BD">Bangladesch</option>'+
            '<option value="BB">Barbados</option>'+
            '<option value="BY">Weißrussland</option>'+
            '<option value="BE">Belgien</option>'+
            '<option value="BZ">Belize</option>'+
            '<option value="BJ">Benin</option>'+
            '<option value="BM">Bermuda</option>'+
            '<option value="BT">Bhutan</option>'+
            '<option value="BO">Bolivien, Plurinationaler Staat</option>'+
            '<option value="BQ">Bonaire, Sint Eustatius und Saba</option>'+
            '<option value="BA">Bosnien und Herzegowina</option>'+
            '<option value="BW">Botswana</option>'+
            '<option value="BV">Bouvetinsel</option>'+
            '<option value="BR">Brasilien</option>'+
            '<option value="IO">Britisches Territorium im Indischen Ozean</option>'+
            '<option value="BN">Brunei Darussalam</option>'+
            '<option value="BG">Bulgarien</option>'+
            '<option value="BF">Burkina Faso</option>'+
            '<option value="BI">Burundi</option>'+
            '<option value="KH">Kambodscha</option>'+
            '<option value="CM">Kamerun</option>'+
            '<option value="CA">Kanada</option>'+
            '<option value="CV">Kap Verde</option>'+
            '<option value="KY">Cayman-Inseln</option>'+
            '<option value="CF">Zentralafrikanische Republik</option>'+
            '<option value="TD">Tschad</option>'+
            '<option value="CL">Chile</option>'+
            '<option value="CN">China</option>'+
            '<option value="CX">Weihnachtsinsel</option>'+
            '<option value="CC">Cocos (Keeling) Inseln</option>'+
            '<option value="CO">Kolumbien</option>'+
            '<option value="KM">Komoren</option>'+
            '<option value="CG">Kongo</option>'+
            '<option value="CD">Kongo, die Demokratische Republik</option>'+
            '<option value="CK">Cook-Inseln</option>'+
            '<option value="CR">Costa Rica</option>'+
            '<option value="CI">Côte d\'Ivoire</option>'+
            '<option value="HR">Kroatien</option>'+
            '<option value="CU">Kuba</option>'+
            '<option value="CW">Curaçao</option>'+
            '<option value="CY">Zypern</option>'+
            '<option value="CZ">Tschechische Republik</option>'+
            '<option value="DK">Dänemark</option>'+
            '<option value="DJ">Dschibuti</option>'+
            '<option value="DM">Dominica</option>'+
            '<option value="DO">Dominikanische Republik</option>'+
            '<option value="EC">Ecuador</option>'+
            '<option value="EG">Ägypten</option>'+
            '<option value="SV">El Salvador</option>'+
            '<option value="GQ">Äquatorial-Guinea</option>'+
            '<option value="ER">Eritrea</option>'+
            '<option value="EE">Estland</option>'+
            '<option value="ET">Äthiopien</option>'+
            '<option value="FK">Falklandinseln (Malwinen)</option>'+
            '<option value="FO">Färöer Inseln</option>'+
            '<option value="FJ">Fidschi</option>'+
            '<option value="FI">Finnland</option>'+
            '<option value="FR">Frankreich</option>'+
            '<option value="GF">Französisch-Guayana</option>'+
            '<option value="PF">Französisch-Polynesien</option>'+
            '<option value="TF">Französische Süd-Territorien</option>'+
            '<option value="GA">Gabun</option>'+
            '<option value="GM">Gambia</option>'+
            '<option value="GE">Georgien</option>'+

            '<option value="GH">Ghana</option>'+
            '<option value="GI">Gibraltar</option>'+
            '<option value="GR">Griechenland</option>'+
            '<option value="GL">Grönland</option>'+
            '<option value="GD">Grenada</option>'+
            '<option value="GP">Guadeloupe</option>'+
            '<option value="GU">Guam</option>'+
            '<option value="GT">Guatemala</option>'+
            '<option value="GG">Guernsey</option>'+
            '<option value="GN">Guinea</option>'+
            '<option value="GW">Guinea-Bissau</option>'+
            '<option value="GY">Guyana</option>'+
            '<option value="HT">Haiti</option>'+
            '<option value="HM">Heard-Insel und McDonald-Inseln</option>'+
            '<option value="VA">Heiliger Stuhl (Staat Vatikanstadt)</option>'+
            '<option value="HN">Honduras</option>'+
            '<option value="HK">Hongkong</option>'+
            '<option value="HU">Ungarn</option>'+
            '<option value="IS">Island</option>'+
            '<option value="IN">Indien</option>'+
            '<option value="ID">Indonesien</option>'+
            '<option value="IR">Iran, Islamische Republik</option>'+
            '<option value="IQ">Irak</option>'+
            '<option value="IE">Irland</option>'+
            '<option value="IM">Isle of Man</option>'+
            '<option value="IL">Israel</option>'+
            '<option value="IT">Italien</option>'+
            '<option value="JM">Jamaika</option>'+
            '<option value="JP">Japan</option>'+
            '<option value="JE">Jersey</option>'+
            '<option value="JO">Jordanien</option>'+
            '<option value="KZ">Kasachstan</option>'+
            '<option value="KE">Kenia</option>'+
            '<option value="KI">Kiribati</option>'+
            '<option value="KP">Korea, Demokratische Volksrepublik</option>'+
            '<option value="KR">Korea, Republik</option>'+
            '<option value="KW">Kuwait</option>'+
            '<option value="KG">Kirgisistan</option>'+
            '<option value="LA">Demokratische Volksrepublik Laos</option>'+
            '<option value="LV">Lettland</option>'+
            '<option value="LB">Libanon</option>'+
            '<option value="LS">Lesotho</option>'+
            '<option value="LR">Liberia</option>'+
            '<option value="LY">Libyen</option>'+
            '<option value="LI">Liechtenstein</option>'+
            '<option value="LT">Litauen</option>'+
            '<option value="LU">Luxemburg</option>'+
            '<option value="MO">Macao</option>'+
            '<option value="MK">Mazedonien, die ehemalige jugoslawische Republik</option>'+
            '<option value="MG">Madagaskar</option>'+
            '<option value="MW">Malawi</option>'+
            '<option value="MY">Malaysia</option>'+
            '<option value="MV">Malediven</option>'+
            '<option value="ML">Mali</option>'+
            '<option value="MT">Malta</option>'+
            '<option value="MH">Marshall-Inseln</option>'+
            '<option value="MQ">Martinique</option>'+
            '<option value="MR">Mauretanien</option>'+
            '<option value="MU">Mauritius</option>'+
            '<option value="YT">Mayotte</option>'+
            '<option value="MX">Mexiko</option>'+
            '<option value="FM">Mikronesien, Föderierte Staaten von</option>'+
            '<option value="MD">Moldawien, Republik</option>'+
            '<option value="MC">Monaco</option>'+
            '<option value="MN">Mongolei</option>'+
            '<option value="ME">Montenegro</option>'+
            '<option value="MS">Montserrat</option>'+
            '<option value="MA">Marokko</option>'+
            '<option value="MZ">Mosambik</option>'+
            '<option value="MM">Myanmar</option>'+
            '<option value="NA">Namibia</option>'+
            '<option value="NR">Nauru</option>'+
            '<option value="NP">Nepal</option>'+
            '<option value="NL">Niederlande</option>'+
            '<option value="NC">Neukaledonien</option>'+
            '<option value="NZ">Neu Seeland</option>'+
            '<option value="NI">Nicaragua</option>'+
            '<option value="NE">Niger</option>'+
            '<option value="NG">Nigeria</option>'+
            '<option value="NU">Niue</option>'+
            '<option value="NF">Norfolkinsel</option>'+
            '<option value="MP">Nördliche Marianen</option>'+
            '<option value="NO">Norwegen</option>'+
            '<option value="OM">Oman</option>'+
            '<option value="PK">Pakistan</option>'+
            '<option value="PW">Palau</option>'+
            '<option value="PS">Palästinensisches Territorium, Besetzt</option>'+
            '<option value="PA">Panama</option>'+
            '<option value="PG">Papua-Neuguinea</option>'+
            '<option value="PY">Paraguay</option>'+
            '<option value="PE">Peru</option>'+
            '<option value="PH">Philippinen</option>'+
            '<option value="PN">Pitcairn</option>'+
            '<option value="PL">Polen</option>'+
            '<option value="PT">Portugal</option>'+
            '<option value="PR">Puerto Rico</option>'+
            '<option value="QA">Katar</option>'+
            '<option value="RE">Réunion</option>'+
            '<option value="RO">Rumänien</option>'+
            '<option value="RU">Russische Föderation</option>'+
            '<option value="RW">Ruanda</option>'+
            '<option value="BL">St. Barthélemy</option>'+
            '<option value="SH">St. Helena, Ascension und Tristan da Cunha</option>'+
            '<option value="KN">St. Kitts und Nevis</option>'+
            '<option value="LC">St. Lucia</option>'+
            '<option value="MF">St. Martin (französischer Teil)</option>'+
            '<option value="PM">St. Pierre und Miquelon</option>'+
            '<option value="VC">St. Vincent und die Grenadinen</option>'+
            '<option value="WS">Samoa</option>'+
            '<option value="SM">San Marino</option>'+
            '<option value="ST">Sao Tome und Principe</option>'+
            '<option value="SA">Saudi-Arabien</option>'+
            '<option value="SN">Senegal</option>'+
            '<option value="RS">Serbien</option>'+
            '<option value="SC">Seychellen</option>'+
            '<option value="SL">Sierra Leone</option>'+
            '<option value="SG">Singapur</option>'+
            '<option value="SX">Sint Maarten (Niederländischer Teil)</option>'+
            '<option value="SK">Slowakei</option>'+
            '<option value="SI">Slowenien</option>'+
            '<option value="SB">Salomon-Inseln</option>'+
            '<option value="SO">Somalia</option>'+
            '<option value="ZA">Südafrika</option>'+
            '<option value="GS">Südgeorgien und die Südlichen Sandwichinseln</option>'+
            '<option value="SS">Südsudan</option>'+
            '<option value="ES">Spanien</option>'+
            '<option value="LK">Sri Lanka</option>'+
            '<option value="SD">Sudan</option>'+
            '<option value="SR">Suriname</option>'+
            '<option value="SJ">Svalbard und Jan Mayen</option>'+
            '<option value="SZ">Swasiland</option>'+
            '<option value="SE">Schweden</option>'+
            '<option value="CH">Schweiz</option>'+
            '<option value="SY">Syrien, Arabische Republik</option>'+
            '<option value="TW">Taiwan, Provinz China</option>'+
            '<option value="TJ">Tadschikistan</option>'+
            '<option value="TZ">Tansania, Vereinigte Republik</option>'+
            '<option value="TH">Thailand</option>'+
            '<option value="TL">Timor-Leste</option>'+
            '<option value="TG">Togo</option>'+
            '<option value="TK">Tokelau</option>'+
            '<option value="TO">Tonga</option>'+
            '<option value="TT">Trinidad und Tobago</option>'+
            '<option value="TN">Tunesien</option>'+
            '<option value="TR">Türkei</option>'+
            '<option value="TM">Turkmenistan</option>'+
            '<option value="TC">Turks- und Caicosinseln</option>'+
            '<option value="TV">Tuvalu</option>'+
            '<option value="UG">Uganda</option>'+
            '<option value="UA">Ukraine</option>'+
            '<option value="AE">Vereinigte Arabische Emirate</option>'+
            '<option value="GB">Vereinigtes Königreich</option>' +
            '<option value="US">Vereinigte Staaten</option>'+
            '<option value="UM">Vereinigte Staaten Minor Outlying Islands</option>'+
            '<option value="UY">Uruguay</option>'+
            '<option value="UZ">Usbekistan</option>'+
            '<option value="VU">Vanuatu</option>'+
            '<option value="VE">Venezuela, Bolivarische Republik</option>'+
            '<option value="VN">Viet Nam</option>'+
            '<option value="VG">Jungferninseln, Britische</option>'+
            '<option value="VI">Jungferninseln, U.S.</option>'+
            '<option value="WF">Wallis und Futuna</option>'+
            '<option value="EH">Westsahara</option>'+
            '<option value="YE">Jemen</option>'+
            '<option value="ZM">Sambia</option>'+
            '<option value="ZW">Simbabwe</option>'
        ;
        $('li').removeClass('active');
        $('#tab_'+(4)).addClass('active');
        $('#step_'+3).addClass('hidden');
        $('#step_'+(4)).removeClass('hidden');

        if($('#business_type').val()=='organisation')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Name der Organisation" required>\n' +
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="Umsatzsteuer (falls vorhanden)">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Hauptsitz der Organisation - Hausnummer/Gebäudenummer" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Hauptsitz der Organisation - Straße/Straße" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Organisation Hauptsitz - Stadt/Ort" required>\n' +
                '        <input type="hidden" value="DE" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Organisation Hauptsitz - Land" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="DE">Deutschland</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Hauptsitz der Organisation - Postleitzahl" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Gesetzliche Vertreter - Vorname" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Gesetzliche Vertreter - Nachname" required>\n' +
                '<label>Gesetzliche Vertreter - Geburtsdatum</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Monat</option>\n' +
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
                '                                <option value="">Tag</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Jahr</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Gesetzliche Vertreter - Land" required>\n' +
                '<option value="">Gesetzliche Vertreter - Land</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Gesetzliche Vertreter - Nationalität" required>\n' +
                '<option value="">Gesetzliche Vertreter - Nationalität</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Postanschrift - Hausnummer/Gebäudenummer" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Postanschrift - Straße/Straße" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Postanschrift - Ortschaft/Stadt" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Postanschrift - Postleitzahl" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="Website-URL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Muss mit \'www\' beginnen und darf keine Leerzeichen enthalten.\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="Vorname" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Nachname" required>\n' +
                '<label>Geburtsdatum</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Monat</option>\n' +
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
                '                                <option value="">Tag</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Jahr</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="DE" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="Land" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="DE">Deutschland</option>' +
                '</select>' +
                '<select class="form-control" name="lrd_nationality" placeholder="Nationalität" required>\n' +
                '<option value="">Nationalität</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="Name des Unternehmens" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="Umsatzsteuer (falls vorhanden)">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Hausnummer/Gebäudenummer" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Straße/Straße" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Stadt/Ort" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Postleitzahl" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="Website-URL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Muss mit \'www\' beginnen und darf keine Leerzeichen enthalten.\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Name der Firma" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="Firmennummer" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   Muss mindestens eine 1-stellige britische Firmennummer sein.\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Firmensitz - Hausnummer/Gebäudenummer" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Firmensitz - Straße/Straße" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Firmenhauptsitz - Stadt/Ort" required>\n' +
                '        <input type="hidden" value="DE" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Firmenhauptsitz - Land" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="DE">Deutschland</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Firmenhauptsitz - Postleitzahl" required>'+
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="Umsatzsteuer (falls vorhanden)">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Direktor - Vorname" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Direktor - Nachname" required>\n' +
                '<label>Direktor - Geburtsdatum</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Monat</option>\n' +
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
                '                                <option value="">Tag</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Jahr</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Direktor - Land" required>\n' +
                '<option value="">Direktor - Land</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="Direktor - Nationalität" required>\n' +
                '<option value="">Direktor - Nationalität</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Postanschrift - Haus-/Gebäudenummer" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Postanschrift - Straße/Straße" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Postanschrift - Stadt/Ort" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Postanschrift - Postleitzahl" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="Website-URL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Muss mit \'www\' beginnen und darf keine Leerzeichen enthalten.\n'+
                '</small>\n');
        }
        if($('#user_type').val()=='citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="Vorname" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="Nachname" required>\n' +
                '                    <label>Geburtsdatum</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Monat</option>\n' +
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
                '                                <option value="">Tag</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">Jahr</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="DE" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="Land" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="DE">Deutschland</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="Nationalität" required>\n' +
                '<option value="">Nationalität</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="Haus/Gebäudenummer" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="Straße/Straße" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="Stadt/Ort" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="Postleitzahl" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
