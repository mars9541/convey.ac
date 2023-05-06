<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>Récupérer vos coordonnées</h2>
					<p id="description" class="p-3 text-left">Si vous avez oublié vos données d'identification, indiquez-nous simplement l'adresse e-mail avec laquelle vous vous êtes inscrit et nous vous les enverrons par e-mail.</p>
                    <input type="email" class="form-control" placeholder="Saisissez votre adresse e-mail" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">Récupérer</a>
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
                    $('#description').html('Nous vérifierons notre base de données et si cet e-mail est associé à un compte, nous enverrons votre mot de passe à cette adresse e-mail .. Merci de patienter 5 minutes avant de recevoir l\'e-mail.')
                }
            })
        } else {

        }

    }
</script>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/fr/resources/views/auth/retrieval.blade.php ENDPATH**/ ?>