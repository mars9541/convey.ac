<!-- jQuery  -->
<script src="<?php echo e(URL::asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/modernizr.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/waves.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.nicescroll.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.scrollTo.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/sweet-alert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')); ?>"></script>
<!--Chartist Chart-->
<!-- <script src="<?php echo e(URL::asset('plugins/chartist/js/chartist.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js')); ?>"></script> -->

<!-- KNOB JS -->
<script src="<?php echo e(URL::asset('plugins/jquery-knob/excanvas.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jquery-knob/jquery.knob.js')); ?>"></script>

<script src="<?php echo e(URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/alertify/js/alertify.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- Responsive-table-->
<!-- Dashboard init -->
<!-- <script src="<?php echo e(URL::asset('assets/pages/dashboard.js')); ?>"></script> -->
<script>
	$.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
	$(document).ajaxError(function(event, jqxhr, settings, exception) {

	    if (exception == 'unknown status') {
	        // Prompt user if they'd like to be redirected to the login page
             window.location = '<?php echo e(route("login")); ?>';
	     }
    });

	// disable datatables error prompt
	// $.fn.dataTable.ext.errMode = 'none';

	function date_format(data)
	{
		var y = data.substr(0,4);
        var m = data.substr(5,2);
        var d = data.substr(8,2);
        return m+'/'+d+'/'+y;
	}
</script>
 <?php echo $__env->yieldContent('script'); ?>

<!-- App js -->
<script src="<?php echo e(URL::asset('assets/js/app.js')); ?>"></script>

<?php echo $__env->yieldContent('script-bottom'); ?>

<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ca/resources/views/layouts/footer-script.blade.php ENDPATH**/ ?>