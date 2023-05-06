
<?php $__env->startSection('css'); ?>
<style>
    .ion-edit:hover{
        cursor: pointer;
    }
    .marked{
        color: orange;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="notification-div hide" id="notification_div">

    </div>
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Direct Connect</a></li>
                </ol>
            </div>
            <h4 class="page-title">Direct Connect to the DATABANK</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div id="form_overlay">
            <div class="form_overlay_message">
                <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('front')); ?>/images/logo-dark.png" alt="logo" height="50"></a>
                <div style="height: 15px;"></div>
                <span class="m-t-25">Loading Now. Please Wait.</span>
            </div>
        </div>

        <div class="card m-b-20 text-center">
            <div class="card-body" style="padding: 13px;">
                <p class="m-0 color-black-light">Add and Manage your employees records Here.</p>
            </div>
        </div>

        <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs m-t-10" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#add_new_record" role="tab" id="record_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-edit"></i></span>
                        <span class="d-none d-sm-inline-block">Add New Record</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#tab_employees" role="tab" id="employee_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Employees</span>
                    </a>
                </li>

                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#record_history" role="tab" id="record_history_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-history"></i></span>
                        <span class="d-none d-sm-inline-block">Record History</span>
                    </a>
                </li>

                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#tab_record_types" id="record_type_tab" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-copy"></i></span>
                        <span class="d-none d-sm-inline-block">Record Templates</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="add_new_record" role="tabpanel">
                    <div class="table-rep-plugin">
                        <span id="n_form_result"></span>
                        <form id="new_record_form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="history_id" id="history_id">
                            <div class="form-group m-t-30 row">
                                <label class="col-lg-2 col-form-label text-right color-black-light">Employee:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" id="employees" name="employee_id">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label text-right color-black-light">Record Template:</label>
                                <div class="col-lg-10">
                                    <select class="form-control select2" id="record_types" name="record_type_id">

                                    </select>
                                    <div class="">
                                        <ul class="parsley-errors-list float-left" id="record_types_required">
                                            <li class="parsley-required">This value is required.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text_answer" class="col-lg-2 text-right col-form-label color-black-light">Comments:</label>
                                <div class="col-lg-10">
                                    <textarea id="text_answer" name="RECORD_content" rows="8" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-lg-10">
                                    <button class="btn bg-secondary col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light" id="save_draft">
                                        <i class="fa fa-pencil-square-o"></i> Save as Draft
                                    </button>
                                    <button class="btn bg-rich-red offset-sm-0 offset-md-2 offset-lg-3 col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light"
                                            id="clear_exit"><i class="fa fa-refresh"></i> Clear and Exit
                                    </button>
                                    <button type="submit" class="btn bg-emerald col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light float-right">
                                        <i class="fa fa-save"></i> Add to DATABANK
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="tab-pane p-3 bg-custom-grey" id="tab_employees" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="card m-b-20">
                                <div class="card-body">
                                    <div class="col-md-12 m-t-10">
                                        <h6 class="text-center m-t-30 color-black-light">Add a New Employee</h6>
                                    </div>
                                    <span id="e_form_result"></span>
                                    <form method="post" id="employee_form" class="form-horizontal" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" id="employee_id">
                                    <div class="col-md-12 m-t-30">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="first_name">First name: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="first_name" id="first_name" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="fname_required">
                                                    <li class="parsley-required">This value is required.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="second_name">Second Name: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="second_name" id="second_name" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="sname_required">
                                                    <li class="parsley-required">This value is required.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light" for="dob">Date of Birth: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="date" max="9999-12-31" class="form-control" placeholder="mm/dd/yyyy" name="date_of_birth" id="dob">
                                            <div class="">
                                                <ul class="parsley-errors-list float-left" id="dob_required">
                                                    <li class="parsley-required">This value is required.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-15 display-inline">
                                        <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="ni">SI Number: </label>
                                        <div class="col-md-9 display-inline">
                                            <input type="text" class="form-control" name="NI_Insurance_Number" id="ni" />
                                            <div class="">
                                                <ul class="parsley-errors-list float-left"  id="space_error">
                                                    <li class="parsley-required">This value is not allowed - "space characters".</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 display-inline">
                                        <label class="col-form-label offset-sm-2 p-3 color-black-light display-inline">Date of birth and SI Number can not be edited.</label>
                                    </div>


                                    <div class="col-md-12 m-t-30">
                                        <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light">
                                            Create New Employee
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="text-center m-t-10 color-black-light">Manage Existing Employees</h6>
                                    <div class="col-md-12">
                                        <p class="mb-0 color-black-light">
                                            <i class="ion-edit"></i>: Edit &nbsp;&nbsp;
                                            <i class="ion-trash-a"></i>: Remove &nbsp;&nbsp;
                                        </p>
                                    </div>
                                    <table id="employees_table" class="table table-bordered table-striped m-t-20">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center p-2">David Beckham</td>
                                            <td class="text-center font-20 p-1">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> |
                                                <a href="#" class="text-dark"><i class="ion-trash-a"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center p-2">John Terry</td>
                                            <td class="text-center font-20 p-1  ">
                                                <a href="#" class="text-dark"><i class="ion-edit"></i></a> |
                                                <a href="#" class="text-dark"><i class="ion-trash-a"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane p-3" id="record_history" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2 float-right pr-0">
                            <select class="form-control bg-emerald text-white float-right" id="filter_employee">
                                <option value="all">All Employees</option>
                            </select>
                        </div>

                        

                        <table id="record_history_table" class="table table-bordered table-striped m-t-40 w-100">
                            <thead>
                            <tr>
                                <th class="text-center">Record Template</th>
                                <th class="text-center">Employee</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center p-2">Record Type 1</td>
                                <td class="text-center p-2">David Beckham</td>
                                <td class="text-center p-2">10 08 20</td>
                                <td class="text-center p-2"></td>
                            </tr>
                            <tr>
                                <td class="text-center p-2">Record Type 2</td>
                                <td class="text-center p-2">John Terry</td>
                                <td class="text-center p-2">11 09 20</td>
                                <td class="text-center p-2"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane p-3 bg-custom-grey" id="tab_record_types" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="card" id="recordTem_table_tab">
                                <div class="card-body">
                                    <h6 class="text-center m-t-10 color-black-light">Manage Record Template</h6>
                                    <div class="d-block">
                                        <div class="col-md-12">
                                            <p class="mb-0 color-black-light">
                                                <i class="ion-eye"></i>: View &nbsp;&nbsp;
                                                <i class="ion-printer"></i>: Print &nbsp;&nbsp;
                                            </p>
                                        </div>
                                        <table id="record_type_table" class="table table-bordered table-striped m-t-20">
                                            <thead>
                                            <tr>
                                                <th class="text-center" width="10%">No</th>
                                                <th class="text-center">Template Name</th>
                                                <th class="text-center" width="15%">Template Type</th>
                                                <th class="text-center" width="17%">Manage</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div >
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

    </div>
