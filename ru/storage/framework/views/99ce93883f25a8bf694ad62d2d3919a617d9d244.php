<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>Восстановление личных данных</h2>
					<p id="description" class="p-3 text-left">Если вы забыли данные для входа, просто сообщите нам адрес электронной почты,
                        указанный при регистрации, и мы отправим их вам по электронной почте</p>
                    <input type="email" class="form-control" placeholder="Введите свой адрес электронной почты" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">Восстановить</a>
            </div>
        </div>
    </div>
</section>

<script>
    function send_email()
    {
        if($('#email_address').val()!=""){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
                });
            $.ajax({
                url: "<?php echo e(route('send_password')); ?>",
                method: 'post',
                data: {
                email:$('#email_address').val(),
                },
                success: function(result){
                    $('#description').addClass('bg-convey-green text-white');
                    $('#description').html('Мы проверим нашу базу данных и, если этот адрес электронной почты связан с существующей учетной записью, мы отправим ваш пароль на этот адрес электронной почты…. Письмо будет доставлено в течение 5 минут.')
                }
            })
        } else {

        }

    }
</script>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ru/resources/views/auth/retrieval.blade.php ENDPATH**/ ?>