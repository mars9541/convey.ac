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

input.error, select.error {
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
              <span class="m-t-25">Идет создание учетной записи <br> Пожалуйста, подождите.</span>
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

                    <strong>Предупреждение!</strong><span id="alert_text"> Пожалуйста, заполните все необходимые данные.</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2>{{__('РЕГИСТРАЦИЯ')}} <span>(ШАГ 1 ИЗ 4)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">В какой стране вы хотите получить доступ к системе?</option>
                        @foreach($country as $c)
                            @if($c->country_code == 'ru')
                                @continue;
                            @endif

                            <option value="{{$c->country_code}}">{{$c->country_name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> Какой тип учетной записи вам нужен?</option>
                        <option value="business"> Для бизнеса (добавление и поиск записей)</option>
                        <option value="advisors"> Для консультантов/разработчиков/советников/авторов</option>
                        <option value="hris"> Для разработчиков программного обеспечения HRIS/ATS/VMS</option>
                        <option value="citizen"> Для себя, чтобы следить за собственными достижениями</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="a" checked  value="software">
                            <label class="d-inline" for="a" > Мы предоставляем только программное обеспечение HRIS </label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="b" value="tracking">
                            <label class="d-inline" for="b"> Мы предоставляем только программное обеспечение ATS или VMS</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="hris_type"  id="c" value="both">
                            <label class="d-inline" for="c"> Мы предлагаем сочетание вышеперечисленного</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label class="d-inline" for="aa" > Мы разрабатываем бизнес-системы/программное обеспечение</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label class="d-inline" for="bb"> Мы проводим бизнес-консультации</label>
                        </div>
                        <div class="d-inline-block">
                            <input class="d-inline" type="radio" name="advisors_type"  id="cc" value="writer">
                            <label class="d-inline" for="cc"> Мы пишем статьи о бизнесе</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>РЕГИСТРАЦИЯ <span>(ШАГ 2 ИЗ 4)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">Каков тип вашего бизнеса?</option>
                        <option value="company"> Компания</option>
                        <option value="organisation"> Организация</option>
                        <option value="selfemployed">Частный предприниматель</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">В какой сфере вы работаете?</option>
                        @foreach($market as $m)
                        <option value="{{$m->market_value}}">{{$m->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">Сколько у вас сотрудников?</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>РЕГИСТРАЦИЯ <span>(ШАГ 3 ИЗ 4)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите ваш адрес электронной почты" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">Вы не можете использовать бесплатный адрес электронной почты.
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="Придумайте пароль" id="password" required>
                    <label class="note">Пароль должен состоять из 8 или более символов.</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Введите пароль еще раз" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="Реферальный код (если кто-то передал вам его)" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>Регистрация <span>(последний шаг)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="Имя" required>
                        <input type="text" class="form-control" name="lastname" placeholder="Фамилия" required>
                        <label>Дата рождения</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">Месяц</option>
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
                                    <option value="">День</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">Год</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="Страна" required>
                        <input type="text" class="form-control" name="nationality" placeholder="Гражданство" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="Номер дома/строения" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="Улица/дорога" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Город" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="Индекс" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality">
                        <label for="confidentiality">Соглашение о конфиденциальности</label>
                        <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">Посмотреть здесь</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms">
                        <label for="terms"> Правила и условия</label>
                        <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">Посмотреть здесь</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy">
                        <label for="privacy">Соглашение о конфиденциальности</label>
                        <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">Посмотреть здесь</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">Продолжить</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
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
                    $('#business_type').append('<option value="">Каков тип вашего бизнеса?</option>\n' +
                        '                        <option value="company"> Компания</option>\n' +
                        '                        <option value="organisation"> Организация</option>');
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
                                $('#alert_text').html('Этот адрес электронной почты уже существует!');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Вместо того, чтобы вручную создавать эту учетную запись, пожалуйста, войдите в существующую учетную запись и активируйте "доступ к стране", чтобы все ваши учетные записи были связаны.');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('Введите корректный адрес электронной почты!');
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

                    if (!/^([A-Za-z0-9]{10})$/.test(company_no)) {
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
        if (!/^([A-Za-z0-9]{10})$/.test(company_no)) {
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
                $('#alert_text').html('Введите корректный пароль!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('Пароль должен состоять из 8 или более символов.');
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
                        $('#alert_text').html('Реферальный код недействителен!');
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
        var countries = '<option value="RU">Российская Федерация</option>' +
            '<option value="AF">Афганистан</option>'+
            '<option value="AX">Аландские острова</option>'+
            '<option value="AL">Албания</option>'+
            '<option value="DZ">Алжир</option>'+
            '<option value="AS">Американское Самоа</option>'+
            '<option value="AD">Андорра</option>'+
            '<option value="AO">Ангола</option>'+
            '<option value="AI">Ангилья</option>'+
            '<option value="AQ">Антарктида</option>'+
            '<option value="AG">Антигуа и Барбуда</option>'+
            '<option value="AR">Аргентина</option>'+
            '<option value="AM">Армения</option>'+
            '<option value="AW">Аруба</option>'+
            '<option value="AU">Австралия</option>'+
            '<option value="AT">Австрия</option>'+
            '<option value="AZ">Азербайджан</option>'+
            '<option value="BS">Багамы</option>'+
            '<option value="BH">Бахрейн</option>'+
            '<option value="BD">Бангладеш</option>'+
            '<option value="BB">Барбадос</option>'+
            '<option value="BY">Беларусь</option>'+
            '<option value="BE">Бельгия</option>'+
            '<option value="BZ">Белиз</option>'+
            '<option value="BJ">Бенин</option>'+
            '<option value="BM">Бермуды</option>'+
            '<option value="BT">Бутан</option>'+
            '<option value="BO">Боливия (Многонациональное Государство)</option>'+
            '<option value="BQ">Бонэйр, Синт-Эстатиус и Саба</option>'+
            '<option value="BA">Босния и Герцеговина</option>'+
            '<option value="BW">Ботсвана</option>'+
            '<option value="BV">Остров Буве</option>'+
            '<option value="BR">Бразилия</option>'+
            '<option value="IO">Британская территория Индийского океана</option>'+
            '<option value="BN">Бруней-Даруссалам</option>'+
            '<option value="BG">Болгария</option>'+
            '<option value="BF">Буркина-Фасо</option>'+
            '<option value="BI">Бурунди</option>'+
            '<option value="KH">Камбоджа</option>'+
            '<option value="CM">Камерун</option>'+
            '<option value="CA">Канада</option>'+
            '<option value="CV">Кабо-Верде</option>'+
            '<option value="KY">Каймановы острова</option>'+
            '<option value="CF">Центрально-Африканская Республика</option>'+
            '<option value="TD">Чад</option>'+
            '<option value="CL">Чили</option>'+
            '<option value="CN">Китай</option>'+
            '<option value="CX">Остров Рождества</option>'+
            '<option value="CC">Кокосовые (Килинг) острова</option>'+
            '<option value="CO">Колумбия</option>'+
            '<option value="KM">Коморские острова</option>'+
            '<option value="CG">Конго</option>'+
            '<option value="CD">Конго (Демократическая Республика)</option>'+
            '<option value="CK">Острова Кука</option>'+
            '<option value="CR">Коста-Рика</option>'+
            '<option value="CI">Кот-д\'\\Ивуар</option>'+
            '<option value="HR">Хорватия</option>'+
            '<option value="CU">Куба</option>'+
            '<option value="CW">Кюрасао</option>'+
            '<option value="CY">Кипр</option>'+
            '<option value="CZ">Республика Чехия</option>'+
            '<option value="DK">Дания</option>'+
            '<option value="DJ">Джибути</option>'+
            '<option value="DM">Доминика</option>'+
            '<option value="DO">Доминиканская Республика</option>'+
            '<option value="EC">Эквадор</option>'+
            '<option value="EG">Египет</option>'+
            '<option value="SV">Эль Сальвадор</option>'+
            '<option value="GQ">Экваториальная Гвинея</option>'+
            '<option value="ER">Эритрея</option>'+
            '<option value="EE">Эстония</option>'+
            '<option value="ET">Эфиопия</option>'+
            '<option value="FK">Фолклендские (Мальвинские) острова</option>'+
            '<option value="FO">Фарерские острова</option>'+
            '<option value="FJ">Фиджи</option>'+
            '<option value="FI">Финляндия</option>'+
            '<option value="FR">Франция</option>'+
            '<option value="GF">Французская Гвиана</option>'+
            '<option value="PF">Французская Полинезия</option>'+
            '<option value="TF">Южные Французские Территории</option>'+
            '<option value="GA">Габон</option>'+
            '<option value="GM">Гамбия</option>'+
            '<option value="GE">Грузия</option>'+
            '<option value="DE">Германия</option>'+
            '<option value="GH">Гана</option>'+
            '<option value="GI">Гибралтар</option>'+
            '<option value="GR">Греция</option>'+
            '<option value="GL">Гренландия</option>'+
            '<option value="GD">Гренада</option>'+
            '<option value="GP">Гваделупа</option>'+
            '<option value="GU">Гуам</option>'+
            '<option value="GT">Гватемала</option>'+
            '<option value="GG">Гернси</option>'+
            '<option value="GN">Гвинея</option>'+
            '<option value="GW">Гвинея-Бисау</option>'+
            '<option value="GY">Гайана</option>'+
            '<option value="HT">Гаити</option>'+
            '<option value="HM">Остров Херд и острова Макдональд</option>'+
            '<option value="VA">Святой Престол (государство-город Ватикан)</option>'+
            '<option value="HN">Гондурас</option>'+
            '<option value="HK">Гонконг</option>'+
            '<option value="HU">Венгрия</option>'+
            '<option value="IS">Исландия</option>'+
            '<option value="IN">Индия</option>'+
            '<option value="ID">Индонезия</option>'+
            '<option value="IR">Иран (Исламская Республика)</option>'+
            '<option value="IQ">Ирак</option>'+
            '<option value="IE">Ирландия</option>'+
            '<option value="IM">Остров Мэн</option>'+
            '<option value="IL">Израиль</option>'+
            '<option value="IT">Италия</option>'+
            '<option value="JM">Ямайка</option>'+
            '<option value="JP">Япония</option>'+
            '<option value="JE">Джерси</option>'+
            '<option value="JO">Иордания</option>'+
            '<option value="KZ">Казахстан</option>'+
            '<option value="KE">Кения</option>'+
            '<option value="KI">Кирибати</option>'+
            '<option value="KP">Корея, Народно-Демократическая Республика</option>'+
            '<option value="KR">Корея (Республика)</option>'+
            '<option value="KW">Кувейт</option>'+
            '<option value="KG">Киргизия</option>'+
            '<option value="LA">Лаосская Народно-Демократическая Республика</option>'+
            '<option value="LV">Латвия</option>'+
            '<option value="LB">Ливан</option>'+
            '<option value="LS">Лесото</option>'+
            '<option value="LR">Либерия</option>'+
            '<option value="LY">Ливия</option>'+
            '<option value="LI">Лихтенштейн</option>'+
            '<option value="LT">Литва</option>'+
            '<option value="LU">Люксембург</option>'+
            '<option value="MO">Макао</option>'+
            '<option value="MK">Македония (бывшая югославская Республика)</option>'+
            '<option value="MG">Мадагаскар</option>'+
            '<option value="MW">Малави</option>'+
            '<option value="MY">Малайзия</option>'+
            '<option value="MV">Мальдивы</option>'+
            '<option value="ML">Мали</option>'+
            '<option value="MT">Мальта</option>'+
            '<option value="MH">Маршалловы острова</option>'+
            '<option value="MQ">Мартиника</option>'+
            '<option value="MR">Мавритания</option>'+
            '<option value="MU">Маврикий</option>'+
            '<option value="YT">Майотта</option>'+
            '<option value="MX">Мексика</option>'+
            '<option value="FM">Микронезия, Федеративные Штаты</option>'+
            '<option value="MD">Молдова, Республика</option>'+
            '<option value="MC">Монако</option>'+
            '<option value="MN">Монголия</option>'+
            '<option value="ME">Черногория</option>'+
            '<option value="MS">Монтсеррат</option>'+
            '<option value="MA">Марокко</option>'+
            '<option value="MZ">Мозамбик</option>'+
            '<option value="MM">Мьянма</option>'+
            '<option value="NA">Намибия</option>'+
            '<option value="NR">Науру</option>'+
            '<option value="NP">Непал</option>'+
            '<option value="NL">Нидерланды</option>'+
            '<option value="NC">Новая Каледония</option>'+
            '<option value="NZ">Новая Зеландия</option>'+
            '<option value="NI">Никарагуа</option>'+
            '<option value="NE">Нигер</option>'+
            '<option value="NG">Нигерия</option>'+
            '<option value="NU">Ниуэ</option>'+
            '<option value="NF">Остров Норфолк</option>'+
            '<option value="MP">Северные Марианские острова</option>'+
            '<option value="NO">Норвегия</option>'+
            '<option value="OM">Оман</option>'+
            '<option value="PK">Пакистан</option>'+
            '<option value="PW">Палау</option>'+
            '<option value="PS">Палестинская территория, оккупированная</option>'+
            '<option value="PA">Панама</option>'+
            '<option value="PG">Папуа - Новая Гвинея</option>'+
            '<option value="PY">Парагвай</option>'+
            '<option value="PE">Перу</option>'+
            '<option value="PH">Филиппины</option>'+
            '<option value="PN">Питкэрн</option>'+
            '<option value="PL">Польша</option>'+
            '<option value="PT">Португалия</option>'+
            '<option value="PR">Пуэрто-Рико</option>'+
            '<option value="QA">Катар</option>'+
            '<option value="RE">Реюньон</option>'+
            '<option value="RO">Румыния</option>'+

            '<option value="RW">Руанда</option>'+
            '<option value="BL">Сен-Бартелеми</option>'+
            '<option value="SH">Острова Святой Елены, Вознесения и Тристан-да-Кунья</option>'+
            '<option value="KN">Сент-Китс и Невис</option>'+
            '<option value="LC">Санкт-Люсия</option>'+
            '<option value="MF">Сен-Мартен (французская часть)</option>'+
            '<option value="PM">Сен-Пьер и Микелон</option>'+
            '<option value="VC">Сент Винсент и Гренадины</option>'+
            '<option value="WS">Самоа</option>'+
            '<option value="SM">Сан-Марино</option>'+
            '<option value="ST">Сан-Томе и Принсипи</option>'+
            '<option value="SA">Саудовская Аравия</option>'+
            '<option value="SN">Сенегал</option>'+
            '<option value="RS">Сербия</option>'+
            '<option value="SC">Сейшельские острова</option>'+
            '<option value="SL">Сьерра-Леоне</option>'+
            '<option value="SG">Сингапур</option>'+
            '<option value="SX">Синт-Мартен (нидерландская часть)</option>'+
            '<option value="SK">Словакия</option>'+
            '<option value="SI">Словения</option>'+
            '<option value="SB">Соломоновы острова</option>'+
            '<option value="SO">Сомали</option>'+
            '<option value="ZA">Южная Африка</option>'+
            '<option value="GS">Южная Георгия и Южные Сандвичевы острова</option>'+
            '<option value="SS">Южный Судан</option>'+
            '<option value="ES">Испания</option>'+
            '<option value="LK">Шри-Ланка</option>'+
            '<option value="SD">Судан</option>'+
            '<option value="SR">Суринам</option>'+
            '<option value="SJ">Шпицберген и Ян Майен</option>'+
            '<option value="SZ">Свазиленд</option>'+
            '<option value="SE">Швеция</option>'+
            '<option value="CH">Швейцария</option>'+
            '<option value="SY">Сирийская Арабская Республика</option>'+
            '<option value="TW">Тайвань, провинция Китая</option>'+
            '<option value="TJ">Таджикистан</option>'+
            '<option value="TZ">Танзания, Объединенная Республика</option>'+
            '<option value="TH">Таиланд</option>'+
            '<option value="TL">Тимор-Лешти</option>'+
            '<option value="TG">Того</option>'+
            '<option value="TK">Токелау</option>'+
            '<option value="TO">Тонга</option>'+
            '<option value="TT">Тринидад и Тобаго</option>'+
            '<option value="TN">Тунис</option>'+
            '<option value="TR">Турция</option>'+
            '<option value="TM">Туркменистан</option>'+
            '<option value="TC">Острова Теркс и Кайкос</option>'+
            '<option value="TV">Тувалу</option>'+
            '<option value="UG">Уганда</option>'+
            '<option value="UA">Украина</option>'+
            '<option value="AE">Объединенные Арабские Эмираты</option>'+
            '<option value="GB">Великобритания</option>' +
            '<option value="US">Соединенные Штаты</option>'+
            '<option value="UM">Внешние малые острова США</option>'+
            '<option value="UY">Уругвай</option>'+
            '<option value="UZ">Узбекистан</option>'+
            '<option value="VU">Вануату</option>'+
            '<option value="VE">Венесуэла, Боливарианская Республика</option>'+
            '<option value="VN">Вьетнам</option>'+
            '<option value="VG">Виргинские острова, британские</option>'+
            '<option value="VI">Виргинские острова, США</option>'+
            '<option value="WF">Уоллис и Футуна</option>'+
            '<option value="EH">Западная Сахара</option>'+
            '<option value="YE">Йемен</option>'+
            '<option value="ZM">Замбия</option>'+
            '<option value="ZW">Зимбабве</option>'
        ;
        $('li').removeClass('active');
        $('#tab_'+(4)).addClass('active');
        $('#step_'+3).addClass('hidden');
        $('#step_'+(4)).removeClass('hidden');

        if($('#business_type').val()=='organisation')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Название организации" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="VAT (при наличии)">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Головной офис организации - Номер дома/строения" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Головной офис организации - Улица/дорога" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Головной офис организации - Город" required>\n' +
                '        <input type="hidden" value="RU" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Головной офис организации - Страна" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="RU">Российская Федерация</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Головной офис организации - Почтовый индекс" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Юридические представители - Имя" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Юридические представители - Фамилия" required>\n' +
                '<label>Юридические представители - Дата рождения</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Месяц</option>\n' +
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
                '                                <option value="">День</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Год</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Юридические представители - Страна" required>\n' +
                '<option value="">Юридические представители - Страна</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Юридические представители - Гражданство" required>\n' +
                '<option value="">Юридические представители - Гражданство</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Почтовый адрес - Номер дома/строения" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Почтовый адрес - Улица/дорога" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Юридические - Город" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Юридические - Почтовый индекс" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL веб-сайта" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Должен начинаться с www и не содержать пробелов.\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="Имя" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Фамилия" required>\n' +
                '<label>Дата рождения</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Месяц</option>\n' +
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
                '                                <option value="">День</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Год</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="RU" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="Страна" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="RU">Российская Федерация</option>' +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Гражданство" required>\n' +
                '<option value="">Гражданство</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="Наименование фирмы" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="VAT (при наличии)">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Номер дома/строения" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Улица/дорога" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Город" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Индекс" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL веб-сайта" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Должен начинаться с www и не содержать пробелов.\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Название компании" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="Рег. номер компании" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   Рег.номер компании в Россия должен содержать минимум 10 цифр.\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Головной офис компании - Номер дома/строения" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Головной офис компании - Улица/дорога" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Головной офис компании - Город" required>\n' +
                '        <input type="hidden" value="RU" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Головной офис компании - Страна" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="RU">Российская Федерация</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Головной офис компании - Почтовый индекс" required>'+
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="VAT (при наличии)">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Директор - Имя" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Директор - Фамилия" required>\n' +
                '<label>Директор - Дата рождения</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Месяц</option>\n' +
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
                '                                <option value="">День</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Год</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Директор - Страна" required>\n' +
                '<option value="">Директор - Страна</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="Директор - Гражданство" required>\n' +
                '<option value="">Директор - Гражданство</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Почтовый адрес - Номер дома/строения" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Почтовый адрес - Улица/дорога" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Почтовый адрес - Город" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Почтовый адрес - Почтовый индекс" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL веб-сайта" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Должен начинаться с www и не содержать пробелов.\n'+
                '</small>\n');
        }
        if($('#user_type').val()=='citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="Имя" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="Фамилия" required>\n' +
                '                    <label>Дата рождения</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Месяц</option>\n' +
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
                '                                <option value="">День</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">Год</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="RU" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="Страна" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="RU">Российская Федерация</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="Гражданство" required>\n' +
                '<option value="">Гражданство</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="Номер дома/строения" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="Улица/дорога" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="Город" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="Индекс" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