</div>
<!-- end row -->


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Record Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <p id="record_history_content"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-emerald col-sm-2 text-white waves-effect" data-dismiss="modal">Close</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="questionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="questionModalLabel">Record Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="record_template_view">


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
    var m_exception_flag = 0;   //When comment is exist, do not send get_qa_type_info if record type is plain.
    var m_draft_flag = 0;   //When draft is exist, the change event of record type don't have to work.
    var m_question_count = 0;
    var m_answer_count = 0;
    var m_current_record_type = 0;

    $(document).ready(function(){
        first_load();
        $('#n_form_result').empty();
        $('#history_id').val('');

        // $('#text_answer').val('');
    })

    function show_notification() {
        $('#notification_div').removeClass('hide');
        setTimeout(hidden_notification, 5000);
    }

    function hidden_notification() {
        $('#notification_div').addClass('hide');
    }

    function first_load(){
        $('#form_overlay').delay(350).fadeIn('slow');

        $.ajax({
            url: "<?php echo e(route('branch.get_employees')); ?>",
            method: "POST",
            dataType: "json",
            success:function(html)
            {
                $('#employees').empty();
                if(html.data.length > 0)
                {
                    var options = '';

                    for (var i = 0; i < html.data.length; i++) {
                        options +='<option value='+html.data[i].id+'>'+html.data[i].first_name+' '+html.data[i].second_name+'</option>'
                    }

                    $('#employees').append(options);
                    $('#filter_employee').append(options);
                }

                $.ajax({
                    url: "<?php echo e(route('branch.get_record_types')); ?>",
                    method: "POST",
                    dataType: "json",
                    success:function(html)
                    {
                        if(html.data.length > 0)
                        {
                            $('#record_types').empty();

                            var options = '<option value=0></option>';
                            for (var i = 0; i < html.data.length; i++) {
                                options += '<option value=' + html.data[i].id + ' record_type=' + html.data[i].type_mode + '>' + html.data[i].record_type + '</option>'
                            }

                            $('#record_types').append(options);

                            var draft_info = '<?php echo e($draft->RECORD_content); ?>';

                            if(draft_info != '') {
                                m_draft_flag = 1;

                                var html_content = '<?php echo e($draft->RECORD_content); ?>';
                                html_content = html_content.replace(/&lt;/g, "<");
                                html_content = html_content.replace(/&gt;/g, ">");
                                html_content = html_content.replace(/&quot;/g, "\"");
                                html_content = html_content.replace(/&amp;nbsp;/g, " ");
                                $('#text_answer').summernote('code', html_content);
                                $('#employees').val('<?php echo e($draft->NI_identity_number); ?>').change();
                                $('#employees').attr('disabled', 'disabled');
                                $('#record_types').val('<?php echo e($draft->connection_type); ?>').change();
                                $('#record_types').attr('disabled', 'disabled');

                                var text_content = $('#text_answer').summernote('code');
                                var search_string_question = 'contenteditable="false"';

                                m_question_count = text_content.split(search_string_question).length - 1;
                                m_answer_count = (text_content.match(/>A:/g) || []).length;

                                var create_date = new Date('<?php echo e($draft->time_stamp); ?>'),
                                    month = '' + (create_date.getMonth() + 1),
                                    day = '' + create_date.getDate(),
                                    year = create_date.getFullYear();
                                var create_time = '<?php echo e($draft->time_stamp); ?>';
                                create_time = create_time.split(" ")[1];

                                if (month.length < 2) {
                                    month = '0' + month;
                                }

                                if (day.length < 2) {
                                    day = '0' + day;
                                }

                                var created_date = 'Draft record last saved: ' + day + '/' + month + '/' + year + " " + create_time;
                                var html = '<div class="alert alert-convey-danger">' + created_date + '</div>';
                                $('#n_form_result').html(html);

                            } else {
                                var record_type = $('#record_types option:selected').attr('record_type');
                                /*
                                    * when record type is plain, fill the comments with blank
                                    * when record type is QA, fill the comments with QA data from ajax request.
                                 */
                                if(record_type == 0) {
                                    $('#text_answer').summernote('code', '<p><br></p>');
                                } else if(record_type == 1) {
                                    $.ajax({
                                        url: "<?php echo e(route('branch.get_qa_type_info')); ?>",
                                        method: "POST",
                                        data:
                                            {
                                                parent_id: $('#record_types').val()
                                            },
                                        dataType: "json",
                                        success:function(html)
                                        {
                                            $('#text_answer').summernote('code', html.data);
                                        }
                                    })
                                }
                            }

                        }

                        $('#form_overlay').delay(350).fadeOut('slow');
                    }
                })

            }
        })
    }

    $('#text_answer').summernote({
        height: 200,
        toolbar: false,
        // airMode: true
        callbacks: {
            onKeyup: function(e) {
                var text_content = $('#text_answer').summernote('code');
                var search_string = 'contenteditable="false"';
                var question_count = text_content.split(search_string).length - 1;
                var answer_count = (text_content.match(/>A:/g) || []).length;

                if(e.which == 8 || e.which == 46) {
                    if(m_current_record_type == 1 && question_count != m_question_count) {
                        $('#text_answer').summernote('undo');
                    }

                    if(m_current_record_type == 1 && answer_count != m_answer_count) {
                        $('#text_answer').summernote('undo');
                    }
                }

                setTimeout(function(){

                },200);
            }
        }
    })

    function reload_employees(){
        $.ajax({
            url: "<?php echo e(route('branch.get_employees')); ?>",
            method: "POST",
            dataType: "json",
            success:function(html)
            {
                $('#employees').empty();
                $('#filter_employee').empty();
                if(html.data.length > 0)
                {
                    var options = '';

                    for (var i = 0; i < html.data.length; i++) {
                        options +='<option value='+html.data[i].id+'>'+html.data[i].first_name+' '+html.data[i].second_name+'</option>'
                    }

                    $('#employees').append(options);
                    $('#filter_employee').append('<option value="all">All Employees</option>');
                    $('#filter_employee').append(options);
                }
            }
        })
    }

    function get_record_types(){
        $.ajax({
            url: "<?php echo e(route('branch.get_record_types')); ?>",
            method: "POST",
            dataType: "json",
            success:function(html)
            {
                if(html.data.length > 0)
                {
                    $('#record_types').empty();

                    var options = '<option value=0></option>';
                    for (var i = 0; i < html.data.length; i++) {
                        options += '<option value=' + html.data[i].id + ' record_type=' + html.data[i].type_mode + '>' + html.data[i].record_type + '</option>'
                    }

                    $('#record_types').append(options);

                    var draft_info = '<?php echo e($draft->RECORD_content); ?>';

                    if(draft_info != '') {
                        m_draft_flag = 1;

                        var html_content = '<?php echo e($draft->RECORD_content); ?>';
                        html_content = html_content.replace(/&lt;/g, "<");
                        html_content = html_content.replace(/&gt;/g, ">");
                        html_content = html_content.replace(/&quot;/g, "\"");
                        html_content = html_content.replace(/&amp;nbsp;/g, " ");
                        $('#text_answer').summernote('code', html_content);
                        $('#employees').val('<?php echo e($draft->NI_identity_number); ?>').change();
                        $('#record_types').val('<?php echo e($draft->connection_type); ?>').change();

                        var text_content = $('#text_answer').summernote('code');
                        var search_string_question = 'contenteditable="false"';

                        m_question_count = text_content.split(search_string_question).length - 1;
                        m_answer_count = (text_content.match(/>A:/g) || []).length;

                        var create_date = new Date('<?php echo e($draft->time_stamp); ?>'),
                            month = '' + (create_date.getMonth() + 1),
                            day = '' + create_date.getDate(),
                            year = create_date.getFullYear();
                        var create_time = '<?php echo e($draft->time_stamp); ?>';
                        create_time = create_time.split(" ")[1];

                        if (month.length < 2) {
                            month = '0' + month;
                        }

                        if (day.length < 2) {
                            day = '0' + day;
                        }

                        var created_date = 'Draft record last saved: ' + month + '/' + day + '/' + year + " " + create_time;
                        var html = '<div class="alert alert-convey-danger">' + created_date + '</div>';
                        $('#n_form_result').html(html);
                    } else {
                        var record_type = $('#record_types option:selected').attr('record_type');
                        /*
                            * when record type is plain, fill the comments with blank
                            * when record type is QA, fill the comments with QA data from ajax request.
                         */
                        if(record_type == 0) {
                            $('#text_answer').summernote('code', '<p><br></p>');
                        } else if(record_type == 1) {
                            $.ajax({
                                url: "<?php echo e(route('branch.get_qa_type_info')); ?>",
                                method: "POST",
                                data:
                                    {
                                        parent_id: $('#record_types').val()
                                    },
                                dataType: "json",
                                success:function(html)
                                {
                                    $('#text_answer').summernote('code', html.data);
                                }
                            })
                        }
                    }

                }
            }
        })
    }



    $('#record_types').on('change', function () {
        // if(m_draft_flag == 0) {
        //     return false;
        // }
        var record_type = $('#record_types option:selected').attr('record_type');
        /*
            * when record type is plain, fill the comments with blank
            * when record type is QA, fill the comments with QA data from ajax request.
         */
        if($('#history_id').val() == '') {
            if($('#record_types').val() == 0) {
                $('#text_answer').summernote('code', '<p><br></p>');
            } else {
                $('#record_types_required').removeClass('filled');

            }

            if(record_type == 0 && m_exception_flag == 1 && m_draft_flag == 0) {
                $('#text_answer').summernote('code', '');

                if(record_type == 1) {
                    m_exception_flag = 1;
                } else {
                    m_exception_flag = 0;
                }
            } else if(record_type == 1 && m_draft_flag == 0) {
                m_current_record_type = 1;

                $.ajax({
                    url:"<?php echo e(route('branch.get_qa_type_info')); ?>",
                    method:"POST",
                    data:
                        {
                            parent_id: $('#record_types').val()
                        },
                    dataType:"json",
                    success:function(html)
                    {
                        $('#text_answer').summernote('code', html.data);

                        var text_content = $('#text_answer').summernote('code');
                        var search_string = 'contenteditable="false"';

                        m_question_count = text_content.split(search_string).length - 1;
                        m_answer_count = (text_content.match(/>A:/g) || []).length;

                        if(record_type == 1) {
                            m_exception_flag = 1;
                        } else {
                            m_exception_flag = 0;
                        }

                    }
                })
            }
        } else {
            var text_content = $('#text_answer').summernote('code');
            var search_string_question = 'contenteditable="false"';

            m_question_count = text_content.split(search_string_question).length - 1;
            m_answer_count = (text_content.match(/>A:/g) || []).length;
        }

    })



    $('#new_record_form').on('submit', function(event){
        event.preventDefault();

        $('#record_types').removeAttr('disabled');
        $('#employees').removeAttr('disabled');

        var error_detect = 0;
        var record_type = $('#record_types option:selected').attr('record_type');

        if($('#record_types').val() == 0) {
            $('#record_types_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#record_types_required').removeClass('filled');
        }

        if(error_detect == 1) {
            return false;
        }

        var formdata = new FormData(this);
        var text_answer_code = $('#text_answer').summernote('code');
        formdata.append('RECORD_content', text_answer_code);

        if(record_type == 1) {
            var text_content = $('#text_answer').summernote('code');
            var search_string = 'contenteditable="false"';
            var question_count = text_content.split(search_string).length - 1;
            var answer_count = (text_content.match(/>A:/g) || []).length;

            if(m_question_count != question_count) {
                var deleted_questions_count = m_question_count - question_count;

                if(deleted_questions_count > 1) {
                    alert('You deleted ' + deleted_questions_count + ' questions, please press the \'red button\' below to clear the screen, then reselect the record template and start again.');
                } else {
                    alert('You deleted one question, please press the \'red button\' below to clear the screen, then reselect the record template and start again.');
                }

                return false;
            }

            if(m_answer_count != answer_count) {
                alert('Please complete all answers. Thanks.');
                return false;
            }

            if(text_answer_code.match(/>A:\<\/p>/g)) {
                alert('Please complete all answers. Thanks.');
                return false;
            }
        } else {
            var condition_flag = '<p data-nsfw-filter-status="swf"><br></p>';
            var condition_flag1 = '<p><br></p>';

            if(condition_flag == text_answer_code || condition_flag1 == text_answer_code) {
                console.log('Please fill the comments');
                return false;
            }
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You want to save this record, once created records cannot be edited or deleted.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, I am sure.",
            cancelButtonText: "No, continue editing."
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?php echo e(route('branch.record_add')); ?>",
                    method: "POST",
                    data: formdata,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success:function(data)
                    {
                        var html = '';
                        if(data.errors)
                        {
                            html = '<div class="alert alert-convey-danger">';
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                html += '<p>' + data.errors[count] + '</p>';
                            }
                            html += '</div>';
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            $('#new_record_form')[0].reset();
                            $('#text_answer').summernote('code', '<p><br></p>');
                            m_draft_flag = 0;
                        }

                        $('#n_form_result').html(html);
                        setTimeout(function () {
                            $('#n_form_result').empty();
                        }, 5000);
                        $('#history_id').val('');
                        $('#save_draft').removeAttr('hidden');

                    }
                })

            }
        });

    })

    $('#clear_exit').on('click', function () {
        $('#record_types').val(0);
        $('#text_answer').summernote('code', '<p><br></p>');
        $('#record_types').removeAttr('disabled');
        $('#employees').removeAttr('disabled');
        $('#n_form_result').empty();
        $('#history_id').val('');
        m_draft_flag = 0;
        document.getElementById("save_draft").style.visibility = "visible";

        $.ajax({
            url:"<?php echo e(route('branch.clear_draft')); ?>",
            method:"POST",
            dataType:"json",
            success:function(data)
            {

            }
        })

        return false;
    })

    $('#save_draft').on('click', function(){
        if($('#text_answer').summernote('code') == '<p><br></p>') {
            return false;
        }

        $.ajax({
            url:"<?php echo e(route('branch.save_draft')); ?>",
            method:"POST",
            data: {
                    _token: $('meta[name="_token"]').attr('content'),
                    employee_id : $('#employees').val(),
                    record_type_id : $('#record_types').val(),
                    RECORD_content : $('#text_answer').summernote('code')
            },
            dataType:"json",
            success:function(data)
            {
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-convey-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                        html += '</div>';
                }
                if(data.success)
                {
                    html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                    // $('#new_record_form')[0].reset();
                }

                $('#n_form_result').html(html);
                setTimeout(function () {
                    $('#n_form_result').empty();
                }, 5000);
                // $('#history_id').val('');
            }
        })


        return false;
    })

    $(document).on('click', 'input[type=checkbox]', function () {
        var checkbox_name = this.name;
        $('input[name='+ checkbox_name + ']').each(function() {
            $(this).removeAttr('checked');
        })

        if($(this).prop('checked') == true) {
            $(this).attr("checked", "checked");
        }
    })

    $(document).on('click', 'input[type=radio]', function () {
        var radio_name = this.name;
        $('input[name='+ radio_name + ']').each(function() {
            $(this).removeAttr('checked');
        })

        if($(this).prop('checked') == true) {
            $(this).attr("checked", "checked");
        }
    })

    $(document).on('click', 'p>span', function () {
        var star_array = $(this).parent().find('span');
        var class_name = $(this).attr('class');
        var current_star = $(this)[0];
        $('p>span').each(function() {
            if($(this).attr('class') == class_name) {
                $(this).removeClass('marked');
            }

        })

        for (var i = 0; i < star_array.length; i++) {
            if(star_array[i] == current_star) {
                var current_star_index = i;
            }
        }

        for (var j = 0; j < star_array.length; j++) {
            if(j<current_star_index+1) {
                if(star_array[j].classList.value == "fa fa-star") {
                    $(star_array[j]).addClass("marked");
                }
            }
        }
    })
