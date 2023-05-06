<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="login">
    <div class="container login-container">
        <div class="loginPage loginForm">
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
            </div>
            <div class="loginDetail">
                <div class="loginDetail-inner">
                    <h2>Recupera i tuoi dati</h2>
					<p id="description" class="p-3 text-left">Se hai dimenticato i dettagli di accesso, indica l’indirizzo email
                        che hai usato per iscriverti e te li invieremo via email
                    </p>
                    <input type="email" class="form-control" placeholder="Inserisci il tuo ID e-mail" id="email_address">
                    <div class="remember">

                    </div>
                </div>
            </div>
            <div class="loginBottom">
				<a href="javascript:send_email()" class="btn btn-primary submitBtn">Recupera</a>
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
                    $('#description').html('Controlleremo il nostro database e se l\'e-mail è associata a un account invieremo la tua password a quell\'indirizzo e-mail… Si prega di attendere 5 minuti per l\'arrivo dell\'e-mail.')
                }
            })
        } else {

        }

    }
</script>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/it/resources/views/auth/retrieval.blade.php ENDPATH**/ ?>