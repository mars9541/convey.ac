<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <title>CONVEY - Departrue Form</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>" />
        <!-- App Icons -->
        <link rel="shortcut icon" href="<?php echo e(asset('front/images/favicon.png')); ?>">

        <?php echo $__env->yieldContent('css'); ?>

        <!-- Basic Css files -->
        <link href="<?php echo e(asset('plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('plugins/sweet-alert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('plugins/chartist/css/chartist.min.css')); ?> " rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('plugins/alertify/css/alertify.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('plugins/summernote/summernote-bs4.css')); ?>" rel="stylesheet" />

                <!--Chartist Chart CSS -->
        <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('assets/css/convey.css')); ?>" rel="stylesheet" type="text/css">
  </head>
<body>
<!-- Loader -->
 <div id="preloader">
    <div id="status">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
</div>

 <!-- Top Bar Start -->
<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">

    </div>

</div>
<!-- Top Bar End -->
     <?php echo $__env->yieldContent('breadcrumb'); ?>


<style>
    .ion-edit:hover{
        cursor: pointer;
    }

    .display-block {
        display: block!important;
    }

    .display-none {
        display: none!important;
    }
    label {
        font-weight: 400 !important;
    }
    .marked{
        color: orange;
    }
    a.text-dark:hover {
        color: #3BC850!important;
    }

</style>

<div class="row">
    <div class="col-sm-12">

        <div class="page-title-box p-0 m-0" style="border: none;">
            <div class="w-100 text-center">

                <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(URL::asset('assets/images/logo.png')); ?>" height="30" alt="logo"></a>
            </div>

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
                <span class="m-t-25">Processing Form... Please Wait.</span>
            </div>
        </div>

        <div class="card text-center" style="border: none;">
            <div class="card-body" style="padding: 13px;">
                <p class="m-0 color-black-light">
                    <?php if($request_status == 0): ?>
                        Thank you for taking the time to complete this short Departure Evaluation.
                    <?php elseif($request_status == 1): ?>
                        Thank you for taking the time to complete this short Departure Evaluation.
                    <?php else: ?>
                        Thank you for taking the time to complete this short Departure Evaluation.
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <div class="card" style="border: none;">
        <div class="card-body" style="border: none;">
            <?php if($request_status == 0): ?>
                <div class="table-rep-plugin" id="request_form_div">
                <span id="n_form_result"></span>
                <form id="new_record_form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group  m-t-30 row">
                        <input type="hidden" name="request_id" id="request_id" value="<?php echo e($request_id); ?>">
                        <label class="col-lg-2 col-form-label text-right color-black-light">Business Name:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="business_name" name="business_name" value="<?php echo e($business_name); ?>">

                            </input>
                            <div class="">
                                <ul class="parsley-errors-list float-left" id="business_name_required">
                                    <li class="parsley-required">This value is required.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label text-right color-black-light">Employee Name:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="employee_name" name="employee_name" value="<?php echo e($employee_name); ?>">

                            </input>
                            <div class="">
                                <ul class="parsley-errors-list float-left" id="employee_name_required">
                                    <li class="parsley-required">This value is required.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text_answer" class="col-lg-2 text-right col-form-label color-black-light">Comments:</label>
                        <div class="col-lg-8">
                            <textarea id="text_answer"><?php echo $qa_info; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-lg-2 col-sm-10 col-lg-8">
                            <button type="submit" class="btn bg-emerald offset-sm-0 offset-md-4 offset-lg-5 col-12 col-sm-4 col-md-3 col-lg-2 text-white waves-effect waves-light"
                                    id="clear_exit"><i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        <?php elseif($request_status == 1): ?>
            <p class="m-0 color-black-light text-center">
                This request has expired. <br><br><br><br><br>
                To find out how CONVEY can help you improve employee engagement Please visit <a href="https://convey.ac" class="text-dark edit" target="_blank">CONVEY.ac</a>
            </p>
        <?php else: ?>
            <p class="m-0 color-black-light text-center">
                This form has already been completed. <br><br><br><br><br>
                To find out how CONVEY can help you improve employee engagement Please visit <a href="https://convey.ac" class="text-dark edit" target="_blank">CONVEY.ac</a>
            </p>
        <?php endif; ?>

        </div>
        </div>

    </div>
</div>
<!-- end row -->
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

<div id="recordViewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="recordTemplateLabel">Record Template</h5>
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

<!--
    <footer class="footer">

    </footer> -->
<!-- jQuery  -->
<script src="<?php echo e(URL::asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/modernizr.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/waves.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.nicescroll.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/jquery.scrollTo.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/sweet-alert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/select2/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js')); ?>"></script>
<!--Chartist Chart-->
<!-- <script src="<?php echo e(URL::asset('plugins/chartist/js/chartist.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js')); ?>"></script> -->