</script>


<script>
    // jQuery('#dob').datepicker({
    //         autoclose: true,
    //         todayHighlight: true
    //     });
    $('#employees_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "<?php echo e(route('branch.employee_list')); ?>",
            method: 'post',
            data: {
                    _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:
            [
                {
                    name: 'Name',
                    data: 'first_name',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                      return row.first_name + ' ' + row.second_name;
                    }
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                      return '<a href="javascript:edit_employee(\''+data+'\')" class="text-dark edit" ><i class="ion-edit"></i></a> |  ' +
                          '<a href="javascript:delete_employee(\''+data+'\')" class="text-dark"><i class="ion-trash-a"></i></a>';
                    }
                }
            ]
        });

    $('#employee_tab').click(function() {
        $('#employees_table').DataTable().ajax.reload();
    })

    $('#first_name').on('input',function() {
        $('#fname_required').removeClass('filled');
    })

    $('#second_name').on('input',function() {
        $('#sname_required').removeClass('filled');
    })

    $('#dob').on('input',function() {
        $('#dob_required').removeClass('filled');
    })

    $('#ni').on('input',function(e) {
        var NI_number = $('#ni').val();
        var NI_min_number = <?php echo e($NI_min_number); ?>;
        if(NI_number.search(' ') > 0) {
            $('#space_error').addClass('filled');
            $('#space_error li').html('This value is not allowed - "space characters".');
        } else if(NI_number.length < NI_min_number) {
            $('#space_error').addClass('filled');
            $('#space_error li').html('The SI Number for the Canada is set so it must be at least ' + NI_min_number + ' characters long.');
        } else {
            $('#space_error').removeClass('filled');
        }
    })

    $('#employee_form').on('submit', function(event) {
        event.preventDefault();
        var error_detect = 0;
        var NI_number = $('#ni').val();
        var NI_min_number = <?php echo e($NI_min_number); ?>;

        if($('#first_name').val() == '') {
            $('#fname_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#fname_required').removeClass('filled');
        }

        if($('#second_name').val() == ''){
            $('#sname_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#sname_required').removeClass('filled');
        }

        if($('#dob').val() == '') {
            $('#dob_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#dob_required').removeClass('filled');
        }

        if(NI_number == '') {
            $('#space_error').addClass('filled');
            $('#space_error li').html('The SI Number for the Canada is set so it must be at least '+'<?php echo e($NI_min_number); ?>'+' characters long.');
            error_detect = 1;
        } else {
            $('#space_error').removeClass('filled');
        }

        if(NI_number.search(' ') > 0) {
            error_detect = 1;
        } else if(NI_number.length < NI_min_number) {
            error_detect = 1;
        }

        if(error_detect == 1) {
            return false;
        }

        if($('#employee_id').val() == '')
        {
            $.ajax({
                url: "<?php echo e(route('branch.employee_add')); ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-convey-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                            html += '</div>';
                    }

                    if(data.success)
                    {
                        html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                        $('#employee_form')[0].reset();
                        $('#employee_id').val('');
                        $('#employees_table').DataTable().ajax.reload();
                        reload_employees();

                        if(data.email_sent_flag == 'true') {
                            setTimeout(show_notification, 10000);
                        }
                    }

                    $('#e_form_result').html(html);
                    setTimeout(function () {
                        $('#e_form_result').empty();
                    }, 5000);
                }
            })
        }

        if($('#employee_id').val() != "")
        {
            $.ajax({
                url: "<?php echo e(route('branch.employee_update')); ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-convey-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }

                    if(data.success)
                    {
                        html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                        $('#employee_form')[0].reset();

                        $('#employee_id').val('');
                        $('#employees_table').DataTable().ajax.reload();
                        reload_employees();
                    }

                    $('#e_form_result').html(html);
                    setTimeout(function () {
                        $('#e_form_result').empty();
                    }, 5000);
                }
            });

        }

        $("#dob").removeAttr('readonly');
        $('#ni').removeAttr('readonly');
    });


    function edit_employee(id) {
        $('#e_form_result').html('');
        $.ajax({
            url:"<?php echo e(url('branch/get_employee')); ?>/" + id,
            dataType:"json",
            success:function(html) {
                $('#first_name').val(html.data.first_name);
                $('#second_name').val(html.data.second_name);
                $('#dob').val(html.data.dob).click();
                $('#ni').val(html.data.NI_Insurance_Number);
                $('#employee_id').val(html.data.id);
                // if(html.used==true)
                // {
                    $("#dob").attr('readonly','readonly');
                    $('#ni').attr('readonly','readonly');
                // }else{
                //     $("#dob").removeAttr('readonly');
                //     $('#ni').removeAttr('readonly');
                // }

            }
        })
    }


    function delete_employee(id) {
        $('#e_form_result').html('');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3bc850",
            cancelButtonColor: "#ec4561",
            confirmButtonText: "Yes, delete it!"
          }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?php echo e(url('branch/delete_employee')); ?>/" + id,
                    dataType: "json",
                    success:function(data) {
                        var html = '';
                        if(data.success)
                        {
                            Swal.fire("Deleted!", data.success, "success");
                            // html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            $('#employee_form')[0].reset();
                            $('#employee_id').val('');
                            $('#employees_table').DataTable().ajax.reload();
                            reload_employees();
                        }

                        if(data.warning)
                        {
                            Swal.fire("Cancelled!", data.warning, "error");
                            // html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                        }
                    }
                })

            }
        });

    }
