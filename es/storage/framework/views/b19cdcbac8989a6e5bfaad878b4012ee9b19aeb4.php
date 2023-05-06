<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>Recupera tus datos</h2>
					<p id="description" class="p-3 text-left">Si has olvidado tus datos de acceso, dinos con qué dirección de correo electrónico te registraste y te los enviaremos por correo electrónico</p>
                    <input type="email" class="form-control" placeholder="Introduce tu dirección de correo electrónico" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">Recuperar</a>
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
                    $('#description').html('Comprobaremos nuestra base de datos y si el correo electrónico introducido está asociado a una cuenta, te enviaremos tu contraseña a esa dirección de correo electrónico .... Por favor, deja pasar 5 minutos para que llegue el correo electrónico.')
                }
            })
        } else {

        }

    }
</script>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/auth/retrieval.blade.php ENDPATH**/ ?>