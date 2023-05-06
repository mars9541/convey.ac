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
                    <!-- <li class="breadcrumb-item"><a href="<?php echo e(url('business/home')); ?>">Home</a></li> -->
                    </ol>
                </div>
                <h4 class="page-title"></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-body p-0">
                    <div class="form-group">
                    <span type="button" class="btn waves-effect waves-light mt-1 offset-sm-2 col-md-8 color-black-light" style="font-size: 30px; font-weight: bolder;" >
                        Welcome to Your CONVEY Account...
                    </span>
                    </div>

                    <div class="form-group row m-b-0" style="padding-left: 8px; padding-right: 8px;">
                        <div class="col-md-12 text-center">
                            <div class="alert  <?php echo e($confirm->email=='yes'?'alert-convey-success bg-convey-green':'alert-convey-danger bg-rich-red'); ?> text-white" role="alert">
                                <img src="<?php echo e($confirm->email=='yes'?asset('assets/images/checkmark.png'):asset('assets/images/question-mark.png')); ?>" style="width: 30px;">
                                <?php echo e($confirm->email=='yes'?'You’ve confirmed your email address':'You’ve not yet confirmed your email address: '); ?>

                                <?php if($confirm->email=='no'): ?>
                                    <a href="javascript:view_guide_detail('how_to_email_verify')" class="text-white">(learn why)</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="alert  text-white <?php echo e($confirm->record=='yes'?'alert-convey-success bg-convey-green':'alert-convey-danger bg-rich-red'); ?>" role="alert">
                                <img src="<?php echo e($confirm->record=='yes'?asset('assets/images/checkmark.png'):asset('assets/images/question-mark.png')); ?>" style="width: 30px;">
                                <?php echo e($confirm->record=='yes'?'You’ve completed your first record upload': 'You’ve not yet completed your first record upload: '); ?>

                                <?php if($confirm->record=='no'): ?>
                                    <a href="javascript:view_guide_detail('how_to_record_upload')" class="text-white">(find out how)</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="alert <?php echo e($confirm->search=='yes'?'alert-convey-success bg-convey-green':'alert-convey-danger bg-rich-red'); ?> text-white" role="alert">
                                <img src="<?php echo e($confirm->search=='yes'?asset('assets/images/checkmark.png'):asset('assets/images/question-mark.png')); ?>" style="width: 30px;">
                                <?php echo e($confirm->search=='yes'?'You’ve completed your first search': 'You’ve not yet completed your first search: '); ?>

                                <?php if($confirm->search=='no'): ?>
                                    <a href="javascript:view_guide_detail('how_to_first_search')" class="text-white">(find out how)</a>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="alert  <?php echo e($confirm->referrer=='yes'?'alert-convey-success bg-convey-green':'alert-convey-danger bg-rich-red'); ?> text-white" role="alert">
                                <img src="<?php echo e($confirm->referrer=='yes'?asset('assets/images/checkmark.png'):asset('assets/images/question-mark.png')); ?>" style="width: 30px;">
                                <?php echo e($confirm->referrer=='yes'?'You’ve referred other businesses': 'You’ve not yet referred other businesses: '); ?>

                                <?php if($confirm->referrer=='no'): ?>
                                    <a href="javascript:view_guide_detail('how_to_referre_code')" class="text-white">(learn the benefits)</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card m-b-20 card-body">
                            <h3 class="card-title font-20 mt-0 text-center color-black-light"><?php echo e($item->title); ?></h3>
                            <p class="card-text color-black-light"><?php echo substr(strip_tags($item->description), 0, 300); ?></p>
                            <div class="col-sm-6 offset-sm-6 text-right">
                                <a href="javascript:get_article('<?php echo e($item->id); ?>')" class="card-link text-right color-black-light" ><span class="font-15">Read More...</span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </div><!-- container -->

    <div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="article_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>

                <div class="modal-body">
                    <div class="form-group" id="article_detail">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        function view_guide_detail(input){
            $.ajax({
                url:"<?php echo e(route('business.get_guide_temp')); ?>",
                method:"POST",
                data: {
                    item:input,
                },
                dataType:"json",
                success:function(html){
                    $('#article_title').html('')
                    $('#article_detail').html(html);
                    $('.bs-example-modal-lg').modal('show');
                },
                error:function(){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');

                }
            })
        };

        function get_article(id){
            $.ajax({
                url:"<?php echo e(route('business.get_article')); ?>",
                method:"POST",
                data: {
                    id:id,
                },
                dataType:"json",
                success:function(html){
                    $('#article_title').html(html.title)
                    $('#article_detail').html(html.description);
                    $('.bs-example-modal-lg').modal('show');
                },
                error:function(){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');

                }
            })
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-business', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/virtual/vps-91c4dd/d/d2263f56e5/public_html/es/resources/views/front/business/index.blade.php ENDPATH**/ ?>