</script>

<script>
    $('#filter_employee').on('change',function(){
        $('#record_history_table').DataTable().ajax.reload();
    })

    $('#record_history_table').DataTable({
        // lengthMenu: false,
        "processing": true,
        "serverSide": true,
        searching: false,
        ajax: {
            url: "<?php echo e(route('branch.record_history_list')); ?>",
            method: 'post',
            data: function ( d ) {
                d.filter = $('#filter_employee').val();
            },
        },
        columns:
            [
                {
                    name: 'Record Type',
                    data: 'record_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'Employee',
                    data: 'full_name',
                    class: 'text-center p-2',
                },
                {
                    name: 'Date Created',
                    data: 'record_date',
                    class: 'text-center p-2',
                },
                {
                    name: 'View',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(row.max_version == 'yes') {
                            if(row.full_name == "Employee Off-boarded") {
                                return '<a href="javascript:view_record(\''+data+'\')" class="text-dark"><i class="ion-eye"></i></a> | ' +
                                    '<a href="<?php echo e(url("branch/recordHistoryDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                            } else {
                                return '<a href="javascript:view_record(\''+data+'\')" class="text-dark"><i class="ion-eye"></i></a> | ' +
                                    '<a href="javascript:edit_record(\''+data+'\')" class="text-dark edit" ><i class="ion-edit"></i></a> | ' +
                                    '<a href="<?php echo e(url("branch/recordHistoryDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                            }

                        } else {
                            return '<a href="javascript:view_record(\'' + data + '\')" class="text-dark"><i class="ion-eye"></i></a> | ' +
                                '<a href="<?php echo e(url("branch/recordHistoryDownload")); ?>/'+data+'" title="Print" class="text-dark"><i class="ion-printer"></i></a>';
                        }
                    }
                }
            ]
        });

    $('#record_history_tab').click(function() {
        $('#record_history_table').DataTable().ajax.reload();
    })

    function view_record(id)
    {
        $.ajax({
            url: "<?php echo e(url('branch/get_record_history_content')); ?>/" + id,
            dataType: "json",
            success:function(html) {
                $('#record_history_content').html(html.data.content);
                $('#myModal').modal('show');
            }
        })
    }

    function edit_record(id)
    {
        var draft_info = '<?php echo e($draft->RECORD_content); ?>';

        if(draft_info != '') {
            Swal.fire({
                title: "Are you sure?",
                text: "You have a record saved as a draft. This action will delete it. \n Please confirm you want to proceed.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3bc850",
                cancelButtonColor: "#ec4561",
                confirmButtonText: "Yes, I am sure.",
            }).then(function (result) {
                if (result.value) {
                    m_draft_flag = 0;
                    $('#n_form_result').empty();
                    get_record_history_content(id);
                }
            });
        } else {
            get_record_history_content(id);
        }


    }

    function get_record_history_content(id) {
        $.ajax({
            url: "<?php echo e(url('branch/get_record_history_content')); ?>/" + id,
            dataType: "json",
            success:function(html) {
                $('#history_id').val(html.data.id);
                $('#text_answer').summernote('code', html.data.content)
                $('#employees').val(html.data.employee.id).change();
                $('#record_types').val(html.data.record_type.id).change();
                $('#employees').attr('disabled', 'disabled');
                $('#record_types').attr('disabled', 'disabled');
                document.getElementById("save_draft").style.visibility = "hidden";
                $('#record_tab').click();
            }
        })
    }

