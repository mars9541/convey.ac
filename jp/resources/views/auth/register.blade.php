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
              <span class="m-t-25">アカウントを作成中です。<br> しばらくお待ちください。</span>
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

                    <strong>ご注意ください!</strong><span id="alert_text"> 全ての必要な情報の入力をお願いします。</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2>{{__('登録')}} <span>(ステップ１/４)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">アクセスしたい国をお選びください</option>
                        @foreach($country as $c)
                            @if($c->country_code == 'ru')
                                @continue;
                            @endif

                            <option value="{{$c->country_code}}">{{$c->country_name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> 希望するアカウントタイプをお選びください</option>
                        <option value="business"> ビジネス（記録の付加と検索）</option>
                        <option value="advisors"> リクルーター、デベロッパー、アドバイザー、ライター</option>
                        <option value="hris"> 従業員管理、人事管理システム(HRIS)、採用管理システム(ATS)、ベンダー管理システム(VMS)などのソフトウェアプロバイダー</option>
                        <option value="citizen"> 個人用（自分自身の記録を検索する目的）</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div>
                            <input type="radio" name="hris_type"  id="a" checked  value="software">
                            <label for="a" > 人事管理システム(HRIS)ソフトウェア提供のみ </label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="b" value="tracking">
                            <label for="b"> 採用管理システム(ATS)かベンダー管理システム(VMS)ソフトウェア提供のみ</label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="c" value="both">
                            <label for="c"> 上記を取り合わせたものを提供</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div>
                            <input type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label for="aa" > ビジネスシステム・ソフトウェア開発者</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label for="bb"> 人事サービスを提供します</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="cc" value="writer">
                            <label for="cc"> リクルートメントサービスを提供</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>登録 <span>(ステップ２/４)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">ビジネスの内容</option>
                        <option value="company"> 会社</option>
                        <option value="organisation"> 組織</option>
                        <option value="selfemployed">自営業</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">ビジネスの分野をお選びください</option>
                        @foreach($market as $m)
                        <option value="{{$m->market_value}}">{{$m->name}}</option>
                        @endforeach

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">従業員数</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>登録 <span>(ステップ３/４)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Eメールアドレスを入力してください" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">無料Eメールアドレスは利用出来ません
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="パスワードを選んでください" id="password" required>
                    <label class="note">パスワードは８文字以上でお願いします</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="パスワードの再入力" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="紹介コード（該当する場合のみ）" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>登録 <span>(ステップ４/４)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="名前" required>
                        <input type="text" class="form-control" name="lastname" placeholder="名字" required>
                        <label>生年月日</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">月</option>
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
                                    <option value="">日</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">年</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="国" required>
                        <input type="text" class="form-control" name="nationality" placeholder="国籍" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="住所" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="市町村" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="都道府県" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="郵便番号" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality">
                        <label for="confidentiality">機密保持規約</label>
                        <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">こちらからご覧ください</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms">
                        <label for="terms">規約条件</label>
                        <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">こちらからご覧ください</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy">
                        <label for="privacy">プライバシー規約</label>
                        <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">こちらからご覧ください</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">続行</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
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
                    $('#business_type').append('<option value="">ビジネスの内容</option>\n' +
                        '                        <option value="company">会社</option>\n' +
                        '                        <option value="organisation">組織</option>');
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
                                $('#alert_text').html('このEメールアドレスはすでに登録済みです!');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('このアカウントを手動で作成する代わりに、既存のアカウントにログインして「国別アクセス」を有効にし、すべてのアカウントがリンクされるようにしてください。');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('有効なEメールアドレスを入力してください!');
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

                    if (!/^([A-Za-z0-9]{13})$/.test(company_no)) {
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
        if (!/^([A-Za-z0-9]{13})$/.test(company_no)) {
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
                $('#alert_text').html('有効なパスワードを入力してください!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('パスワードは８文字以上でお願いします');
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
                        $('#alert_text').html('紹介コードが無効です!');
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
        var countries = '<option value="JP">日本</option>'+
            '<option value="AF">アフガニスタン</option>'+
            '<option value="AX">オーランド諸島</option>'+
            '<option value="AL">アルバニア</option>'+
            '<option value="DZ">アルジェリア</option>'+
            '<option value="AS">米領サモア</option>'+
            '<option value="AD">アンドラ公国</option>'+
            '<option value="AO">アンゴラ</option>'+
            '<option value="AI">アングィラ</option>'+
            '<option value="AQ">南極</option>'+
            '<option value="AG">アンティグア・バーブーダ</option>'+
            '<option value="AR">アルゼンチン</option>'+
            '<option value="AM">アルメニア</option>'+
            '<option value="AW">アルバ</option>'+
            '<option value="AU">オーストラリア</option>'+
            '<option value="AT">オーストリア</option>'+
            '<option value="AZ">アゼルバイジャン</option>'+
            '<option value="BS">バハマ</option>'+
            '<option value="BH">バーレーン</option>'+
            '<option value="BD">バングラデシュ</option>'+
            '<option value="BB">バルバドス</option>'+
            '<option value="BY">ベラルーシ共和国</option>'+
            '<option value="BE">ベルギー</option>'+
            '<option value="BZ">ベリーズ</option>'+
            '<option value="BJ">ベナン</option>'+
            '<option value="BM">バミューダ諸島</option>'+
            '<option value="BT">ブータン</option>'+
            '<option value="BO">ボリビア</option>'+
            '<option value="BQ">ボネール島</option>'+
            '<option value="BA">ボスニア・ヘルツェゴビナ</option>'+
            '<option value="BW">ボツワナ</option>'+
            '<option value="BV">ブーべ島</option>'+
            '<option value="BR">ブラジル</option>'+
            '<option value="IO">英領インド洋地域</option>'+
            '<option value="BN">ブルネイ</option>'+
            '<option value="BG">ブルガリア</option>'+
            '<option value="BF">ブルキナファソ</option>'+
            '<option value="BI">ブルンジ</option>'+
            '<option value="KH">カンボジア</option>'+
            '<option value="CM">カメルーン</option>'+
            '<option value="CA">カナダ</option>'+
            '<option value="CV">カーボベルデ</option>'+
            '<option value="KY">ケイマン諸島</option>'+
            '<option value="CF">中央アフリカ共和国</option>'+
            '<option value="TD">チャド</option>'+
            '<option value="CL">チリ</option>'+
            '<option value="CN">中国</option>'+
            '<option value="CX">クリスマス島</option>'+
            '<option value="CC">ココス（キーリング）諸島</option>'+
            '<option value="CO">コロンビア</option>'+
            '<option value="KM">コモロ</option>'+
            '<option value="CG">コンゴ</option>'+
            '<option value="CD">コンゴ民主共和国</option>'+
            '<option value="CK">クック諸島</option>'+
            '<option value="CR">コスタリカ</option>'+
            '<option value="CI">コートジボアール</option>'+
            '<option value="HR">クロアチア</option>'+
            '<option value="CU">キューバ</option>'+
            '<option value="CW">キュラソー島</option>'+
            '<option value="CY">キプロス</option>'+
            '<option value="CZ">チェコ</option>'+
            '<option value="DK">デンマーク</option>'+
            '<option value="DJ">ジブチ</option>'+
            '<option value="DM">ドミニカ</option>'+
            '<option value="DO">ドミニカ共和国</option>'+
            '<option value="EC">エクアドル</option>'+
            '<option value="EG">エジプト</option>'+
            '<option value="SV">エルサルバドル</option>'+
            '<option value="GQ">赤道ギニア</option>'+
            '<option value="ER">エリトリア</option>'+
            '<option value="EE">エストニア</option>'+
            '<option value="ET">エチオピア</option>'+
            '<option value="FK">フォークランド諸島</option>'+
            '<option value="FO">フェロー諸島</option>'+
            '<option value="FJ">フィジー</option>'+
            '<option value="FI">フィンランド</option>'+
            '<option value="FR">フランス</option>'+
            '<option value="GF">フランス領ギアナ</option>'+
            '<option value="PF">フランス領ポリネシア</option>'+
            '<option value="TF">フランス領南極地方</option>'+
            '<option value="GA">ガボン</option>'+
            '<option value="GM">ガンビア</option>'+
            '<option value="GE">グルジア</option>'+
            '<option value="DE">ドイツ</option>'+
            '<option value="GH">ガーナ</option>'+
            '<option value="GI">ジブラルタル</option>'+
            '<option value="GR">ギリシャ</option>'+
            '<option value="GL">グリーンランド</option>'+
            '<option value="GD">グレナダ</option>'+
            '<option value="GP">グアドループ</option>'+
            '<option value="GU">グアム</option>'+
            '<option value="GT">グアテマラ</option>'+
            '<option value="GG">ガーンジー</option>'+
            '<option value="GN">ギニア</option>'+
            '<option value="GW">ギニアビサウ</option>'+
            '<option value="GY">ガイアナ</option>'+
            '<option value="HT">ハイチ</option>'+
            '<option value="HM">ハード・マクドナルド諸島</option>'+
            '<option value="VA">バチカン市</option>'+
            '<option value="HN">ホンジュラス</option>'+
            '<option value="HK">香港</option>'+
            '<option value="HU">ハンガリー</option>'+
            '<option value="IS">アイスランド</option>'+
            '<option value="IN">インド</option>'+
            '<option value="ID">インドネシア</option>'+
            '<option value="IR">イラン</option>'+
            '<option value="IQ">イラク</option>'+
            '<option value="IE">アイルランド</option>'+
            '<option value="IM">マン島</option>'+
            '<option value="IL">イスラエル</option>'+
            '<option value="IT">イタリア</option>'+
            '<option value="JM">ジャマイカ</option>'+

            '<option value="JE">ジャージー</option>'+
            '<option value="JO">ヨルダン</option>'+
            '<option value="KZ">カザフスタン</option>'+
            '<option value="KE">ケニア</option>'+
            '<option value="KI">キリバス</option>'+
            '<option value="KP">北朝鮮</option>'+
            '<option value="KR">韓国</option>'+
            '<option value="KW">クウェート</option>'+
            '<option value="KG">キルギス</option>'+
            '<option value="LA">ラオス</option>'+
            '<option value="LV">ラトビア</option>'+
            '<option value="LB">レバノン</option>'+
            '<option value="LS">レソト</option>'+
            '<option value="LR">リベリア</option>'+
            '<option value="LY">リビア</option>'+
            '<option value="LI">リヒテンシュタイン</option>'+
            '<option value="LT">リトアニア</option>'+
            '<option value="LU">ルクセンブルク</option>'+
            '<option value="MO">マカオ</option>'+
            '<option value="MK">マケドニア</option>'+
            '<option value="MG">マダガスカル</option>'+
            '<option value="MW">マラウイ</option>'+
            '<option value="MY">マレーシア</option>'+
            '<option value="MV">モルディブ</option>'+
            '<option value="ML">マリ</option>'+
            '<option value="MT">マルタ</option>'+
            '<option value="MH">マーシャル諸島</option>'+
            '<option value="MQ">マルチニーク島</option>'+
            '<option value="MR">モーリタニア</option>'+
            '<option value="MU">モーリシャス</option>'+
            '<option value="YT">マイヨット島</option>'+
            '<option value="MX">メキシコ</option>'+
            '<option value="FM">ミクロネシア</option>'+
            '<option value="MD">モルドバ</option>'+
            '<option value="MC">モナコ</option>'+
            '<option value="MN">モンゴル</option>'+
            '<option value="ME">モンテネグロ</option>'+
            '<option value="MS">モンセラット</option>'+
            '<option value="MA">モロッコ</option>'+
            '<option value="MZ">モザンビーク</option>'+
            '<option value="MM">ミャンマー</option>'+
            '<option value="NA">ナミビア</option>'+
            '<option value="NR">ナウル</option>'+
            '<option value="NP">ネパール</option>'+
            '<option value="NL">オランダ</option>'+
            '<option value="NC">ニューカレドニア</option>'+
            '<option value="NZ">ニュージーランド</option>'+
            '<option value="NI">ニカラグア</option>'+
            '<option value="NE">ニジェール</option>'+
            '<option value="NG">ナイジェリア</option>'+
            '<option value="NU">ニウエ</option>'+
            '<option value="NF">ノーフォーク島</option>'+
            '<option value="MP">北マリアナ諸島</option>'+
            '<option value="NO">ノルウェー</option>'+
            '<option value="OM">オマーン</option>'+
            '<option value="PK">パキスタン</option>'+
            '<option value="PW">パラオ</option>'+
            '<option value="PS">パレスチナ</option>'+
            '<option value="PA">パナマ</option>'+
            '<option value="PG">パプアニューギニア</option>'+
            '<option value="PY">パラグアイ</option>'+
            '<option value="PE">ペルー</option>'+
            '<option value="PH">フィリピン</option>'+
            '<option value="PN">ピトケアン</option>'+
            '<option value="PL">ポーランド</option>'+
            '<option value="PT">ポルトガル</option>'+
            '<option value="PR">プエルトリコ</option>'+
            '<option value="QA">カタール</option>'+
            '<option value="RE">レユニオン</option>'+
            '<option value="RO">ルーマニア</option>'+
            '<option value="RU">ロシア</option>'+
            '<option value="RW">ルワンダ</option>'+
            '<option value="BL">サン・バルテルミー島</option>'+
            '<option value="SH">セントヘレナ</option>'+
            '<option value="KN">セントクリストファー・ネイビス</option>'+
            '<option value="LC">セントルシア</option>'+
            '<option value="MF">セント・マーチン島（フランス）</option>'+
            '<option value="PM">サンピエール・ミクロン</option>'+
            '<option value="VC">セントビンセントおよびグレナディーン諸島</option>'+
            '<option value="WS">サモア</option>'+
            '<option value="SM">サンマリノ</option>'+
            '<option value="ST">サントメ・プリンシペ</option>'+
            '<option value="SA">サウジアラビア</option>'+
            '<option value="SN">セネガル</option>'+
            '<option value="RS">セルビア</option>'+
            '<option value="SC">セイシェル</option>'+
            '<option value="SL">シエラレオネ</option>'+
            '<option value="SG">シンガポール</option>'+
            '<option value="SX">セント・マーチン島（オランダ）</option>'+
            '<option value="SK">スロバキア</option>'+
            '<option value="SI">スロベニア</option>'+
            '<option value="SB">ソロモン諸島</option>'+
            '<option value="SO">ソマリア</option>'+
            '<option value="ZA">南アフリカ</option>'+
            '<option value="GS">サウスジョージア・サウスサンドウィッチ諸島</option>'+
            '<option value="SS">南スーダン</option>'+
            '<option value="ES">スペイン</option>'+
            '<option value="LK">スリランカ</option>'+
            '<option value="SD">スーダン</option>'+
            '<option value="SR">スリナム</option>'+
            '<option value="SJ">スバールバル諸島およびヤンマイエン島</option>'+
            '<option value="SZ">スワジランド</option>'+
            '<option value="SE">スウェーデン</option>'+
            '<option value="CH">スイス</option>'+
            '<option value="SY">シリア</option>'+
            '<option value="TW">台湾</option>'+
            '<option value="TJ">タジキスタン</option>'+
            '<option value="TZ">タンザニア</option>'+
            '<option value="TH">タイ</option>'+
            '<option value="TL">東ティモール</option>'+
            '<option value="TG">トーゴ</option>'+
            '<option value="TK">トケラウ諸島</option>'+
            '<option value="TO">トンガ</option>'+
            '<option value="TT">トリニダード・トバゴ</option>'+
            '<option value="TN">チュニジア</option>'+
            '<option value="TR">トルコ</option>'+
            '<option value="TM">トルクメニスタン</option>'+
            '<option value="TC">タークス・カイコス諸島</option>'+
            '<option value="TV">ツバル</option>'+
            '<option value="UG">ウガンダ</option>'+
            '<option value="UA">ウクライナ</option>'+
            '<option value="AE">アラブ首長国連邦</option>'+
            '<option value="GB">イギリス</option>' +
            '<option value="US">アメリカ</option>'+
            '<option value="UM">米領オセアニア諸島</option>'+
            '<option value="UY">ウルグアイ</option>'+
            '<option value="UZ">ウズベキスタン</option>'+
            '<option value="VU">バヌアツ</option>'+
            '<option value="VE">ベネズエラ</option>'+
            '<option value="VN">ベトナム</option>'+
            '<option value="VG">イギリス領ヴァージン諸島</option>'+
            '<option value="VI">米領ヴァージン諸島</option>'+
            '<option value="WF">ワリス・フテュナ諸島</option>'+
            '<option value="EH">西サハラ</option>'+
            '<option value="YE">イエメン</option>'+
            '<option value="ZM">ザンビア</option>'+
            '<option value="ZW">ジンバブエ</option>'
        ;
        $('li').removeClass('active');
        $('#tab_'+(4)).addClass('active');
        $('#step_'+3).addClass('hidden');
        $('#step_'+(4)).removeClass('hidden');

        if($('#business_type').val()=='organisation')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="組織名" required>\n' +
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="VAT（該当する場合のみ）">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="組織本部の住所" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="市町村（組織本部）" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="都道府県（組織本部）" required>\n' +
                '        <input type="hidden" value="JP" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="国（組織本部）" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="JP">日本</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="郵便番号（組織本部）" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="法定代理人の名前" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="法定代理人の名字" required>\n' +
                '<label>法定代理人の生年月日</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">月</option>\n' +
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
                '                                <option value="">日</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">年</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="国（法定代理人住所" required>\n' +
                '<option value="">国（法定代理人住所</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="法定代理人の国籍" required>\n' +
                '<option value="">法定代理人の国籍</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="メーリング・アドレスの住所" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="市町村（メーリング・アドレス）" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="都道府県（メーリング・アドレス）" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="郵便番号（メーリング・アドレス）" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="ウェブサイトURL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   wwwから入力しスペースをあけないようにお願いします。\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="名前" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="名字" required>\n' +
                '<label>生年月日</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">月</option>\n' +
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
                '                                <option value="">日</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">年</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="JP" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="国" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="JP">日本</option>' +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="国籍" required>\n' +
                '<option value="">Nationality</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="ビジネス名" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="VAT（該当する場合のみ）">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="住所" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="市町村" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="都道府県" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="郵便番号" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="ウェブサイトURL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   wwwから入力しスペースをあけないようにお願いします。\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="会社名" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="会社番号" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   13桁の日本会社番号を入力してください\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="本社の住所" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="市町村（本社）" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="都道府県（本社）" required>\n' +
                '        <input type="hidden" value="JP" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="国（本社）" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="JP">日本</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="郵便番号（本社）" required>'+
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="VAT（該当する場合のみ）">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="取締役の名前" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="取締役の名字" required>\n' +
                '<label>取締役の生年月日</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">月</option>\n' +
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
                '                                <option value="">日</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">年</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="国（取締役住所）" required>\n' +
                '<option value="">国（取締役住所）</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="取締役の国籍" required>\n' +
                '<option value="">取締役の国籍</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="メーリング・アドレスの住所" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="市町村（メーリング・アドレス）" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="都道府県（メーリング・アドレス）" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="郵便番号（メーリング・アドレス）" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="ウェブサイトURL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   wwwから入力しスペースをあけないようにお願いします。\n'+
                '</small>\n');
        }
        if($('#user_type').val()=='citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="名前" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="名字" required>\n' +
                '                    <label>生年月日</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">月</option>\n' +
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
                '                                <option value="">日</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">年</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="JP" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="国" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="JP">日本</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="国籍" required>\n' +
                '<option value="">国籍</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="住所" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="市町村" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="都道府県" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="郵便番号" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
