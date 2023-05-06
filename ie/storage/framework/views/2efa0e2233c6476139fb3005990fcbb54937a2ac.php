<?php $__env->startSection('css'); ?>
<style>
    .ion-edit:hover{
        cursor: pointer;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?php echo e(url('advisors/home')); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Direct Connect</a></li>
                </ol>
            </div>
            <h4 class="page-title">Learn about Direct Connect</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body color-black-light">
                <?php echo $data; ?>

            </div>
        </div>

    </div>
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-advisors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/virtual/vps-91c4dd/d/d2263f56e5/public_html/ie/resources/views/front/advisors/direct-connect.blade.php ENDPATH**/ ?>