</script>
<script>
    $('#record_type_table').DataTable({
        // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "<?php echo e(route('branch.get_record_types')); ?>",
            method: 'post',
            data: {
                _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:
        [
            {
                name: 'No',
                data: 'index',
                class: 'text-center p-2',
            },
            {
                name: 'Name',
                data: 'record_type',
                class: 'text-center p-2',
            },
            {
                name: 'Name',
                data: 'type_mode',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    if(row.type_mode =='0')
                        return 'Plain';
                    else
                        return 'Q & A';
                }
            },
            {
                name: 'Manage',
                data: 'id',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    // if(row.type_mode == 0)
                    //     return '';
                    // else
                        return '<a href="javascript:view_record_type(\''+data+'\')" class="text-dark edit" ><i class="ion-eye"></i></a> | ' +
                            '<a href="<?php echo e(url("branch/recordTemplateDownload")); ?>/'+data+'" class="text-dark"><i class="ion-printer"></i></a>';
                }
            }
        ]
    });

    function view_record_type(id)
    {
        $.ajax({
            url: "<?php echo e(route('branch.get_qa_type_info')); ?>",
            method: "POST",
            data: {
                parent_id: id
            },
            dataType:"json",
            success:function(html)
            {
                $('#record_template_view').html(html.data);
                $('#questionModalLabel').text(html.record_title);
                $('#questionModal').modal('show');
            }
        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-business-branch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ca/resources/views/front/branch/direct-connect.blade.php ENDPATH**/ ?>