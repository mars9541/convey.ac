<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>Ihre Details wiederherstellen</h2>
					<p id="description" class="p-3 text-left">Wenn Sie Ihre Anmeldedaten vergessen haben, teilen Sie uns einfach mit, mit welcher E-Mail Adresse
                        Sie sich angemeldet haben und wir senden Ihnen diese per E-Mail zu</p>
                    <input type="email" class="form-control" placeholder="Geben Sie Ihre E-Mail-ID ein" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">Wiederherstellen</a>
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
                    $('#description').html('Wir überprüfen unsere Datenbank und wenn diese E-Mail mit einem Konto verbunden ist, senden wir Ihr Passwort an diese E-Mail-Adresse .... Bitte warten Sie 5 Minuten, bis die E-Mail bei Ihnen ankommt.')
                }
            })
        } else {

        }

    }
</script>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/auth/retrieval.blade.php ENDPATH**/ ?>