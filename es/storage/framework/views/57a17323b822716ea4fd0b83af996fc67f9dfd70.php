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

                </ol>
            </div>
            <h4 class="page-title"></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="row top_pad">
            <div class="col-md-7">
                <div class="card m-b-20">
                    <div class="card-body p-0">
                        <div class="form-group text-center">
                            <span type="button" class="btn waves-effect waves-light mt-1" >
                                <h4 class="font-30 color-black-light"  style="font-size: 30px; font-weight: bolder;">Welcome to Your CONVEY Account...</h4>
                            </span>
                        </div>

                        <div class="form-group row m-b-0" style="padding-left: 8px; padding-right: 8px;     margin-inline: 15px;">
                            <div class="col-md-12 text-center">
                                <div class="alert  <?php echo e($confirm->email=='yes'?'alert-convey-success bg-convey-green':'alert-convey-danger bg-rich-red'); ?> text-white" role="alert">
                                    <img src="<?php echo e($confirm->email=='yes'?asset('assets/images/checkmark.png'):asset('assets/images/question-mark.png')); ?>" style="width: 25px;">
                                    <?php echo e($confirm->email=='yes'?'You’ve confirmed your email address':'You’ve not yet confirmed your email address:'); ?>

                                    <?php if($confirm->email=='no'): ?>
                                    <a href="javascript:view_guide_detail('how_to_email_verify')" class="text-white">(learn why)</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="alert  <?php echo e($confirm->referrer=='yes'?'alert-convey-success bg-convey-green':'alert-convey-danger bg-rich-red'); ?> text-white" role="alert">
                                    <img src="<?php echo e($confirm->referrer=='yes'?asset('assets/images/checkmark.png'):asset('assets/images/question-mark.png')); ?>" style="width: 25px;">
                                    <?php echo e($confirm->referrer=='yes'?'You’ve referred other businesses': 'You’ve not yet referred other businesses:'); ?>

                                    <?php if($confirm->referrer=='no'): ?>
                                    <a href="javascript:view_guide_detail('how_to_referre_code')" class="text-white">(learn the benefits)</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 mb-4 font-30 text-center color-black-light">Referral Stats</h4>
                        <ul class="list-inline widget-chart m-t-20 m-b-15 pt-3 text-center">
                            <li class="list-inline-item">
                                <i class="fa fa-edit (alias) text-convey-green transform-13"></i>
                                <h5 class="mb-0"><?php echo e($total->signup); ?></h5>
                                <p class="text-muted font-14">Total SignUp</p>
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-money text-danger transform-13"></i>
                                <h5 class="mb-0"><?php echo e(round($total->sales,2)); ?></h5>
                                <p class="text-muted font-14">Total Sales</p>
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-percent text-convey-green"></i>
                                <h5 class="mb-0"><?php echo e(round($total->yours, 2)); ?></h5>
                                <p class="text-muted font-14">Your 20%</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <?php $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card m-b-20 card-body">
                    <h3 class="card-title font-20 mt-0 text-center color-black-light"><?php echo e($item->title); ?></h3>
                    <p class="card-text color-black-light"><?php echo e(substr(strip_tags($item->description), 0, 300)); ?></p>
                    <div class="col-sm-6 offset-sm-6 text-right">
                        <a href="javascript:get_article('<?php echo e($item->id); ?>')" class="card-link text-right color-black-light" ><span class="font-15">Read More...</span></a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div><!-- container -->

</div> <!-- Page content Wrapper -->

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
            url:"<?php echo e(route('advisors.get_guide_temp')); ?>",
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
            url:"<?php echo e(route('advisors.get_article')); ?>",
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
    window.onload = function() {
        setTimeout(function(){
            if(window.innerWidth > 600 ){
                var pad = $('.top_pad .card');
                var height1 = $(pad[0]).height();
                var height2 = $(pad[1]).height();
                if(height1 > height2){
                    $(pad[1]).height(height1+'px');
                }
                else{
                    $(pad[0]).height(height2+'px');
                    $(pad[0]).children().css('margin-top',(height2-height1)/2+'px');
                }
            }
        }, 200)
    };


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-advisors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/front/advisors/index.blade.php ENDPATH**/ ?>