<!-- KNOB JS -->
<script src="<?php echo e(URL::asset('plugins/jquery-knob/excanvas.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jquery-knob/jquery.knob.js')); ?>"></script>

<script src="<?php echo e(URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/alertify/js/alertify.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- Responsive-table-->
<!-- Dashboard init -->
<!-- <script src="<?php echo e(URL::asset('assets/pages/dashboard.js')); ?>"></script> -->
<script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
    $(document).ajaxError(function(event, jqxhr, settings, exception) {

        if (exception == 'unknown status') {
            // Prompt user if they'd like to be redirected to the login page
             window.location = '<?php echo e(route("login")); ?>';
         }
    });

    // disable datatables error prompt
    // $.fn.dataTable.ext.errMode = 'none';

    function date_format(data)
    {
        var y = data.substr(0,4);
        var m = data.substr(5,2);
        var d = data.substr(8,2);
        return m+'/'+d+'/'+y;
    }


    $('#text_answer').summernote({
        height: 250,
        toolbar: false,
        // airMode: true
        callbacks: {
            onKeyup: function(e) {
                var text_content = $('#text_answer').summernote('code');

                var search_string = 'contenteditable="false"';
                var question_count = text_content.split(search_string).length - 1;
                var answer_count = (text_content.match(/>A:/g) || []).length;

                if(e.which == 8 || e.which == 46) {
                    if(question_count != m_question_count) {
                        $('#text_answer').summernote('undo');
                    }

                    if(answer_count != m_answer_count) {
                        $('#text_answer').summernote('undo');
                    }
                }

                setTimeout(function(){

                },200);
            }
        }
    })

    var text_content = $('#text_answer').summernote('code');
    var search_string_question = 'contenteditable="false"';

    var m_question_count = text_content.split(search_string_question).length - 1;
    var m_answer_count = (text_content.match(/>A:/g) || []).length;

    $('#new_record_form').on('submit', function(event) {
        event.preventDefault();

        var error_detect = 0;

        if($('#business_name').val() == '') {
            $('#business_name_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#business_name_required').removeClass('filled');
        }

        if($('#employee_name').val() == '') {
            $('#employee_name_required').addClass('filled');
            error_detect = 1;
        } else {
            $('#employee_name_required').removeClass('filled');
        }

        if(error_detect == 1) {
            return false;
        }

        var formdata = new FormData(this);
        var text_answer_code = $('#text_answer').summernote('code');
        formdata.append('RECORD_content', text_answer_code);

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

        $('#form_overlay').delay(350).fadeIn('slow');

        $.ajax({
            url:"<?php echo e(route('departure_evaluation_add')); ?>",
            method:"POST",
            data: formdata,
            contentType: false,
            cache:false,
            processData: false,
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

                    return false;
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

                $('#form_overlay').delay(350).fadeOut('slow');
                form_html = '<p class="m-0 color-black-light font-20 text-center mt-3">'+
                    'Form Completed!'+
                    '</p>'+
                    '<p class="m-0 color-black-light font-32 font-weight-bold text-center mt-5">' +
                    'Do You Want Information About a New Applicant?' +
                    '</p>' +
                    '<p class="m-0 color-black-light font-20 text-center mt-3">' +
                    'Gain Instant Access to Millions of Departure Evaluations Created By Previous Employers.' +
                    '</p>' +
                    '<p class="m-0 color-black-light font-20 text-center mt-3">' +
                    'View Past Performance Reviews,  Attendance Reports, Punctuality Reports and More all Created by Previous Employers.' +
                    '</p>' +
                    '<p class="m-0 color-black-light font-20 text-center font-weight-bold mt-3">' +
                    'Gain The Insight You Need.' +
                    '</p>' +
                    '<p class="color-black-light font-20 text-center mt-3 m-b-30">' +
                    'Create Your FREE account now at www.CONVEY.ac' +
                    '</p>';

                $('#request_form_div').html(form_html);
            }
        })

    })

    $(document).on('click', 'input[type=checkbox]', function () {
        var checkbox_name = this.name;
        /*$('input[name='+ checkbox_name + ']').each(function() {
            $(this).removeAttr('checked');
        })*/

        if($(this).prop('checked') == true) {
            $(this).attr("checked", "checked");
        } else {
            $(this).removeAttr('checked');
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

</script>
 <?php echo $__env->yieldContent('script'); ?>

<!-- App js -->
<script src="<?php echo e(URL::asset('assets/js/app.js')); ?>"></script>

<?php echo $__env->yieldContent('script-bottom'); ?>


    </body>
</html>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/it/resources/views/front/departure_form.blade.php ENDPATH**/ ?>