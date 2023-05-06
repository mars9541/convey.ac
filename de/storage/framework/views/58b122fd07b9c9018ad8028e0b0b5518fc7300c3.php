<?php $__env->startSection('content'); ?>
    <style>
        div.media:hover {
            cursor: pointer;
        }

        .gallery-title {
            color: #404040!important;
            font-size: 2.3rem!important;
            text-align: center;
        }
    </style>
    <div class="padding-top-large"></div>

    <div class="about-business-2x">
        <div class="container">
            <div class="about-business-content-2x">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="mb-3 gallery-title"><?php echo e($gallery_info->gallery_title); ?></h3>
                        <div class="about-business-right-2x mb-3 py-3">
                            <img class="img-responsive" src="<?php echo e(url('public/upload/images')); ?>/<?php echo e($gallery_info->path_big); ?>" alt="sample image">
                        </div>
                        <div class="about-business-right-2x" style="text-indent: 2rem;">
                            <?php echo $gallery_info->gallery_text; ?>

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-6 col-md-5 pl-0 ml-3" style="border-style: none none solid none; font-size: 13px; border-color: #3bc850;">RECOMMENDED POST</div>
                            <div class="col-5 col-md-6" style="border-style: none none solid none; font-size: 15px;border-color: #dee3e8;"></div>
                        </div>
                        <?php if($recommend_info): ?>
                            <div class="media mt-3" onclick="javascript:onDetailPage('<?php echo e($recommend_info->id); ?>')">
                                <img class="mr-3" style="width: 90px; height: 60px;" src="<?php echo e(url('public/upload/images')); ?>/<?php echo e($recommend_info->path_big); ?>" alt="Popular image" height="64">
                                <div class="media-body">
                                    <p class="text-muted" style="font-size: 14px; line-height: 1.5"><?php echo e($recommend_info->gallery_title); ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="media mt-3" onclick="javascript:onDetailPage('<?php echo e($gallery_info->id); ?>')">
                                <img class="mr-3" style="width: 90px; height: 60px;" src="<?php echo e(url('public/upload/images')); ?>/<?php echo e($gallery_info->path_big); ?>" alt="Popular image" height="64">
                                <div class="media-body">
                                    <p class="text-muted" style="font-size: 14px; line-height: 1.5"><?php echo e($gallery_info->gallery_title); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-8">

                        <a href="javascript:void(0)" onclick="face_book()" class="btn waves-effect waves-light" style="background-color: #3b5998; color: white; width: 8rem;">
                            <i class="fa fa-facebook"></i>
                            <span class="hidden-sm">Facebook</span>
                        </a>

                        <a href="javascript:void(0)" onclick="twitter()" class="btn waves-effect waves-light ml-2" style="background-color: #55acee; color: white; width: 8rem;">
                            <i class="fa fa-twitter"></i>
                            <span class="hidden-sm">Twitter</span>
                        </a>

                        <a href="javascript:void(0)" onclick="linkedin()" class="btn waves-effect waves-light ml-2" style="background-color: #0077b5; color: white; width: 8rem;">
                            <i class="fa fa-linkedin"></i>
                            <span class="hidden-sm">Linkedin</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="padding-top-large"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        function face_book(){
            // var imgsrc=document.getElementById("imgfb").src;
            var fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u="+$('meta[name="og_url"]').attr('content') , "pop", "width=600, height=400, scrollbars=no");
            return false;
        }

        function linkedin() {
            var linkedinpopup = window.open("http://www.linkedin.com/shareArticle?mini=true&amp;url="+$('meta[name="og_url"]').attr('content') , "pop", "width=600, height=400, scrollbars=no");
            return false;
        }

        function twitter() {
            var twitterpopup = window.open("https://twitter.com/share?url="+$('meta[name="twitter:site"]').attr('content'), "pop", "width=600, height=400, scrollbars=no");
            return false;
        }

        function onDetailPage(id) {
            window.location.href = '<?php echo e(url('/more')); ?>' + '/' + id;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend-master-share', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/front/detail_more.blade.php ENDPATH**/ ?>