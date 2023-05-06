<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <title>CONVEY - Conveyable Employment Records are digital files that CONVEY from one employer to the next and are used by businesses looking to improve their Employee Value Proposition.</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
        <meta property="og:url" name="og_url"           content="<?php echo e(url('/more')); ?>/<?php echo e($gallery_info->id); ?>" />
        <meta property="og:type" name="og_type"          content="website" />
        <meta property="og:title" name="og_title"         content="<?php echo e($gallery_info->gallery_title); ?>" />

        <meta property="og:image" name="og_image"         content="<?php echo e(url('public/upload/images')); ?>/<?php echo e($gallery_info->path_big); ?>" />

        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="<?php echo e(url('/more')); ?>/<?php echo e($gallery_info->id); ?>"/>
        <meta name="twitter:title" content="<?php echo e($gallery_info->gallery_title); ?>"/>

        <meta name="twitter:image" content="<?php echo e(url('public/upload/images')); ?>/<?php echo e($gallery_info->path_big); ?>"/>
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
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/layouts/frontend-master-share.blade.php ENDPATH**/ ?>