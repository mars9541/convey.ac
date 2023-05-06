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
              <span class="m-t-25">Creación de cuenta en progreso <br> Por favor, espera.</span>
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

                    <strong>¡Atención!</strong><span id="alert_text"> Por favor, rellena todos los datos requeridos.</span>
                </div>
                <div class="loginDetail-inner " id="step_1">
                    <h2><?php echo e(__('REGÍSTRATE AHORA')); ?> <span>(PASO 1 DE 4)</span></h2>
                    <select class="form-control" id="country" required>
                        <option value="">¿A qué país deseas acceder?</option>
                        <?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($c->country_code == 'ru'): ?>
                                <?php continue; ?>;
                            <?php endif; ?>
                        <option value="<?php echo e($c->country_code); ?>"><?php echo e($c->country_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <select class="form-control" required name="user_type" id="user_type">
                        <option value=""> ¿Qué tipo de cuenta deseas?</option>
                        <option value="business"> Una para empresas (añadir y buscar registros)</option>
                        <option value="advisors"> Una para Consultores/Desarrolladores/Asesores/Escritores</option>
                        <option value="hris"> Una para proveedores de software HRIS/ATS/VMS</option>
                        <option value="citizen"> Una para mí mismo/a para poder encontrar mis registros personales</option>
                    </select>
                    <div class="col-md-12 test-font-16 hidden" id="hris_radio">
                        <div>
                            <input type="radio" name="hris_type"  id="a" checked  value="software">
                            <label for="a" > Solo proporcionamos software HRIS </label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="b" value="tracking">
                            <label for="b"> Solo proporcionamos software ATS o VMS</label>
                        </div>
                        <div>
                            <input type="radio" name="hris_type"  id="c" value="both">
                            <label for="c"> Proporcionamos una combinación de los anteriores</label>
                        </div>
                    </div>
                    <div class="col-md-12 test-font-16 hidden" id="advisors_radio">
                        <div>
                            <input type="radio" name="advisors_type"  id="aa" checked  value="developer">
                            <label for="aa" > Desarrollamos sistemas de negocio/software</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="bb" value="advisor">
                            <label for="bb"> Proporcionamos asesoramiento empresarial</label>
                        </div>
                        <div>
                            <input type="radio" name="advisors_type"  id="cc" value="writer">
                            <label for="cc"> Escribimos artículos relacionados con los negocios</label>
                        </div>
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_2">
                    <h2>REGÍSTRATE AHORA <span>(Paso 2 de 4)</span></h2>
                    <select class="form-control" name="business_type" required id="business_type">
                        <option value="">¿Qué tipo de negocio eres?</option>
                        <option value="company"> Empresa</option>
                        <option value="organisation"> Organización</option>
                        <option value="selfemployed">Autónomo</option>
                    </select>
                    <select class="form-control" name="market" required id="market">
                        <option value="">¿En qué mercado estás?</option>
                        <?php $__currentLoopData = $market; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m->market_value); ?>"><?php echo e($m->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                    <select class="form-control" name="employees" required id="employees">
                        <option value="">¿Cuántos empleados tienes?</option>
                        <option value="1-9">1-9</option>
                        <option value="10-99">10-99</option>
                        <option value="100-250">100-250</option>
                        <option value="251+">251+</option>
                    </select>
                </div>
                <div class="loginDetail-inner hidden" id="step_3">
                    <h2>REGÍSTRATE AHORA <span>(Paso 3 de 4)</span></h2>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Introduce tu dirección de correo electrónico" required autocomplete="off">
                    <small style="display: none;" id="free_email_error" class="text-danger">No puedes utilizar una dirección de correo electrónico gratuita.
                    </small>
                    <input type="password" name="password" class="form-control" placeholder="Elige una contraseña" id="password" required>
                    <label class="note">Las contraseñas deben tener 8 caracteres o más</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la contraseña" id="password_confirmation" required>
                    <input type="text" name="referral_code" class="form-control" placeholder="Código de referido (si alguien te ha dado uno)" id="referral_code">
                    <div class="remember">
                    </div>
                </div>
                <div class="loginDetail-inner hidden" id="step_4">
                    <h2>REGÍSTRATE AHORA <span>(último paso)</span></h2>
                    <div id="change_detail">
                        <input type="text" class="form-control" name="firstname" placeholder="Nombre" required>
                        <input type="text" class="form-control" name="lastname" placeholder="Apellidos" required>
                        <label>Fecha de nacimiento</label>
                        <div class="row col-sm-12" style="margin-bottom: 20px;">

                            <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">
                                <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">
                                    <option value="">Mes</option>
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
                                    <option value="">Día</option>

                                </select>
                            </div>
                            <div class="col-sm-4 offset-1 form-control">
                                <select class="select2" name="year" id="year" required>
                                   <option value="">Año</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="country" placeholder="País" required>
                        <input type="text" class="form-control" name="nationality" placeholder="Nacionalidad" required>
                        <input type="text" class="form-control" name="ma_HBN" placeholder="Número de Casa/Edificio" required>
                        <input type="text" class="form-control" name="ma_street" placeholder="Calle/Avenida/Carretera" required>
                        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Población/Ciudad" required>
                        <input type="text" class="form-control" name="ma_postcode" placeholder="Código postal" required>
                    </div>
                    <div class="remember">
                        <input type="checkbox" name="check1" class="rem_me" required id="confidentiality">
                        <label for="confidentiality">Acuerdo de confidencialidad</label>
                        <a href="javascript:view_guide_detail('confidentiality_agreement')" class="text-convey-green">Ver aquí</a>
                        <br>
                        <input type="checkbox" name="check2" class="rem_me" required id="terms">
                        <label for="terms"> Términos y Condiciones</label>
                        <a href="javascript:view_guide_detail('terms_and_conditions')" class="text-convey-green">Ver aquí</a>
                        <br>
                        <input type="checkbox" name="check3" class="rem_me" required id="privacy">
                        <label for="privacy">Acuerdo de privacidad </label>
                        <a href="javascript:view_guide_detail('privacy_agreement')" class="text-convey-green">Ver aquí</a>
                    </div>

                </div>
                <button type="submit" class="hidden" id="submitBtn"></button>
            </div>
            </form>
            <div class="loginBottom">
                <button type="button" class="btn btn-primary submitBtn">Continuar</button>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                    $('#business_type').append('<option value="">¿Qué tipo de negocio eres?</option>\n' +
                        '                        <option value="company"> Empresa</option>\n' +
                        '                        <option value="organisation"> Organización</option>');
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
                        },
                        success: function (result) {
                            if (result.status == false) {
                                $('#alert').addClass('hidden');
                                if (check_password())
                                    check_referral_code();
                            } else if(result.status == true) {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('¡Este correo electrónico ya existe!');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            } else {
                                $('#alert').removeClass('hidden');
                                $('#alert').addClass('show');
                                $('#alert_text').html('En lugar de crear manualmente esta cuenta, acceda a su cuenta existente y active el "acceso por país" para que todas sus cuentas estén vinculadas.');
                                $('#alert').focus();
                                $("html, body").animate({scrollTop: 0}, "slow");
                                return false;
                            }
                        }
                    })
                } else {
                    $('#alert').removeClass('hidden');
                    $('#alert').addClass('show');
                    $('#alert_text').html('¡Introduce un correo electrónico válido!');
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
                $('#alert_text').html('¡Introduce una contraseña de confirmación válida!');
                $('#alert').focus();
                return false;
            }
        } else {
            $('#alert').removeClass('hidden');
            $('#alert').addClass('show');
            $('#alert_text').html('Las contraseñas deben tener 8 caracteres o más');
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
                        $('#alert_text').html('¡Código de referido inválido!');
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
        var countries = '<option value="ES">España</option>'+
            '<option value="AF">Afganistán</option>'+
            '<option value="AX">AX Islas Åland</option>'+
            '<option value="AL">Albania</option>'+
            '<option value="DZ">Argelia</option>'+
            '<option value="AS">Samoa Americana</option>'+
            '<option value="AD">Andorra</option>'+
            '<option value="AO">Angola</option>'+
            '<option value="AI">Anguila</option>'+
            '<option value="AQ">Antártida</option>'+
            '<option value="AG">Antigua y Barbuda</option>'+
            '<option value="AR">Argentina</option>'+
            '<option value="AM">Armenia</option>'+
            '<option value="AW">Aruba</option>'+
            '<option value="AU">Australia</option>'+
            '<option value="AT">Austria</option>'+
            '<option value="AZ">Azerbaiyán</option>'+
            '<option value="BS">Bahamas</option>'+
            '<option value="BH">Bahréin</option>'+
            '<option value="BD">Bangladesh</option>'+
            '<option value="BB">Barbados</option>'+
            '<option value="BY">Bielorrusia</option>'+
            '<option value="BE">Bélgica</option>'+
            '<option value="BZ">Belice</option>'+
            '<option value="BJ">Benín</option>'+
            '<option value="BM">Bermudas</option>'+
            '<option value="BT">Bután</option>'+
            '<option value="BO">Bolivia, Estado Plurinacional de</option>'+
            '<option value="BQ">Bonaire, San Eustaquio y Saba</option>'+
            '<option value="BA">Bosnia y Herzegovina</option>'+
            '<option value="BW">Botsuana</option>'+
            '<option value="BV">Isla Bouvet</option>'+
            '<option value="BR">Brasil</option>'+
            '<option value="IO">Territorio Británico del Océano Índico</option>'+
            '<option value="BN">Brunei Darussalam</option>'+
            '<option value="BG">Bulgaria</option>'+
            '<option value="BF">Burkina Faso</option>'+
            '<option value="BI">Burundi</option>'+
            '<option value="KH">Camboya</option>'+
            '<option value="CM">Camerún</option>'+
            '<option value="CA">Canadá</option>'+
            '<option value="CV">Cabo Verde</option>'+
            '<option value="KY">Islas Caimán</option>'+
            '<option value="CF">República Centroafricana</option>'+
            '<option value="TD">Chad</option>'+
            '<option value="CL">Chile</option>'+
            '<option value="CN">China</option>'+
            '<option value="CX">Isla de Navidad</option>'+
            '<option value="CC">Islas Cocos (Keeling)</option>'+
            '<option value="CO">Colombia</option>'+
            '<option value="KM">Comoros</option>'+
            '<option value="CG">Congo</option>'+
            '<option value="CD">República Democrática del Congo</option>'+
            '<option value="CK">Islas Cook</option>'+
            '<option value="CR">Costa Rica</option>'+
            '<option value="CI">Costa de Marfil</option>'+
            '<option value="HR">Croacia</option>'+
            '<option value="CU">Cuba</option>'+
            '<option value="CW">Curazao</option>'+
            '<option value="CY">Chipre</option>'+
            '<option value="CZ">República Checa</option>'+
            '<option value="DK">Dinamarca</option>'+
            '<option value="DJ">Yibuti</option>'+
            '<option value="DM">Dominica</option>'+
            '<option value="DO">República Dominicana</option>'+
            '<option value="EC">Ecuador</option>'+
            '<option value="EG">Egipto</option>'+
            '<option value="SV">El Salvador</option>'+
            '<option value="GQ">Guinea Ecuatorial</option>'+
            '<option value="ER">Eritrea</option>'+
            '<option value="EE">Estonia</option>'+
            '<option value="ET">Etiopía</option>'+
            '<option value="FK">Islas Malvinas</option>'+
            '<option value="FO">Islas Feroe</option>'+
            '<option value="FJ">Fiyi</option>'+
            '<option value="FI">Finlandia</option>'+
            '<option value="FR">Francia</option>'+
            '<option value="GF">Guayana Francesa</option>'+
            '<option value="PF">Polinesia Francesa</option>'+
            '<option value="TF">Territorios Franceses del Sur</option>'+
            '<option value="GA">Gabón</option>'+
            '<option value="GM">Gambia</option>'+
            '<option value="GE">Georgia</option>'+
            '<option value="DE">Alemania</option>'+
            '<option value="GH">Ghana</option>'+
            '<option value="GI">Gibraltar</option>'+
            '<option value="GR">Grecia</option>'+
            '<option value="GL">Groenlandia</option>'+
            '<option value="GD">Grenada</option>'+
            '<option value="GP">Guadeloupe</option>'+
            '<option value="GU">Guam</option>'+
            '<option value="GT">Guatemala</option>'+
            '<option value="GG">Guernsey</option>'+
            '<option value="GN">Guinea</option>'+
            '<option value="GW">Guinea-Bissau</option>'+
            '<option value="GY">Guyana</option>'+
            '<option value="HT">Haití</option>'+
            '<option value="HM">Isla Heard e Islas McDonald</option>'+
            '<option value="VA">Santa Sede (Estado de la Ciudad del Vaticano)</option>'+
            '<option value="HN">Honduras</option>'+
            '<option value="HK">Hong Kong</option>'+
            '<option value="HU">Hungría</option>'+
            '<option value="IS">Islandia</option>'+
            '<option value="IN">India</option>'+
            '<option value="ID">Indonesia</option>'+
            '<option value="IR">Irán, República Islámica de</option>'+
            '<option value="IQ">Irak</option>'+
            '<option value="IE">Irlanda</option>'+
            '<option value="IM">Isla de Man</option>'+
            '<option value="IL">Israel</option>'+
            '<option value="IT">Italia</option>'+
            '<option value="JM">Jamaica</option>'+
            '<option value="JP">Japón</option>'+
            '<option value="JE">Jersey</option>'+
            '<option value="JO">Jordania</option>'+
            '<option value="KZ">Kazajstán</option>'+
            '<option value="KE">Kenia</option>'+
            '<option value="KI">Kiribati</option>'+
            '<option value="KP">Corea, República Popular Democrática de</option>'+
            '<option value="KR">Corea, República de</option>'+
            '<option value="KW">Kuwait</option>'+
            '<option value="KG">Kirguistán</option>'+
            '<option value="LA">República Democrática Popular de Laos</option>'+
            '<option value="LV">Letonia</option>'+
            '<option value="LB">Líbano</option>'+
            '<option value="LS">Lesoto</option>'+
            '<option value="LR">Liberia</option>'+
            '<option value="LY">Libia</option>'+
            '<option value="LI">Liechtenstein</option>'+
            '<option value="LT">Lituania</option>'+
            '<option value="LU">Luxemburgo</option>'+
            '<option value="MO">Macao</option>'+
            '<option value="MK">Macedonia, Antigua República Yugoslava de</option>'+
            '<option value="MG">Madagascar</option>'+
            '<option value="MW">Malawi</option>'+
            '<option value="MY">Malasia</option>'+
            '<option value="MV">Maldivas</option>'+
            '<option value="ML">Malí</option>'+
            '<option value="MT">Malta</option>'+
            '<option value="MH">Islas Marshall</option>'+
            '<option value="MQ">Martinica</option>'+
            '<option value="MR">Mauritania</option>'+
            '<option value="MU">Mauricio</option>'+
            '<option value="YT">Mayotte</option>'+
            '<option value="MX">México</option>'+
            '<option value="FM">Micronesia, Estados Federados de</option>'+
            '<option value="MD">Moldavia, República de</option>'+
            '<option value="MC">Mónaco</option>'+
            '<option value="MN">Mongolia</option>'+
            '<option value="ME">Montenegro</option>'+
            '<option value="MS">Montserrat</option>'+
            '<option value="MA">Marruecos</option>'+
            '<option value="MZ">Mozambique</option>'+
            '<option value="MM">Myanmar</option>'+
            '<option value="NA">Namibia</option>'+
            '<option value="NR">Nauru</option>'+
            '<option value="NP">Nepal</option>'+
            '<option value="NL">Países Bajos</option>'+
            '<option value="NC">Nueva Caledonia</option>'+
            '<option value="NZ">Nueva Zelanda</option>'+
            '<option value="NI">Nicaragua</option>'+
            '<option value="NE">Níger</option>'+
            '<option value="NG">Nigeria</option>'+
            '<option value="NU">Niue</option>'+
            '<option value="NF">Isla de Norfolk</option>'+
            '<option value="MP">Islas Marianas del Norte</option>'+
            '<option value="NO">Noruega</option>'+
            '<option value="OM">Omán</option>'+
            '<option value="PK">Pakistán</option>'+
            '<option value="PW">Palau</option>'+
            '<option value="PS">Territorio Palestino Ocupado</option>'+
            '<option value="PA">Panamá</option>'+
            '<option value="PG">Papúa Nueva Guinea</option>'+
            '<option value="PY">Paraguay</option>'+
            '<option value="PE">Perú</option>'+
            '<option value="PH">Filipinas</option>'+
            '<option value="PN">Pitcairn</option>'+
            '<option value="PL">Polonia</option>'+
            '<option value="PT">Portugal</option>'+
            '<option value="PR">Puerto Rico</option>'+
            '<option value="QA">Qatar</option>'+
            '<option value="RE">Reunión</option>'+
            '<option value="RO">Romania</option>'+
            '<option value="RU">Federación de Rusia</option>'+
            '<option value="RW">Ruanda</option>'+
            '<option value="BL">San Bartolomé</option>'+
            '<option value="SH">Santa Elena, Ascensión y Tristán da Cunha</option>'+
            '<option value="KN">San Cristóbal y Nieves</option>'+
            '<option value="LC">Santa Lucía</option>'+
            '<option value="MF">San Martín (parte francesa)</option>'+
            '<option value="PM">San Pedro y Miquelón</option>'+
            '<option value="VC">San Vicente y las Granadinas</option>'+
            '<option value="WS">Samoa</option>'+
            '<option value="SM">San Marino</option>'+
            '<option value="ST">Santo Tomé y Príncipe</option>'+
            '<option value="SA">Arabia Saudí</option>'+
            '<option value="SN">Senegal</option>'+
            '<option value="RS">Serbia</option>'+
            '<option value="SC">Seychelles</option>'+
            '<option value="SL">Sierra Leone</option>'+
            '<option value="SG">Singapur</option>'+
            '<option value="SX">San Martín (parte holandesa)</option>'+
            '<option value="SK">Eslovaquia</option>'+
            '<option value="SI">Eslovenia</option>'+
            '<option value="SB">Islas Salomón</option>'+
            '<option value="SO">Somalia</option>'+
            '<option value="ZA">Sudáfrica</option>'+
            '<option value="GS">Islas Georgia del Sur y Sandwich del Sur</option>'+
            '<option value="SS">Sudán del Sur</option>'+

            '<option value="LK">Sri Lanka</option>'+
            '<option value="SD">Sudán</option>'+
            '<option value="SR">Surinam</option>'+
            '<option value="SJ">Svalbard y Jan Mayen</option>'+
            '<option value="SZ">Suazilandia</option>'+
            '<option value="SE">Suecia</option>'+
            '<option value="CH">Suiza</option>'+
            '<option value="SY">República Árabe Siria</option>'+
            '<option value="TW">Taiwán, provincia de China</option>'+
            '<option value="TJ">Tayikistán</option>'+
            '<option value="TZ">Tanzania, República Unida de</option>'+
            '<option value="TH">Tailandia</option>'+
            '<option value="TL">Timor Oriental</option>'+
            '<option value="TG">Togo</option>'+
            '<option value="TK">Tokelau</option>'+
            '<option value="TO">Tonga</option>'+
            '<option value="TT">Trinidad y Tobago</option>'+
            '<option value="TN">Túnez</option>'+
            '<option value="TR">Turquía</option>'+
            '<option value="TM">Turkmenistán</option>'+
            '<option value="TC">Islas Turcas y Caicos</option>'+
            '<option value="TV">Tuvalu</option>'+
            '<option value="UG">Uganda</option>'+
            '<option value="UA">Ucrania</option>'+
            '<option value="AE">Emiratos Árabes Unidos</option>'+
            '<option value="GB">Reino Unido</option>' +
            '<option value="US">Estados Unidos</option>'+
            '<option value="UM">Islas menores de Estados Unidos</option>'+
            '<option value="UY">Uruguay</option>'+
            '<option value="UZ">Uzbekistán</option>'+
            '<option value="VU">Vanuatu</option>'+
            '<option value="VE">Venezuela, República Bolivariana de</option>'+
            '<option value="VN">Vietnam</option>'+
            '<option value="VG">Islas Vírgenes Británicas</option>'+
            '<option value="VI">Islas Vírgenes, EE.UU.</option>'+
            '<option value="WF">Wallis y Futuna</option>'+
            '<option value="EH">Sahara Occidental</option>'+
            '<option value="YE">Yemen</option>'+
            '<option value="ZM">Zambia</option>'+
            '<option value="ZW">Zimbabue</option>'
        ;
        $('li').removeClass('active');
        $('#tab_'+(4)).addClass('active');
        $('#step_'+3).addClass('hidden');
        $('#step_'+(4)).removeClass('hidden');

        if($('#business_type').val() == 'organisation')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Nombre de la organización" required>\n' +
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="IVA (si está disponible)">\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Sede de la organización - Número de Casa/Edificio" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Sede de la organización - Calle/Avenida/Carretera" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Sede de la organización - Población/Ciudad" required>\n' +
                '        <input type="hidden" value="ES" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Sede de la organización - País" required disabled>\n' +
                // '<option value="">Organisation Headquarter - Country</option>'+

                '<option value="ES">España</option>' +
                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Sede de la organización - Código postal" required>'+
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Representantes legales - Nombre" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Representantes legales - Apellidos" required>\n' +
                '<label>Representantes legales - Fecha de nacimiento</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mes</option>\n' +
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
                '                                <option value="">Día</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Año</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Legal Representatives - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Representantes legales - País" required>\n' +
                '<option value="">Representantes legales - País</option>'+
                countries +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Representantes legales - Nacionalidad" required>\n' +
                '<option value="">Representantes legales - Nacionalidad</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Dirección postal -Número de Casa/Edificio" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Dirección postal -Calle/Avenida/Carretera" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Dirección postal -Población/Ciudad" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Dirección postal - Código postal" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL del sitio web" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Debe comenzar con "www" y sin espacios.\n'+
                '</small>\n' );
        }


        if($('#business_type').val() == 'selfemployed')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="lrd_firstname" placeholder="Nombre" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Apellido" required>\n' +
                '<label>Fecha de nacimiento</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mes</option>\n' +
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
                '                                <option value="">Día</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Año</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Date Of Birth" required>\n' +
                '        <input type="hidden" value="ES" name="lrd_country">\n' +
                '        <select class="form-control" name="lrd_country_show" placeholder="País" required disabled>\n' +
                // '<option value="">Country</option>'+
                //
                // countries +
                '<option value="ES">España</option>' +
                '</select>' +
                '<select class="form-control"name="lrd_nationality" placeholder="Nacionalidad" required>\n' +
                '<option value="">Nacionalidad</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ocb_name" placeholder="Nombre de la empresa" required>\n' +
                '        <input type="text" class="form-control" name="VAT_if_registered" placeholder="IVA (si está disponible)">\n' +
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Número de Casa/Edificio" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Calle/Avenida/Carretera" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Población/Ciudad" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Código postal" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL del sitio web" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Debe comenzar con "www" y sin espacios.\n'+
                '</small>\n');
        }

        if($('#business_type').val() == 'company')
        {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="ocb_name" placeholder="Nombre de la empresa" required>\n' +
                '        <input type="text" class="form-control" name="company_no" placeholder="Número de empresa" required>\n' +
                '<small style="display: none;" id="company_no_error" class="text-danger">\n'+
                '   Debe ser un número de empresa del España de 9 dígitos como mínimo.\n'+
                '</small>\n' +
                '        <input type="text" class="form-control" name="company_ma_HBN" placeholder="Sede de la empresa - Número de Casa/Edificio" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_street" placeholder="Sede de la empresa - Calle/Avenida/Carretera" required>\n' +
                '        <input type="text" class="form-control" name="company_ma_town_or_city" placeholder="Sede de la empresa - Población/Ciudad" required>\n' +
                '        <input type="hidden" value="ES" name="company_lrd_country">\n' +
                '        <select class="form-control" name="company_lrd_country_show" placeholder="Sede de la empresa - País" required disabled>\n' +
                // '<option value="">Company Headquarter - Country</option>'+

                // countries +
                '<option value="ES">España</option>' +

                '</select>'+
                '        <input type="text" class="form-control" name="company_ma_postcode" placeholder="Sede de la empresa - Código postal" required>'+
                '        <input type="text" class="form-control"name="VAT_if_registered" placeholder="IVA (si está disponible)">\n' +
                '        <input type="text" class="form-control" name="lrd_firstname" placeholder="Director - Nombre" required>\n' +
                '        <input type="text" class="form-control" name="lrd_lastname" placeholder="Director - Apellidos" required>\n' +
                '<label>Director - Fecha de nacimiento</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '                        <div class="col-sm-3 form-control"  style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mes</option>\n' +
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
                '                                <option value="">Día</option>\n' +
                '                                \n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" required id="year" required>\n' +
                '                               <option value="">Año</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                // '        <input type="text" class="form-control" name="lrd_birth_city" placeholder="Director - City Of Birth" required>\n' +
                // '        <select class="form-control" name="lrd_birth_country" placeholder="Director - Country" required>\n' +
                // '<option value="">Director - Birth Country</option>'+

                // countries +
                // '</select>'+

                // '        <input type="text" class="form-control" name="lrd_DOB" id="datepicker" placeholder="Director - Date Of Birth" required>\n' +
                '        <select class="form-control" name="lrd_country" placeholder="Director - País" required>\n' +
                '<option value="">Director - País</option>'+

                countries +
                '</select>'+
                '        <select class="form-control"name="lrd_nationality" placeholder="Director - Nacionalidad" required>\n' +
                '<option value="">Director - Nacionalidad</option>'+

                countries +
                '</select>'+
                '        <input type="text" class="form-control" name="ma_HBN" placeholder="Dirección postal - Número de Casa/Edificio" required>\n' +
                '        <input type="text" class="form-control" name="ma_street" placeholder="Dirección postal - Calle/Avenida/Carretera" required>\n' +
                '        <input type="text" class="form-control" name="ma_town_or_city" placeholder="Dirección postal - Población/ciudad" required>\n' +
                '        <input type="text" class="form-control" name="ma_postcode" placeholder="Dirección postal - Código postal" required>' +
                '        <input type="text" class="form-control" name="website" placeholder="URL del sitio web" required>\n' +
                '<small style="display: none;" id="website_error" class="text-danger">\n'+
                '   Debe comenzar con "www" y sin espacios.\n'+
                '</small>\n');
        }
        if($('#user_type').val() == 'citizen') {
            $('#change_detail').empty();
            $('#change_detail').append('<input type="text" class="form-control" name="firstname" placeholder="Nombre" required>\n' +
                '                    <input type="text" class="form-control" name="lastname" placeholder="Apellidos" required>\n' +
                '                    <label>Fecha de nacimiento</label>\n' +
                '                    <div class="row col-sm-12" style="margin-bottom: 20px;">\n' +
                '\n' +
                '                        <div class="col-sm-3 form-control" style="padding-right:3px; padding-left: 3px;">\n' +
                '                            <select class=" select2" name="month" id="month" required onChange="changeDate(this.options[selectedIndex].value);">\n' +
                '                                <option value="">Mes</option>\n' +
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
                '                                <option value="">Día</option>\n' +
                '\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                        <div class="col-sm-4 offset-1 form-control">\n' +
                '                            <select class="select2" name="year" id="year" required>\n' +
                '                               <option value="">Año</option>\n' +
                '                            </select>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '        <input type="hidden" value="ES" name="country">\n' +

                '        <select class="form-control" name="country_show" placeholder="País" disabled required>\n' +
                // '<option value="">Country</option>'+

                // countries +
                '<option value="ES">España</option>' +

                '</select>'+
                '        <select class="form-control"name="nationality" placeholder="Nacionalidad" required>\n' +
                '<option value="">Nacionalidad</option>'+

                countries +
                '</select>'+
                '                    <input type="text" class="form-control" name="ma_HBN" placeholder="Número de Casa/Edificio" required>\n' +
                '                    <input type="text" class="form-control" name="ma_street" placeholder="Calle/Avenida/Carretera" required>\n' +
                '                    <input type="text" class="form-control" name="ma_town_or_city" placeholder="Población/Ciudad" required>\n' +
                '                    <input type="text" class="form-control" name="ma_postcode" placeholder="Código postal" required>\n' +
                '                    </div>\n' +
                '                    </div>');
        }
        reload();
    }
})
</script>
<?php /**PATH /home/virtual/vps-91c4dd/d/d2263f56e5/public_html/es/resources/views/auth/register.blade.php ENDPATH**/ ?>