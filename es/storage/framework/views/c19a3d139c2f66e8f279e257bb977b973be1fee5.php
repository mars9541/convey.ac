<?php $__env->startSection('css'); ?>
    <style>
        .loading-show2 {
            display: inline-block;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="padding-top-large"></div>

    <div class="bussiness-contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="business-title-middle">
                        <h2>Ponte en contacto y hablemos...</h2>
                        <span class="title-border-middle"></span>
                    </div>
                    <br>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore euismod magna.</p>   -->

                        </div>
                        <?php if(session('captch_error')): ?>
                            <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo e(session('captch_error')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="user_name" placeholder="Tu nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" id="user_email" placeholder="Tu correo electrónico">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" class="form-control" id="user_number" placeholder="Número de teléfono">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="user_message" rows="3" placeholder="Tu mensaje"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-1">

                            <img id="captcha" src="<?php echo e(url('vendor')); ?>/securimage/securimage_show.php" alt="CAPTCHA Image" />
                            <input type="text" name="captcha_code" id="captcha_code" size="28" maxlength="6" required placeholder="Resuelve e introduce la suma anterior" style="padding-inline:5px;" autocomplete="off"/>
                            <a href="#" onclick="document.getElementById('captcha').src = '<?php echo e(url('vendor')); ?>/securimage/securimage_show.php?' + Math.random(); return false" class="text-convey-green">cambiar la imagen</a>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn bussiness-btn-larg" id="btn_send_message">
                                    <div style="display:none;" class="loading-show2">
                                                <span class="spinner-border spinner-border-sm" role="status"
                                                      aria-hidden="true"></span>
                                    </div> &nbsp;enviar mensaje
                                </button>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h4 style="line-height: 160%;">Nuestro equipo es 100% humano (aquí no hay bots) y estará siempre dispuesto a responder a tus preguntas</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-sc">
                                <img src="<?php echo e(asset('landing_front')); ?>/images/team/team-1.jpg">
                                <span>Jeanette</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-sc">
                                <img src="<?php echo e(asset('landing_front')); ?>/images/team/team-2.jpg">
                                <span>Alisha</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-sc">
                                <img src="<?php echo e(asset('landing_front')); ?>/images/team/team-3.jpg">
                                <span>James</span>
                            </div>
                        </div>
                    </div>
                    <p style="text-align: center;">Los miembros del equipo están disponibles de 9h a 16h de lunes a viernes</p>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
    <div class="padding-top-large"></div>

    <div class="business-cta-2x">
        <div class="business-cta-2-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="business-cta-left-2">
                            <h2>Un Gran Salto Adelante ...</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="business-cta-right-2">
                            <a href="<?php echo e(route('register')); ?>" class=" btn bussiness-btn-larg">ACTUALIZAR AHORA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).on('input', '#user_name', function () {
            $('#user_name').css('box-shadow', '');
            $('#user_name').css('margin-bottom', '');
        });

        $(document).on('input', '#user_email', function () {
            $('#user_email').css('box-shadow', '');
            $('#user_email').css('margin-bottom', '');
        });

        $(document).on('input', '#user_message', function () {
            $('#user_message').css('box-shadow', '');
            $('#user_message').css('margin-bottom', '');
        });

        $(document).on('input', '#captcha_code', function () {
            $('#captcha_code').css('box-shadow', '');
            $('#captcha_code').css('margin-bottom', '');
        });

        $('#btn_send_message').on('click', function () {
            $('.loading-show2').show();
            $('#btn_send_message').prop('disabled', true);

            var error_flag = 0;

            if($('#user_name').val() == "") {
                $('#user_name').css('box-shadow', '0px 0px 4px red');
                $('#user_name').css('margin-bottom', '0px');
                error_flag = 1;
            } else {
                $('#user_name').css('box-shadow', '');
                $('#user_name').css('margin-bottom', '');
            }

            if($('#user_email').val() == "") {
                $('#user_email').css('box-shadow', '0px 0px 4px red');
                $('#user_email').css('margin-bottom', '0px');
                error_flag = 1;
            } else {
                $('#user_email').css('box-shadow', '');
                $('#user_email').css('margin-bottom', '');
            }

            if($('#user_message').val() == "") {
                $('#user_message').css('box-shadow', '0px 0px 4px red');
                $('#user_message').css('margin-bottom', '0px');
                error_flag = 1;
            } else {
                $('#user_message').css('box-shadow', '');
                $('#user_message').css('margin-bottom', '');
            }

            if($('#captcha_code').val() == "") {
                $('#captcha_code').css('box-shadow', '0px 0px 4px red');
                error_flag = 1;
            } else {
                $('#captcha_code').css('box-shadow', '');
            }

            if(error_flag == 1) {
                $('#btn_send_message').prop('disabled', false);
                $('.loading-show2').hide();
                $("html, body").animate({scrollTop: 0}, "slow");

                return false;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "<?php echo e(route('send_contact_message')); ?>",
                method: "POST",
                data: {
                    user_name: $('#user_name').val(),
                    user_email: $('#user_email').val(),
                    user_number: $('#user_number').val(),
                    user_message: $('#user_message').val(),
                    captcha_code: $('#captcha_code').val()
                },
                dataType: "json",
                success: function (res) {
                    $('.loading-show2').hide();
                    $('#btn_send_message').prop('disabled', false);

                    if(res.status == "Message Sent") {
                        $('#user_name').val('');
                        $('#user_email').val('');
                        $('#user_number').val('');
                        $('#user_message').val('');
                        $('#captcha_code').val('');

                        alertify.logPosition("bottom right");
                        alertify.success('¡Mensaje enviado!');
                    } else {
                        alertify.logPosition("bottom right");
                        alertify.error(res.status);
                    }

                },
                error: function () {
                    $('.loading-show2').hide();
                    $('#btn_send_message').prop('disabled', false);
                    alertify.logPosition("bottom right");
                    alertify.error('¡Error del servidor!');
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/front/getintouch.blade.php ENDPATH**/ ?>