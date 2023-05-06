<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <title>CONVEY - Conveyable Employment Records are digital files that CONVEY from one employer to the next and are used by businesses looking to improve their Employee Value Proposition.</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
        <?php echo $__env->make('layouts.frontend-head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
<body>
<?php echo $__env->make('layouts.frontend-preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.frontend-topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <?php echo $__env->yieldContent('breadcrumb'); ?>
     <?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('layouts.frontend-footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.frontend-footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ca/resources/views/layouts/frontend-master.blade.php ENDPATH**/ ?>