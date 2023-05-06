<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo" style="width: 70%"></a>
                <div style="height: 40px;"></div>
              <span class="m-t-25">Account Creation in Progress <br> Please Wait.</span>
            </div>
          </div>
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
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

                    <strong>Warning!</strong><span id="alert_text"> Please fill out all required input.</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2><?php echo e(__('Sign Up Now')); ?> <span>(Step 1 of 4)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">What country would you like to access?</option>
                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($c->country_code == 'ru'): ?>
                                <?php continue; ?>;
                            <?php endif; ?>
                        <option value="<?php echo e($c->country_code); ?>"><?php echo e($c->country_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> What Type of Account Would You Like ?</option>
                        <option value="business"> One For Businesses (Add & Search Records)</option>
                        <option value="advisors"> One for Consultants/Developers/Advisors/Writers</option>
                        <option value="hris"> One For HRIS/ATS/VMS Software providers</option>
                        <option value="citizen"> One For Myself So I Can Find My Personal Records</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div>
                            <input type="radio" name="hris_type"  id="a" checked  value="software">
                            <label for="a" > We Provide HRIS Software Only </label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="b" value="tracking">
                            <label for="b"> We Provide ATS or VMS Software Only</label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="c" value="both">
                            <label for="c"> We Provide A Combination of the Above</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div>
                            <input type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label for="aa" > We Develop Business Systems/Software</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label for="bb"> We Provide Business Advice</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="cc" value="writer">
                            <label for="cc"> We Write Business Articles</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>Sign Up Now <span>(Step 2 of 4)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">What Type of Business Are You ?</option>
                        <option value="company"> Company</option>
                        <option value="organisation"> Organisation</option>
                        <option value="selfemployed">Self Employed</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">What Market Are You In ?</option>
                        <?php $__currentLoopData = $market; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m->name); ?>"><?php echo e($m->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">How Many Employees Do You Have ?</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>Sign Up Now <span>(Step 3 of 4)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email Address" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">You cannot use a free email address.
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="Choose a Password" id="password" required>
                    <label class="note">Passwords need to be 8 characters or more</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat Password" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="Referral Code (If Someone Gave You One)" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>Sign Up Now <span>(Final Step)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                        <label>Date Of Birth</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">Month</option>
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
                                    <option value="">Day</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">Year</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="Country" required>
                        <input type="text" class="form-control" name="nationality" placeholder="Nationality" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="House/Building Number" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="Street/Road" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Town/City" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="Eircode" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality"> <label for="confidentiality">Confidentiality agreement</label>  <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">View Here</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms"><label for="terms"> Terms and conditions</label>  <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">View Here</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy"> <label for="privacy">Privacy agreement </label> <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">View Here</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">Proceed</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    function view_guide_detail(input) {
        $.ajax({
            url: "<?php echo e(route('get_terms_temp')); ?>",
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
            var locale = "<?php echo e(app()->getLocale()); ?>";
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

        y = '<?php echo e(date('Y')); ?>';
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
        y = '<?php echo e(date('Y')); ?>';

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
    var locale = "<?php echo e(app()->getLocale()); ?>";
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
                    url: "<?php echo e(route('save_register')); ?>",
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
                    $('#business_type').append('<option value="">What Type of Business Are You ?</option>\n' +
                        '                        <option value="company"> Company</option>\n' +
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
                        url: "<?php echo e(route('email_verify')); ?>",
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
                                $('#alert_text').html('This Email already Exist!');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('Instead of manually creating this account, please login to your existing account and activate ‘country access’ so all your accounts are linked.');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('Enter valid Email!');
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

                    if (!/^([A-Za-z0-9]{6,8})$/.test(company_no)) {
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
        if (!/^([A-Za-z0-9]{6,8})$/.test(company_no)) {
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
        var str = "<?php echo e($freeEmailList); ?>";
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
                $('#alert_text').html('Enter valid Confirm Password!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('Passwords need to be 8 characters or more');
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
                url: "<?php echo e(route('code_verify')); ?>",
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
                        $('#alert_text').html('Invalid referral_code!');
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
        var countries = '<option value="IE">Ireland</option>'+
            '<option value="AF">Afghanistan</option>'+
            '<option value="AX">Åland Islands</option>'+
            '<option value="AL">Albania</option>'+
            '<option value="DZ">Algeria</option>'+
            '<option value="AS">American Samoa</option>'+
            '<option value="AD">Andorra</option>'+
            '<option value="AO">Angola</option>'+
            '<option value="AI">Anguilla</option>'+
            '<option value="AQ">Antarctica</option>'+
            '<option value="AG">Antigua and Barbuda</option>'+
            '<option value="AR">Argentina</option>'+
            '<option value="AM">Armenia</option>'+
            '<option value="AW">Aruba</option>'+
            '<option value="AU">Australia</option>'+
            '<option value="AT">Austria</option>'+
            '<option value="AZ">Azerbaijan</option>'+
            '<option value="BS">Bahamas</option>'+
            '<option value="BH">Bahrain</option>'+
            '<option value="BD">Bangladesh</option>'+
            '<option value="BB">Barbados</option>'+
            '<option value="BY">Belarus</option>'+
            '<option value="BE">Belgium</option>'+
            '<option value="BZ">Belize</option>'+
            '<option value="BJ">Benin</option>'+
            '<option value="BM">Bermuda</option>'+
            '<option value="BT">Bhutan</option>'+
            '<option value="BO">Bolivia, Plurinational State of</option>'+
            '<option value="BQ">Bonaire, Sint Eustatius and Saba</option>'+
            '<option value="BA">Bosnia and Herzegovina</option>'+
            '<option value="BW">Botswana</option>'+
            '<option value="BV">Bouvet Island</option>'+
            '<option value="BR">Brazil</option>'+
            '<option value="IO">British Indian Ocean Territory</option>'+
            '<option value="BN">Brunei Darussalam</option>'+
            '<option value="BG">Bulgaria</option>'+
            '<option value="BF">Burkina Faso</option>'+
            '<option value="BI">Burundi</option>'+
            '<option value="KH">Cambodia</option>'+
            '<option value="CM">Cameroon</option>'+
            '<option value="CA">Canada</option>'+
            '<option value="CV">Cape Verde</option>'+
            '<option value="KY">Cayman Islands</option>'+
            '<option value="CF">Central African Republic</option>'+
            '<option value="TD">Chad</option>'+
            '<option value="CL">Chile</option>'+
            '<option value="CN">China</option>'+
            '<option value="CX">Christmas Island</option>'+
            '<option value="CC">Cocos (Keeling) Islands</option>'+
            '<option value="CO">Colombia</option>'+
            '<option value="KM">Comoros</option>'+
            '<option value="CG">Congo</option>'+
            '<option value="CD">Congo, the Democratic Republic of the</option>'+
            '<option value="CK">Cook Islands</option>'+
            '<option value="CR">Costa Rica</option>'+
            '<option value="CI">Côte d\'Ivoire</option>'+
            '<option value="HR">Croatia</option>'+
            '<option value="CU">Cuba</option>'+
            '<option value="CW">Curaçao</option>'+
            '<option value="CY">Cyprus</option>'+
            '<option value="CZ">Czech Republic</option>'+
            '<option value="DK">Denmark</option>'+
            '<option value="DJ">Djibouti</option>'+
            '<option value="DM">Dominica</option>'+
            '<option value="DO">Dominican Republic</option>'+
            '<option value="EC">Ecuador</option>'+
            '<option value="EG">Egypt</option>'+
            '<option value="SV">El Salvador</option>'+
            '<option value="GQ">Equatorial Guinea</option>'+
            '<option value="ER">Eritrea</option>'+
            '<option value="EE">Estonia</option>'+
            '<option value="ET">Ethiopia</option>'+
            '<option value="FK">Falkland Islands (Malvinas)</option>'+
            '<option value="FO">Faroe Islands</option>'+
            '<option value="FJ">Fiji</option>'+
            '<option value="FI">Finland</option>'+
            '<option value="FR">France</option>'+
            '<option value="GF">French Guiana</option>'+
            '<option value="PF">French Polynesia</option>'+
            '<option value="TF">French Southern Territories</option>'+
            '<option value="GA">Gabon</option>'+
            '<option value="GM">Gambia</option>'+
            '<option value="GE">Georgia</option>'+
            '<option value="DE">Germany</option>'+
            '<option value="GH">Ghana</option>'+
            '<option value="GI">Gibraltar</option>'+
            '<option value="GR">Greece</option>'+
            '<option value="GL">Greenland</option>'+
            '<option value="GD">Grenada</option>'+
            '<option value="GP">Guadeloupe</option>'+
            '<option value="GU">Guam</option>'+
            '<option value="GT">Guatemala</option>'+
            '<option value="GG">Guernsey</option>'+
            '<option value="GN">Guinea</option>'+
            '<option value="GW">Guinea-Bissau</option>'+
            '<option value="GY">Guyana</option>'+
            '<option value="HT">Haiti</option>'+
            '<option value="HM">Heard Island and McDonald Islands</option>'+
            '<option value="VA">Holy See (Vatican City State)</option>'+
            '<option value="HN">Honduras</option>'+
            '<option value="HK">Hong Kong</option>'+
            '<option value="HU">Hungary</option>'+
            '<option value="IS">Iceland</option>'+
            '<option value="IN">India</option>'+
            '<option value="ID">Indonesia</option>'+
            '<option value="IR">Iran, Islamic Republic of</option>'+
            '<option value="IQ">Iraq</option>'+

            '<option value="IM">Isle of Man</option>'+
            '<option value="IL">Israel</option>'+
            '<option value="IT">Italy</option>'+
            '<option value="JM">Jamaica</option>'+
            '<option value="JP">Japan</option>'+
            '<option value="JE">Jersey</option>'+
            '<option value="JO">Jordan</option>'+
            '<option value="KZ">Kazakhstan</option>'+
            '<option value="KE">Kenya</option>'+
            '<option value="KI">Kiribati</option>'+
            '<option value="KP">Korea, Democratic People\'s Republic of</option>'+
            '<option value="KR">Korea, Republic of</option>'+
            '<option value="KW">Kuwait</option>'+
            '<option value="KG">Kyrgyzstan</option>'+
            '<option value="LA">Lao People\'s Democratic Republic</option>'+
            '<option value="LV">Latvia</option>'+
            '<option value="LB">Lebanon</option>'+
            '<option value="LS">Lesotho</option>'+
            '<option value="LR">Liberia</option>'+
            '<option value="LY">Libya</option>'+
            '<option value="LI">Liechtenstein</option>'+
            '<option value="LT">Lithuania</option>'+
            '<option value="LU">Luxembourg</option>'+
            '<option value="MO">Macao</option>'+
            '<option value="MK">Macedonia, the former Yugoslav Republic of</option>'+
            '<option value="MG">Madagascar</option>'+
            '<option value="MW">Malawi</option>'+
            '<option value="MY">Malaysia</option>'+
            '<option value="MV">Maldives</option>'+
            '<option value="ML">Mali</option>'+
            '<option value="MT">Malta</option>'+
            '<option value="MH">Marshall Islands</option>'+
            '<option value="MQ">Martinique</option>'+
            '<option value="MR">Mauritania</option>'+
            '<option value="MU">Mauritius</option>'+
            '<option value="YT">Mayotte</option>'+
            '<option value="MX">Mexico</option>'+
            '<option value="FM">Micronesia, Federated States of</option>'+
            '<option value="MD">Moldova, Republic of</option>'+
            '<option value="MC">Monaco</option>'+
            '<option value="MN">Mongolia</option>'+
            '<option value="ME">Montenegro</option>'+
            '<option value="MS">Montserrat</option>'+
            '<option value="MA">Morocco</option>'+
            '<option value="MZ">Mozambique</option>'+
            '<option value="MM">Myanmar</option>'+
            '<option value="NA">Namibia</option>'+
            '<option value="NR">Nauru</option>'+
            '<option value="NP">Nepal</option>'+
            '<option value="NL">Netherlands</option>'+
            '<option value="NC">New Caledonia</option>'+
            '<option value="NZ">New Zealand</option>'+
            '<option value="NI">Nicaragua</option>'+
            '<option value="NE">Niger</option>'+
            '<option value="NG">Nigeria</option>'+
            '<option value="NU">Niue</option>'+
            '<option value="NF">Norfolk Island</option>'+
            '<option value="MP">Northern Mariana Islands</option>'+
            '<option value="NO">Norway</option>'+
            '<option value="OM">Oman</option>'+
            '<option value="PK">Pakistan</option>'+
            '<option value="PW">Palau</option>'+
            '<option value="PS">Palestinian Territory, Occupied</option>'+
            '<option value="PA">Panama</option>'+
            '<option value="PG">Papua New Guinea</option>'+
            '<option value="PY">Paraguay</option>'+
            '<option value="PE">Peru</option>'+
            '<option value="PH">Philippines</option>'+
            '<option value="PN">Pitcairn</option>'+
            '<option value="PL">Poland</option>'+
            '<option value="PT">Portugal</option>'+
            '<option value="PR">Puerto Rico</option>'+
            '<option value="QA">Qatar</option>'+
            '<option value="RE">Réunion</option>'+
            '<option value="RO">Romania</option>'+
            '<option value="RU">Russian Federation</option>'+
            '<option value="RW">Rwanda</option>'+
            '<option value="BL">Saint Barthélemy</option>'+
            '<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>'+
            '<option value="KN">Saint Kitts and Nevis</option>'+
            '<option value="LC">Saint Lucia</option>'+
            '<option value="MF">Saint Martin (French part)</option>'+
            '<option value="PM">Saint Pierre and Miquelon</option>'+
            '<option value="VC">Saint Vincent and the Grenadines</option>'+
            '<option value="WS">Samoa</option>'+
            '<option value="SM">San Marino</option>'+
            '<option value="ST">Sao Tome and Principe</option>'+
            '<option value="SA">Saudi Arabia</option>'+
            '<option value="SN">Senegal</option>'+
            '<option value="RS">Serbia</option>'+
            '<option value="SC">Seychelles</option>'+
            '<option value="SL">Sierra Leone</option>'+
            '<option value="SG">Singapore</option>'+
            '<option value="SX">Sint Maarten (Dutch part)</option>'+
            '<option value="SK">Slovakia</option>'+
            '<option value="SI">Slovenia</option>'+
            '<option value="SB">Solomon Islands</option>'+
            '<option value="SO">Somalia</option>'+
            '<option value="ZA">South Africa</option>'+
            '<option value="GS">South Georgia and the South Sandwich Islands</option>'+
            '<option value="SS">South Sudan</option>'+
            '<option value="ES">Spain</option>'+
            '<option value="LK">Sri Lanka</option>'+
            '<option value="SD">Sudan</option>'+
            '<option value="SR">Suriname</option>'+
            '<option value="SJ">Svalbard and Jan Mayen</option>'+
            '<option value="SZ">Swaziland</option>'+
            '<option value="SE">Sweden</option>'+
            '<option value="CH">Switzerland</option>'+
            '<option value="SY">Syrian Arab Republic</option>'+
            '<option value="TW">Taiwan, Province of China</option>'+
            '<option value="TJ">Tajikistan</option>'+
            '<option value="TZ">Tanzania, United Republic of</option>'+
            '<option value="TH">Thailand</option>'+
            '<option value="TL">Timor-Leste</option>'+
            '<option value="TG">Togo</option>'+
            '<option value="TK">Tokelau</option>'+
            '<option value="TO">Tonga</option>'+
            '<option value="TT">Trinidad and Tobago</option>'+
            '<option value="TN">Tunisia</option>'+
            '<option value="TR">Turkey</option>'+
            '<option value="TM">Turkmenistan</option>'+
            '<option value="TC">Turks and Caicos Islands</option>'+
            '<option value="TV">Tuvalu</option>'+
            '<option value="UG">Uganda</option>'+
            '<option value="UA">Ukraine</option>'+
            '<option value="AE">United Arab Emirates</option>'+
            '<option value="GB">United Kingdom</option>' +
            '<option value="US">United States</option>'+
            '<option value="UM">United States Minor Outlying Islands</option>'+
            '<option value="UY">Uruguay</option>'+
            '<option value="UZ">Uzbekistan</option>'+
            '<option value="VU">Vanuatu</option>'+
            '<option value="VE">Venezuela, Bolivarian Republic of</option>'+
            '<option value="VN">Viet Nam</option>'+
            '<option value="VG">Virgin Islands, British</option>'+
            '<option value="VI">Virgin Islands, U.S.</option>'+
            '<option value="WF">Wallis and Futuna</option>'+
            '<option value="EH">Western Sahara</option>'+
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
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Organisation Name" required>\n' +
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="VAT (if available)">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Organisation Headquarter - House/Building Number" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Organisation Headquarter - Street/Road" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Organisation Headquarter - Town/City" required>\n' +
                '        <input type="hidden" value="IE" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Organisation Headquarter - Country" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="IE">Ireland</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Organisation Headquarter - Eircode" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Legal Representatives - First Name" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Legal Representatives - Last Name" required>\n' +
                '<label>Legal Representatives - Date Of Birth</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Month</option>\n' +
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
                '                                <option value="">Day</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Year</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Legal Representatives - Country" required>\n' +
                '<option value="">Legal Representatives - Country</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Legal Representatives - Nationality" required>\n' +
                '<option value="">Legal Representatives - Nationality</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Mailing Address -House/Building Number" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Mailing Address -Street/Road" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Mailing Address -Town/City" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Mailing Address - Eircode" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="Website URL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Must start with \'www\' and no spaces.\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="First Name" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Last Name" required>\n' +
                '<label>Date Of Birth</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Month</option>\n' +
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
                '                                <option value="">Day</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Year</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="IE" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="Country" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="IE">Ireland</option>' +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Nationality" required>\n' +
                '<option value="">Nationality</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="Business Name" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="VAT (if available)">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="House/Building Number" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Street/Road" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Town/City" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Eircode" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="Website URL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Must include \'www.\' letters.\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Company Name" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="Company Number" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   Must be a 6 digit Ireland company number at least.\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Company Headquarter - House/Building Number" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Company Headquarter - Street/Road" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Company Headquarter - Town/City" required>\n' +
                '        <input type="hidden" value="IE" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Company Headquarter - Country" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="IE">Ireland</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Company Headquarter - Eircode" required>'+
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="VAT (if available)">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Director - First Name" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Director - Last Name" required>\n' +
                '<label>Director - Date Of Birth</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Month</option>\n' +
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
                '                                <option value="">Day</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Year</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Director - Country" required>\n' +
                '<option value="">Director - Country</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="Director - Nationality" required>\n' +
                '<option value="">Director - Nationality</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Mailing Address - House/Building Number" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Mailing Address - Street/Road" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Mailing Address - Town/City" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Mailing Address - Eircode" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="Website URL" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Must start with \'www.\' and no spaces.\n'+
                '</small>\n');
        }
        if($('#user_type').val()=='citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="First Name" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>\n' +
                '                    <label>Date Of Birth</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Month</option>\n' +
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
                '                                <option value="">Day</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">Year</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="IE" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="Country" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="IE">Ireland</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="Nationality" required>\n' +
                '<option value="">Nationality</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="House/Building Number" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="Street/Road" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="Town/City" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="Eircode" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
<?php /**PATH /home/virtual/vps-91c4dd/d/d2263f56e5/public_html/ie/resources/views/auth/register.blade.php ENDPATH**/ ?>