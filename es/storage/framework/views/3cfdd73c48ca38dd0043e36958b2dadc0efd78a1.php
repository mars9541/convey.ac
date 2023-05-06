<?php $__env->startSection('content'); ?>
    <style>
        div.col-md-4:hover {
            cursor: pointer;
        }

        .gallery_title {
            color: #404040!important;
            font-size: 1.5rem!important;
            height: 3.75rem;
            text-align: center;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* number of lines to show */
            -webkit-box-orient: vertical;
            padding: 0 2px;
        }

        .gallery_text {
            color: #595959!important;
            font-size: 0.8rem!important;
            height: 3.85rem;
            overflow: hidden;
            text-overflow: fade;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
        }

        .gallery_text > p {
            width: 100%!important;
        }

    </style>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <?php $__currentLoopData = $gallery_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 pr-3 pl-0 pb-3 pt-0" onclick="javascript:onDetailPage('<?php echo e($gallery_info->id); ?>')">
                            <div class="border" style="border-color: #bebfc1!important;">
                                <div class="about-business-right-2x" style="height: 16rem;">
                                    <img class="img-responsive" src="<?php echo e(url('public/upload/images')); ?>/<?php echo e($gallery_info->path_big); ?>" alt="sample image">
                                </div>
                                <h5 class="mt-3 header-title gallery_title"><?php echo e($gallery_info->gallery_title); ?></h5>
                                <div class="about-business-right-2x gallery_text p-2" style="font-size: 14px; line-height: 1.5;">
                                    <?php echo $gallery_info->gallery_text; ?>

                                </div>
                                
                                <div class="col-sm-6 offset-sm-6 text-right mb-3 mt-3">
                                    <a href="javascript:onDetailPage('<?php echo e($gallery_info->id); ?>')" class="card-link text-right color-black-light">
                                    <span style="font-size: 14px; color: #3BC950;">
                                        Read More...
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        function onDetailPage(id) {
            window.location.href = window.location.href + '/' + id;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/es/resources/views/front/more.blade.php ENDPATH**/ ?>