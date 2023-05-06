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

.loginPage {
  position: relative;
}

label.error {
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
              <span class="m-t-25">Créer un compte en cours <br> Veuillez patienter.</span>
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

                    <strong>Attention !</strong><span id="alert_text"> Veuillez remplir tous les champs obligatoires.</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2>{{__('INSCRIVEZ-VOUS MAINTENANT')}} <br><span>(ÉTAPE 1 DE 4)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">À quel pays souhaitez-vous accéder ?</option>
                        @foreach($country as $c)
                            @if($c->country_code == 'ru')
                                @continue;
                            @endif
                        <option value="{{$c->country_code}}">{{$c->country_name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> Quel type de compte souhaitez-vous ?</option>
                        <option value="business"> Un pour les entreprises (ajouter et rechercher des enregistrements)</option>
                        <option value="advisors"> Un pour les Recruteurs/développeurs/conseillers/écrivains</option>
                        <option value="hris"> Un pour les fournisseurs de logiciels SIRH/ATS/VMS</option>
                        <option value="citizen"> Un pour moi afin que je puisse trouver mes enregistrements personnels</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="a" checked  value="software">
                            <label class="d-inline" for="a" > Nous fournissons uniquement des logiciels SIRH </label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="b" value="tracking">
                            <label class="d-inline" for="b"> Nous fournissons uniquement des logiciels ATS ou VMS</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="c" value="both">
                            <label class="d-inline" for="c"> Nous fournissons une combinaison des éléments ci-dessus</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label class="d-inline" for="aa" > Nous développons des systèmes/logiciels d'entreprise</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label class="d-inline" for="bb"> Nous fournissons des services de RH</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="cc" value="writer">
                            <label class="d-inline" for="cc"> Nous fournissons des services de recrutement</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>INSCRIVEZ-VOUS MAINTENANT <br><span>(Étape 2 de 4)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">Quel type d'entreprise êtes-vous ?</option>
                        <option value="company"> Entreprise</option>
                        <option value="organisation"> Organisation</option>
                        <option value="selfemployed">Travailleur indépendant</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">Quel est votre marché ?</option>
                        @foreach($market as $m)
                        <option value="{{$m->market_value}}">{{$m->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">Combien d'employés avez-vous ?</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>INSCRIVEZ-VOUS MAINTENANT <br><span>(Étape 3 de 4)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Saisissez votre adresse électronique" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">Vous ne pouvez pas utiliser une adresse électronique gratuite.
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="Choisissez un mot de passe" id="password" required>
                    <label class="note">Les mots de passe doivent comporter au moins 8 caractères</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Retapez le mot de passe" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="Code de référence (si quelqu'un vous en a donné un)" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>INSCRIVEZ-VOUS MAINTENANT <br><span>(Étape finale)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="Prénom" required>
                        <input type="text" class="form-control" name="lastname" placeholder="Nom de famille" required>
                        <label>Date de naissance</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">Mois</option>
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
                                    <option value="">Jour</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">Année</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="Pays" required>
                        <input type="text" class="form-control" name="nationality" placeholder="Nationalité" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="Numéro de la maison/ du bâtiment" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="Rue" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Ville" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="Code Postal" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality">
                        <label for="confidentiality">Accord de confidentialité</label>
                        <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">Voir ici</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms">
                        <label for="terms"> Conditions générales d’utilisation</label>
                        <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">Voir ici</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy">
                        <label for="privacy">Politique de confidentialité </label>
                        <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">Voir ici</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">Aller à</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
                    $('#business_type').append('<option value="">Quel type d\'entreprise êtes-vous ?</option>\n' +
                        '                        <option value="company"> Entreprise</option>\n' +
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
                        },
                        success: function (result) {
                            if (result.status == false) {
                                $('#alert').addClass('hidden');
                                if (check_password())
                                    check_referral_code();
                            } else if(result.status == true) {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Cet email existe déjà !');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Au lieu de créer manuellement ce compte, veuillez vous connecter à votre compte existant et activer l\'"accès par pays" afin que tous vos comptes soient liés.');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('Saisissez un e-mail valide !');
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

                    if (!/^([A-Za-z0-9]{9})$/.test(company_no)) {
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
        if (!/^([A-Za-z0-9]{9})$/.test(company_no)) {
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
                $('#alert_text').html('Saisissez un mot de passe de confirmation valide!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('Les mots de passe doivent comporter au moins 8 caractères');
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
                        $('#alert_text').html('Code de référence invalide !');
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
        var countries = '<option value="FR">France</option>'+
            '<option value="AF">Afghanistan</option>'+
            '<option value="AX">AX Îles Åland</option>'+
            '<option value="AL">Albanie</option>'+
            '<option value="DZ">Algérie</option>'+
            '<option value="AS">Samoa américaines</option>'+
            '<option value="AD">Andorre</option>'+
            '<option value="AO">Angola</option>'+
            '<option value="AI">Anguille</option>'+
            '<option value="AQ">Antarctique</option>'+
            '<option value="AG">Antigua et Barbuda</option>'+
            '<option value="AR">Argentine</option>'+
            '<option value="AM">Arménie</option>'+
            '<option value="AW">Aruba</option>'+
            '<option value="AU">Australie</option>'+
            '<option value="AT">Autriche</option>'+
            '<option value="AZ">Azerbaïdjan</option>'+
            '<option value="BS">Bahamas</option>'+
            '<option value="BH">Bahreïn</option>'+
            '<option value="BD">Bangladesh</option>'+
            '<option value="BB">Barbade</option>'+
            '<option value="BY">Bélarusse</option>'+
            '<option value="BE">Belgique</option>'+
            '<option value="BZ">Belize</option>'+
            '<option value="BJ">Bénin</option>'+
            '<option value="BM">Bermudes</option>'+
            '<option value="BT">Bhoutan</option>'+
            '<option value="BO">Bolivie, État plurinational de</option>'+
            '<option value="BQ">Bonaire, Sint Eustatius et Saba</option>'+
            '<option value="BA">Bosnie et Herzégovine</option>'+
            '<option value="BW">Botswana</option>'+
            '<option value="BV">Bouvet, île</option>'+
            '<option value="BR">Brésil</option>'+
            '<option value="IO">Territoire britannique de l\'océan Indien</option>'+
            '<option value="BN">Brunei Darussalam</option>'+
            '<option value="BG">Bulgarie</option>'+
            '<option value="BF">Burkina Faso</option>'+
            '<option value="BI">Burundi</option>'+
            '<option value="KH">Cambodge</option>'+
            '<option value="CM">Cameroun</option>'+
            '<option value="CA">Canada</option>'+
            '<option value="CV">Cap-Vert</option>'+
            '<option value="KY">Îles Caïmans</option>'+
            '<option value="CF">République centrafricaine</option>'+
            '<option value="TD">Tchad</option>'+
            '<option value="CL">Chili</option>'+
            '<option value="CN">Chine</option>'+
            '<option value="CX">Île de Noël</option>'+
            '<option value="CC">Îles Cocos (Keeling)</option>'+
            '<option value="CO">Colombie</option>'+
            '<option value="KM">Comores</option>'+
            '<option value="CG">Congo</option>'+
            '<option value="CD">La République démocratique du Congo</option>'+
            '<option value="CK">Cook (îles)</option>'+
            '<option value="CR">Costa Rica</option>'+
            '<option value="CI">Côte d\'Ivoire</option>'+
            '<option value="HR">Croatie</option>'+
            '<option value="CU">Cuba</option>'+
            '<option value="CW">Curaçao</option>'+
            '<option value="CY">Chypre</option>'+
            '<option value="CZ">République Tchèque</option>'+
            '<option value="DK">Danemark</option>'+
            '<option value="DJ">Djibouti</option>'+
            '<option value="DM">Dominique</option>'+
            '<option value="DO">République dominicaine</option>'+
            '<option value="EC">Équateur</option>'+
            '<option value="EG">Égypte</option>'+
            '<option value="SV">El Salvador</option>'+
            '<option value="GQ">Guinée équatoriale</option>'+
            '<option value="ER">Érythrée</option>'+
            '<option value="EE">Estonie</option>'+
            '<option value="ET">Éthiopie</option>'+
            '<option value="FK">Îles Falkland (Malvinas)</option>'+
            '<option value="FO">Îles Faroe</option>'+
            '<option value="FJ">Fidji</option>'+
            '<option value="FI">Finlande</option>'+

            '<option value="GF">Guyane française</option>'+
            '<option value="PF">Polynésie française</option>'+
            '<option value="TF">Terres australes françaises</option>'+
            '<option value="GA">Gabon</option>'+
            '<option value="GM">Gambie</option>'+
            '<option value="GE">Géorgie</option>'+
            '<option value="DE">Allemagne</option>'+
            '<option value="GH">Ghana</option>'+
            '<option value="GI">Gibraltar</option>'+
            '<option value="GR">Grèce</option>'+
            '<option value="GL">Groenland</option>'+
            '<option value="GD">Grenada</option>'+
            '<option value="GP">Guadeloupe</option>'+
            '<option value="GU">Guam</option>'+
            '<option value="GT">Guatemala</option>'+
            '<option value="GG">Guernsey</option>'+
            '<option value="GN">Guinée</option>'+
            '<option value="GW">Guinée-Bissau</option>'+
            '<option value="GY">Guyane</option>'+
            '<option value="HT">Haïti</option>'+
            '<option value="HM">Île Heard et îles McDonald</option>'+
            '<option value="VA">Saint-Siège (État de la Cité du Vatican)</option>'+
            '<option value="HN">Honduras</option>'+
            '<option value="HK">Hong Kong</option>'+
            '<option value="HU">Hongrie</option>'+
            '<option value="IS">Islande</option>'+
            '<option value="IN">Inde</option>'+
            '<option value="ID">Indonésie</option>'+
            '<option value="IR">République islamique d’Iran</option>'+
            '<option value="IQ">Irak</option>'+
            '<option value="IE">Irlande</option>'+
            '<option value="IM">Île de Man</option>'+
            '<option value="IL">Israël</option>'+
            '<option value="IT">Italie</option>'+
            '<option value="JM">Jamaïque</option>'+
            '<option value="JP">Japon</option>'+
            '<option value="JE">Jersey</option>'+
            '<option value="JO">Jordanie</option>'+
            '<option value="KZ">Kazakhstan</option>'+
            '<option value="KE">Kenya</option>'+
            '<option value="KI">Kiribati</option>'+
            '<option value="KP">République populaire démocratique de Corée</option>'+
            '<option value="KR">Corée</option>'+
            '<option value="KW">Koweït</option>'+
            '<option value="KG">Kirghizistan</option>'+
            '<option value="LA">République démocratique populaire Lao</option>'+
            '<option value="LV">Lettonie</option>'+
            '<option value="LB">Liban</option>'+
            '<option value="LS">Lesotho</option>'+
            '<option value="LR">Libéria</option>'+
            '<option value="LY">Libye</option>'+
            '<option value="LI">Liechtenstein</option>'+
            '<option value="LT">Lituanie</option>'+
            '<option value="LU">Luxembourg</option>'+
            '<option value="MO">Macao</option>'+
            '<option value="MK">Ancienne République yougoslave de Macédoine</option>'+
            '<option value="MG">Madagascar</option>'+
            '<option value="MW">Malawi</option>'+
            '<option value="MY">Malaisie</option>'+
            '<option value="MV">Maldives</option>'+
            '<option value="ML">Mali</option>'+
            '<option value="MT">Malte</option>'+
            '<option value="MH">Marshall (îles)</option>'+
            '<option value="MQ">Martinique</option>'+
            '<option value="MR">Mauritanie</option>'+
            '<option value="MU">Île Maurice</option>'+
            '<option value="YT">Mayotte</option>'+
            '<option value="MX">Mexique</option>'+
            '<option value="FM">Micronésie, États fédérés de</option>'+
            '<option value="MD">République de Moldavie</option>'+
            '<option value="MC">Monaco</option>'+
            '<option value="MN">Mongolie</option>'+
            '<option value="ME">Monténégro</option>'+
            '<option value="MS">Montserrat</option>'+
            '<option value="MA">Maroc</option>'+
            '<option value="MZ">Mozambique</option>'+
            '<option value="MM">Myanmar</option>'+
            '<option value="NA">Namibie</option>'+
            '<option value="NR">Nauru</option>'+
            '<option value="NP">Népal</option>'+
            '<option value="NL">Pays-Bas</option>'+
            '<option value="NC">Nouvelle-Calédonie</option>'+
            '<option value="NZ">Nouvelle-Zélande</option>'+
            '<option value="NI">Nicaragua</option>'+
            '<option value="NE">Niger</option>'+
            '<option value="NG">Nigéria</option>'+
            '<option value="NU">Niue</option>'+
            '<option value="NF">Norfolk (île)</option>'+
            '<option value="MP">Mariannes du Nord (îles)</option>'+
            '<option value="NO">Norvège</option>'+
            '<option value="OM">Oman</option>'+
            '<option value="PK">Pakistan</option>'+
            '<option value="PW">Palau</option>'+
            '<option value="PS">Territoire palestinien, occupé</option>'+
            '<option value="PA">Panama</option>'+
            '<option value="PG">Papouasie-Nouvelle-Guinée</option>'+
            '<option value="PY">Paraguay</option>'+
            '<option value="PE">Pérou</option>'+
            '<option value="PH">Philippines</option>'+
            '<option value="PN">Pitcairn</option>'+
            '<option value="PL">Pologne</option>'+
            '<option value="PT">Portugal</option>'+
            '<option value="PR">Porto Rico</option>'+
            '<option value="QA">Qatar</option>'+
            '<option value="RE">Réunion</option>'+
            '<option value="RO">Roumanie</option>'+
            '<option value="RU">Fédération de Russie</option>'+
            '<option value="RW">Rwanda</option>'+
            '<option value="BL">Saint Barthélemy</option>'+
            '<option value="SH">Sainte Hélène, Ascension et Tristan da Cunha</option>'+
            '<option value="KN">Saint-Kitts-et-Nevis</option>'+
            '<option value="LC">Sainte-Lucie</option>'+
            '<option value="MF">Saint Martin (partie française)</option>'+
            '<option value="PM">Saint Pierre et Miquelon</option>'+
            '<option value="VC">Saint Vincent et les Grenadines</option>'+
            '<option value="WS">Samoa</option>'+
            '<option value="SM">Saint-Marin</option>'+
            '<option value="ST">Sao Tomé et Principe</option>'+
            '<option value="SA">Arabie Saoudite</option>'+
            '<option value="SN">Sénégal</option>'+
            '<option value="RS">Serbie</option>'+
            '<option value="SC">Seychelles</option>'+
            '<option value="SL">Sierra Leone</option>'+
            '<option value="SG">Singapour</option>'+
            '<option value="SX">Sint Maarten (partie néerlandaise)</option>'+
            '<option value="SK">Slovaquie</option>'+
            '<option value="SI">Slovénie</option>'+
            '<option value="SB">Salomon (îles)</option>'+
            '<option value="SO">Somalie</option>'+
            '<option value="ZA">Afrique du Sud</option>'+
            '<option value="GS">Géorgie du Sud et les îles Sandwich du Sud</option>'+
            '<option value="SS">Sud-Soudan</option>'+
            '<option value="ES">Espagne</option>'+
            '<option value="LK">Sri Lanka</option>'+
            '<option value="SD">Soudan</option>'+
            '<option value="SR">Suriname</option>'+
            '<option value="SJ">Svalbard et Jan Mayen</option>'+
            '<option value="SZ">Swaziland</option>'+
            '<option value="SE">Suède</option>'+
            '<option value="CH">Suisse</option>'+
            '<option value="SY">République arabe syrienne</option>'+
            '<option value="TW">Taiwan, Province de Chine</option>'+
            '<option value="TJ">Tajikistan</option>'+
            '<option value="TZ">République-Unie de Tanzanie</option>'+
            '<option value="TH">Thaïlande</option>'+
            '<option value="TL">Timor-Leste</option>'+
            '<option value="TG">Togo</option>'+
            '<option value="TK">Tokelau</option>'+
            '<option value="TO">Tonga</option>'+
            '<option value="TT">Trinité-et-Tobago</option>'+
            '<option value="TN">Tunisie</option>'+
            '<option value="TR">Turquie</option>'+
            '<option value="TM">Turkménistan</option>'+
            '<option value="TC">Îles Turks et Caicos</option>'+
            '<option value="TV">Tuvalu</option>'+
            '<option value="UG">Ouganda</option>'+
            '<option value="UA">Ukraine</option>'+
            '<option value="AE">Émirats arabes unis</option>'+
            '<option value="GB">Royaume-Uni</option>' +
            '<option value="US">États-Unis</option>'+
            '<option value="UM">Îles Mineures Périphériques des États-Unis</option>'+
            '<option value="UY">Uruguay</option>'+
            '<option value="UZ">Ouzbékistan</option>'+
            '<option value="VU">Vanuatu</option>'+
            '<option value="VE">République bolivarienne du Venezuela</option>'+
            '<option value="VN">Viêt Nam</option>'+
            '<option value="VG">Iles vierges, britanniques</option>'+
            '<option value="VI">Îles Vierges, États-Unis</option>'+
            '<option value="WF">Wallis et Futuna</option>'+
            '<option value="EH">Sahara occidental</option>'+
            '<option value="YE">Yémen</option>'+
            '<option value="ZM">Zambie</option>'+
            '<option value="ZW">Zimbabwe</option>'
        ;
        $('li').removeClass('active');
        $('#tab_'+(4)).addClass('active');
        $('#step_'+3).addClass('hidden');
        $('#step_'+(4)).removeClass('hidden');

        if($('#business_type').val()=='organisation')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Nom de l\'organisation" required>\n' +
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="TVA (si applicable)">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Siège de l\'organisation - Numéro de maison/bâtiment" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Siège de l\'organisation - Rue" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Siège de l\'organisation - Ville" required>\n' +
                '        <input type="hidden" value="FR" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Siège de l\'organisation - Pays" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="FR">France</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Siège de l\'organisation - Code postal" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Représentants légaux - Prénom" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Représentants légaux - Nom de famille" required>\n' +
                '<label>Représentants légaux - Date de naissance</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mois</option>\n' +
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
                '                                <option value="">Jour</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Année</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Représentants légaux - Pays" required>\n' +
                '<option value="">Représentants légaux - Pays</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Représentants légaux - Nationalité" required>\n' +
                '<option value="">Représentants légaux - Nationalité</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Adresse postale - Numéro de maison/bâtiment" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Adresse postale - Rue" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Adresse postale - Ville" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Adresse postale - Code postal" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL du site web" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Doit commencer par "www" et sans espace.\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="Prénom" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Nom de famille" required>\n' +
                '<label>Date de naissance</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mois</option>\n' +
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
                '                                <option value="">Jour</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Année</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="FR" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="Pays" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="FR">France</option>' +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Nationalité" required>\n' +
                '<option value="">Nationalité</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="Nom de l\'entreprise" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="TVA (si applicable)">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Numéro de la maison/du bâtiment" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Rue" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Ville" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Code Postal" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL du site web" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Doit commencer par "www" et sans espace.\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Nom de l\'entreprise" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="Numéro d\'entreprise" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   Le numéro de l\'entreprise doit comporter au moins 9 chiffres au France.\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Siège de l\'entreprise - Numéro de maison/bâtiment" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Siège de l\'entreprise - Rue" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Siège de l\'entreprise - Ville" required>\n' +
                '        <input type="hidden" value="FR" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Siège de l\'entreprise - Pays" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="FR">France</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Siège de l\'entreprise – Code Postal" required>'+
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="TVA (si applicable)">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Directeur - Prénom" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Directeur - Nom de famille" required>\n' +
                '<label>Directeur - Date de naissance</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mois</option>\n' +
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
                '                                <option value="">Jour</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Année</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Directeur - Pays" required>\n' +
                '<option value="">Directeur - Pays</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="Directeur - Nationalité" required>\n' +
                '<option value="">Directeur - Nationalité</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Adresse postale - Numéro de maison/immeuble" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Adresse postale - Rue" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Adresse postale - Ville" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Adresse postale – Code Postal" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL du site web" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Doit commencer par "www" et sans espace.\n'+
                '</small>\n');
        }
        if($('#user_type').val()=='citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="Prénom" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="Nom de famille" required>\n' +
                '                    <label>Date de naissance</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mois</option>\n' +
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
                '                                <option value="">Jour</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">Année</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="FR" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="Pays" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="FR">France</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="Nationalité" required>\n' +
                '<option value="">Nationalité</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="Numéro de la maison/ du bâtiment" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="Rue" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="Ville" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="Code Postal" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
