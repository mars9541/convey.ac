<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>

.text-convey-green {
  color: #3bc850!important;
}
</style>
<section class="login">
        <div class="container login-container">
            <div class="loginPage loginForm">
                <div class="logo">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo"></a>
                </div>
                <form action="<?php echo e(route('login_user')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                <div class="loginDetail">
                    <div class="loginDetail-inner" style="max-width: 440px;">
                        <h2>ANMELDEN</h2>
                        <?php if($errors->has('email')): ?>
                        <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Warnung!</strong> <?php echo e($errors->first('email')); ?>

                        </div>
                        <?php endif; ?>
                        <?php if(session('captch_error')): ?>
                            <div class="col-sm-12 alert alert-convey-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo e(session('captch_error')); ?>

                            </div>
                        <?php endif; ?>
						<select class="form-control" id="country" required>
							<option value="">Wählen Sie Ihr Land</option>
							<?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->country_code); ?>"<?php echo e(app()->getLocale() == $c->country_code ? 'selected' : ''); ?>><?php echo e($c->country_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
                        <input type="email" class="form-control" name="email" placeholder="Geben Sie Ihre E-Mail Adresse ein" required value="<?php echo e(old('email')); ?>">
						<input type="password" name="password" class="form-control" placeholder="Geben Sie Ihr Passwort ein">
                        <img id="captcha" src="<?php echo e(url('vendor')); ?>/securimage/securimage_show.php" alt="CAPTCHA Image" />
                        <input type="text" name="captcha_code" size="28" maxlength="6" required placeholder="Lösen und geben Sie die obige Summe ein" style="padding-inline:5px;" autocomplete="off"/>
                        <a href="#" onclick="document.getElementById('captcha').src = '<?php echo e(url('vendor')); ?>/securimage/securimage_show.php?' + Math.random(); return false" class="text-convey-green">Ändern Sie das Bild</a>
                    </div>
                </div>
                <div class="loginBottom" style="width: 440px;">
					<button  class="btn btn-primary submitBtn">ANMELDEN</button>
					<a href="<?php echo e(route('login_retrieval')); ?>" class="clickhere text-convey-green" >Klicken Sie hier, um Ihre Daten abzurufen</a>
                </div>
                </form>
            </div>
        </div>
    </section>
    <script>
    $('#country').change(function (){
            if($('#country').val()!=''){
                var locale = "<?php echo e(app()->getLocale()); ?>";
                locale = "/" + locale + "/";
                var change_country_code = "/" + $('#country').val() + "/";
                var url = window.location.href;
                if($('#country').val() != locale){
                    var url = url.replace(locale, change_country_code);
                    window.location.href = url;
                }
            }
        })

    </script>
  </body>
</html>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/auth/login.blade.php ENDPATH**/ ?>