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
                    <li class="breadcrumb-item active"><a href="#">HRIS Connect</a></li>
                </ol>
            </div>
            <h4 class="page-title">Learn about HRIS Connect</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">
            <div class="card-body color-black-light">
                <?php echo $data; ?>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs m-t-10" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" data-toggle="tab" href="#software" role="tab" id="software_tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                            <span class="d-none d-sm-inline-block">HRIS Software</span>
                        </a>
                    </li>

                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link text-dark" data-toggle="tab" href="#both" role="tab" id="both_tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-record"></i></span>
                            <span class="d-none d-sm-inline-block">Include ATS/VMS Software providers</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active p-3 " id="software" role="tabpanel">
                        <table id="hris_software_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">HRIS Provider</th>
                                <th class="text-center">Website</th>
                                <th class="text-center">Guide</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane p-3 " id="both" role="tabpanel">
                        <table id="hris_both_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">HRIS Provider</th>
                                <th class="text-center">Website</th>
                                <th class="text-center">Guide</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $('#hris_software_table').DataTable({
            searching: true,
            processing: true,
            serverSide: false,
            paging: true,
            ordering: false,
            info: true,
            autoWidth: false,
            "language": {
                "emptyTable": "<div><span class='pr-3'>Details Awaiting Approval</span><img src='https://gifimage.net/wp-content/uploads/2018/11/waiting-icon-gif.gif' width='40px'> </div>" +
                    "<div><span class='pr-3'>Details Awaiting Approval</span><img src='https://gifimage.net/wp-content/uploads/2018/11/waiting-icon-gif.gif' width='40px'> </div>" +
                    "<div><span class='pr-3'>Details Awaiting Approval</span><img src='https://gifimage.net/wp-content/uploads/2018/11/waiting-icon-gif.gif' width='40px'> </div>"
            },

            ajax:{
                url: "<?php echo e(route('advisors.get_hris')); ?>",
                method:'post',
                data: function ( d ) {
                    d.filter = 'software';
                },
            },
            columns:[
                {
                    name: 'HRIS Provider',
                    data: 'ocb_name',
                    class: 'text-center',
                },
                {
                    name: 'Website',
                    data: 'website',
                    class: 'text-center',
                },
                {
                    name: 'Guide',
                    data: 'hris_guide',
                    class: 'text-center',
                    render: function (data, type, row) {
                        return '<a href="<?php echo e(url("public/upload")); ?>/'+data+'" target="_blank"><img src="<?php echo e(asset("assets/images/pdf.png")); ?>" width="30px"></a>';
                    }
                }
            ]
        });

        $('#hris_both_table').DataTable({
            searching: true,
            processing: true,
            serverSide: false,
            paging: true,
            ordering: false,
            info: true,
            autoWidth: false,
            "language": {
                "emptyTable": "<div><span class='pr-3'>Details Awaiting Approval</span><img src='https://gifimage.net/wp-content/uploads/2018/11/waiting-icon-gif.gif' width='40px'> </div>" +
                    "<div><span class='pr-3'>Details Awaiting Approval</span><img src='https://gifimage.net/wp-content/uploads/2018/11/waiting-icon-gif.gif' width='40px'> </div>" +
                    "<div><span class='pr-3'>Details Awaiting Approval</span><img src='https://gifimage.net/wp-content/uploads/2018/11/waiting-icon-gif.gif' width='40px'> </div>"
            },

            ajax:{
                url: "<?php echo e(route('advisors.get_hris')); ?>",
                method:'post',
                data: function ( d ) {
                    d.filter = 'both';
                },
            },
            columns:[
                {
                    name: 'HRIS Provider',
                    data: 'ocb_name',
                    class: 'text-center',
                },
                {
                    name: 'Website',
                    data: 'website',
                    class: 'text-center',
                },
                {
                    name: 'Guide',
                    data: 'hris_guide',
                    class: 'text-center',
                    render: function (data, type, row) {
                        return '<a href="<?php echo e(url("public/upload")); ?>/'+data+'" target="_blank"><img src="<?php echo e(asset("assets/images/pdf.png")); ?>" width="30px"></a>';
                    }
                }
            ]
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-advisors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ca/resources/views/front/advisors/hris-connect.blade.php ENDPATH**/ ?>