
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
                    <li class="breadcrumb-item active"><a href="#">Contact Us</a></li>
                </ol>
            </div>
            <h4 class="page-title">Contact Us</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12 bg-white">
        <div id="form_overlay">
            <div class="form_overlay_message">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo" height="50"></a>
                <div style="height: 15px;"></div>
                <span class="m-t-25">Sending the ticket now. Please Wait.</span>
            </div>
        </div>

        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#faq" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">FAQ’s</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#open_new_ticket" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Open New Ticket</span>
                    </a>
                </li>

                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#tickets" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-record"></i></span>
                        <span class="d-none d-sm-inline-block">Tickets</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="faq" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div style="height: 20px;"></div>
                        <div id="accordion">
                            <?php $__currentLoopData = $FAQ; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div class="card-header bg-white border-bottom-0 p-3" id="heading<?php echo e($key); ?>">
                                    <h5 class="m-0 font-16">
                                        <a href="#collapse<?php echo e($key); ?>" class="text-dark" data-toggle="collapse"
                                           aria-expanded="false"
                                           aria-controls="collapse<?php echo e($key); ?>">
                                            <?php echo e($item->question); ?>

                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse<?php echo e($key); ?>" class="collapse"
                                     aria-labelledby="heading<?php echo e($key); ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <?php echo e($item->answer); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane p-3" id="open_new_ticket" role="tabpanel">
                    <div class="table-rep-plugin">
                        <form id="send_message">
                            <div class="form-group row">
                                <label class="col-lg-12 col-form-label font-20 color-black-light">Let us know how we can ...</label>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label color-black-light">Department:</label>
                                <div class="col-lg-6">
                                    <select class="form-control select2" name="department_id" required>
                                        <option value="">Select Department</option>
                                        <?php $index = 0 ?>
                                        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $index++?>
                                            <option value="<?php echo e($item->id); ?>" <?php if($index == 1) echo "selected" ?>><?php echo e($item->department_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" col-form-label color-black-light">Content</label>
                                <textarea name="content" rows="8" class="form-control" required></textarea>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right">
                                    Send
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="tab-pane p-3" id="tickets" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <h6 class="text-center m-t-20 color-black-light">Your Tickets</h6>
                            <table id="ticket_table" class="table table-bordered table-striped m-t-20">
                                <thead>
                                    <tr>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Created</th>
                                        <th class="text-center">Replied On</th>
                                        <th class="text-center">View</th>
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
</div>
<!-- end row -->


<div class="modal fade bs-example-modal-lg" id="ticekt_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title">View Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Question</label>
                    <p class="text-dark" style="word-break: break-all" id="question"></p>

                </div>
                <div class="form-group">
                    <label>Answer</label>
                    <p class="text-dark" style="word-break: break-all"  id="answer" ></p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $('#send_message').on('submit',function(event){
        event.preventDefault();

        $('#form_overlay').delay(350).fadeIn('slow');

        $.ajax({
                url:"<?php echo e(route('contact.send_ticket')); ?>",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
            success:function(data)
            {
                $('#form_overlay').delay(350).fadeOut('slow');

                if(data.success)
                {
                    $('#send_message')[0].reset();
                    alertify.logPosition("top right");
                    alertify.error(data.success);
                    $('#ticket_table').DataTable().ajax.reload();
                }else{
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }

            },
            error:function()
            {
                $('#form_overlay').delay(350).fadeOut('slow');
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })

    })

    $('#ticket_table').DataTable({
        // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "<?php echo e(route('contact.ticket_list')); ?>",
            method:'post',
            data:{
                _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:[
            {
                name: 'Department',
                data: 'department',
                class: 'text-center p-2',

            },
            {
                name: 'Created',
                data: 'created_at',
                class: 'text-center p-2',
                render:function (data, type, row){
                    if(data)
                    return date_format(data);
                }
            },
            {
                name: 'Replied On',
                data: 'replied_at',
                class: 'text-center p-2',
                render:function (data, type, row){
                if(data){
                    if(row.closed_at)
                        return date_format(data);
                    else
                        return date_format(data)+' <span class=" bg-emerald text-white" style="border-radius: 3px;">new</span>'
                }
                else
                    return '';
                }
            },
            {
                name: 'View',
                data: 'id',
                class: 'text-center p-2',
                render: function (data, type, row) {
                  return '<a href="javascript:ticekt_modal('+data+')" class="text-dark edit" >Read Now</a>';

                }

            }
        ]
    });


    function ticekt_modal(id)
    {
        $.ajax({
            url:"<?php echo e(route('contact.get_ticket')); ?>",
            method:"POST",
            data: {
                id:id,
            },
            dataType:"json",
            success:function(html){
                $('#question').html(html.question);
                $('#answer').html(html.answer);
                $('.bs-example-modal-lg').modal('show');
                $('#ticket_table').DataTable().ajax.reload();
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-advisors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/de/resources/views/front/advisors/contact-us.blade.php ENDPATH**/ ?>