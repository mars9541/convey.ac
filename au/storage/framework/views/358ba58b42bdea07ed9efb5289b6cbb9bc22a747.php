<?php $__env->startSection('css'); ?>
    <style>
        .ion-edit:hover{
            cursor: pointer;
        }
        .card a:hover {
            color: #3BC850;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('business/getting-started')); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Getting Started</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Lets Get Started</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20">
                <div class="card-body color-black-light">
                    <?php echo $data; ?>

                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <div class="row top_pad">
                        <div class="col-md-9 row">
                            <div class="col-md-6">
                                <div class="card m-b-20 card-body" style="padding-bottom: 20px">
                                    <h4 class="card-title font-20 mt-0 text-center color-black-light m-b-30">Downloadable Files For Employees</h4>
                                    <ul>
                                        <li class="card-title mt-0 color-black-light">
                                            Introduction to CONVEY <a href="<?php echo e(url('settings/getting_started_download/convey_for_employee')); ?>" class="color-black-light">Leaflet<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                        <li class="card-title mt-0 color-black-light">
                                            Introduction FAQ's <a href="<?php echo e(url('settings/getting_started_download/faq_for_employee')); ?>" class="color-black-light">Leaflet<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-body" style="padding-bottom: 20px">
                                    <h4 class="card-title font-20 mt-0 text-center color-black-light m-b-30">Downloadable Images</h4>
                                    <ul>
                                        <li class="card-title mt-0 color-black-light">
                                            CONVEY connected <a href="<?php echo e(url('settings/getting_started_download/convey_image')); ?>" class="color-black-light">Image<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                        <li class="card-title mt-0 color-black-light">
                                            CONVEY connected <a href="<?php echo e(url('settings/getting_started_download/convey_banner')); ?>" class="color-black-light">Banner<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-body" style="padding-bottom: 20px">
                                    <h4 class="card-title font-20 mt-0 text-center color-black-light m-b-30">Downloadable Files For Managers</h4>
                                    <ul>
                                        <li class="card-title mt-0 color-black-light">
                                            Introduction to CONVEY <a href="<?php echo e(url('settings/getting_started_download/convey_for_manager')); ?>" class="color-black-light">Leaflet<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                        <li class="card-title mt-0 color-black-light">
                                            Introduction to BRANCHES <a href="<?php echo e(url('settings/getting_started_download/branches_for_manager')); ?>" class="color-black-light">Leaflet<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                        <li class="card-title mt-0 color-black-light">
                                            Introduction FAQ's <a href="<?php echo e(url('settings/getting_started_download/faq_for_manager')); ?>" class="color-black-light">Leaflet<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card card-body">
                                    <h4 class="card-title font-20 mt-0 text-center color-black-light m-b-20">Downloadable Usage Example</h4>
                                    <ul style="margin-bottom: 5px;">
                                        <li class="card-title mt-0 color-black-light">
                                            DIRECT CONNECT <a href="<?php echo e(url('settings/getting_started_download/direct_connect_example')); ?>" class="color-black-light">Examples<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                        <li class="card-title mt-0 color-black-light">
                                            HRIS CONNECT <a href="<?php echo e(url('settings/getting_started_download/hris_connect_example')); ?>" class="color-black-light">Examples<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                        <li class="card-title mt-0 mb-0 color-black-light">
                                            API CONNECT <a href="<?php echo e(url('settings/getting_started_download/api_connect_example')); ?>" class="color-black-light">Examples<i class="fa fa-download m-lg-1"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-body" style="height: 100%">
                                <h4 class="card-title font-20 mt-0 text-center color-black-light m-b-30">Downloadable Use Guides</h4>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/decision_tree_diagram')); ?>" class="color-black-light">Decision Tree Diagram</a>
                                </p>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_a1')); ?>" class="color-black-light">Guide A1<i class="fa fa-download m-lg-1"></i></a> &nbsp;&nbsp;
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_a2')); ?>" class="color-black-light" style="visibility: hidden">Guide A2<i class="fa fa-download m-lg-1"></i></a>
                                </p>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_b1')); ?>" class="color-black-light">Guide B1<i class="fa fa-download m-lg-1"></i></a> /
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_b2')); ?>" class="color-black-light">Guide B2<i class="fa fa-download m-lg-1"></i></a>
                                </p>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_c1')); ?>" class="color-black-light">Guide C1<i class="fa fa-download m-lg-1"></i></a> /
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_c2')); ?>" class="color-black-light">Guide C2<i class="fa fa-download m-lg-1"></i></a>
                                </p>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_d1')); ?>" class="color-black-light">Guide D1<i class="fa fa-download m-lg-1"></i></a> /
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_d2')); ?>" class="color-black-light">Guide D2<i class="fa fa-download m-lg-1"></i></a>
                                </p>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_e1')); ?>" class="color-black-light">Guide E1<i class="fa fa-download m-lg-1"></i></a> /
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_e2')); ?>" class="color-black-light">Guide E2<i class="fa fa-download m-lg-1"></i></a>
                                </p>
                                <p class="card-text text-center color-black-light m-b-20">
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_f1')); ?>" class="color-black-light">Guide F1<i class="fa fa-download m-lg-1"></i></a> /
                                    <a href="<?php echo e(url('settings/getting_started_download/guide_f2')); ?>" class="color-black-light">Guide F2<i class="fa fa-download m-lg-1"></i></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
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

<?php echo $__env->make('layouts.master-advisors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/au/resources/views/front/advisors/getting-started.blade.php ENDPATH**/ ?>