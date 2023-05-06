<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Convey</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
        <?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </head>
<body class="fixed-left">
<?php echo $__env->make('layouts.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="wrapper">
  <?php echo $__env->make('layouts.topbar_business_branch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.sidebar_business_branch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="content-page">
        <div class="content">
            <div class="page-content-wrapper">
              <div class="container-fluid">
                 <?php echo $__env->yieldContent('breadcrumb'); ?>
                 <?php echo $__env->yieldContent('content'); ?>
              </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
  </div>
</div>
    <?php echo $__env->make('layouts.footer-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
    </body>
</html><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/layouts/master-business-branch.blade.php ENDPATH**/ ?>