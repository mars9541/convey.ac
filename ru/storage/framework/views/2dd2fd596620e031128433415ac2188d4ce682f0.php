<?php $__env->startSection('css'); ?>
<style>
    .ion-edit:hover{
        cursor: pointer;
    }
    .marked{
        color: orange;
    }
    .blue-underline {
        /*text-decoration-line: underline;
        text-decoration-color: blue;*/
        color: #524f4f;
        font-weight: 500;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-sm-12">
    <div class="page-title-box">
        <div class="float-right">
            <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="<?php echo e(url('business/home')); ?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Search</a></li>
            </ol>
        </div>
        <h4 class="page-title">Search the Convey Databank</h4>
    </div>
</div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <button onclick="topFunction()" class="btn-move-top" id="btnMoveToTop" title="Go to top"><i class="mdi mdi-chevron-double-up"></i></button>
<div class="col-md-12">
    <div class="card m-b-20 text-center">
        <div class="card-body" style="padding: 13px;">
            <p class="m-0 color-black-light">Perform a quick search here to reveal the employment records for a new applicant uploaded by their previous employers.</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="col-lg-12 row" id="search_panel">
                <div class="offset-1 col-lg-7 col-xl-9">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label col-md-12 text-center color-black-light display-inline font-20">
                                What is the Applicants INN<br> (or replacement search number):
                            </label>
                        </div>
                        <div class="col-sm-12">
                            <input type="text" class="form-control col-sm-3  mx-auto" placeholder="Enter Insurance Number:" id="NI_search_number" value="ABC123456789">
                            <div class="col-sm-3 mx-auto">
                                <ul class="parsley-errors-list float-left" id="space_error">
                                    <li class="parsley-required">This value is not allowed - "space characters".</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label col-md-12 text-center color-black-light display-inline font-20">What is the Applicants Date of Birth: </label>
                        </div>
                        <div class="col-sm-12">
                            <input class="form-control col-sm-3 mx-auto" type="date" max="9999-12-31" id="dob" value="2000-12-20">
                            <div class="col-sm-3 mx-auto">
                                <ul class="parsley-errors-list float-left" id="dob_required"><li class="parsley-required">This value is required.</li></ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <button type="submit" class="btn bg-emerald offset-sm-5 col-sm-2 text-white waves-effect waves-light" id="search_btn">
                            Perform Search
                        </button>
                    </div>`
                </div>
                <div class="col-lg-4 col-xl-2">
                    <div class="mt-2 color-black-light" style="border:1px solid lightgrey; padding: 10px; border-radius: 3px;">
                        <label class="display-inline font-18">Search Options....</label>
                        <p class="color-black-light font-12">Press the green 'Perform Search' button to view our sample records.</p>
                        <p>or</p>
                        <p class="color-black-light font-12">Replace the sample numbers with your own real numbers to perform an actual search</p>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="card-body">
                    <h4 class="card-title font-20 mt-0 color-black-light">Search Results for:  <span id="NI_review"></span></h4>
                </div>
            </div>
            <div class="form-group row" id="search_result">

            </div>
        </div>
    </div>
        <!-- Nav tabs -->

</div>
</div>
<!-- end row -->

<div class="modal fade" id="version_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Record Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">

                    <div class="col-sm-10 color-black-light" id="version_view_content">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-convey-green text-white" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <h5 class="color-black-light">You don’t have any credits to complete this search ….to purchase more credits please click <a href="<?php echo e(url('business/search-credits?tab=2')); ?>" class="text-convey-green">here</a></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-convey-green text-white" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $('#NI_search_number').on('input',function(e){
        var NI_number = $('#NI_search_number').val();
        var NI_min_number = <?php echo e($NI_min_number); ?>;
        if(NI_number.search(' ')>0)
        {
            $('#space_error').addClass('filled');
            $('#space_error li').html('This value is not allowed - "space characters".');
        }else if(NI_number.length < NI_min_number) {
            $('#space_error').addClass('filled');
            $('#space_error li').html('The INN for the Russia is set so it must be at least ' + NI_min_number + ' characters long.');
        }else{
            $('#space_error').removeClass('filled');
        }
    })

    $('#dob').on('input',function(e){
        $('#dob_required').removeClass('filled');
    })

    $('#search_btn').on('click',function(){

        if($('#space_error').hasClass('filled'))
        {
            return false;
        }

        if ($('#dob').val()=='') {
            $('#dob_required').addClass('filled');
            return false;
        }

        $('#NI_review').html($('#NI_search_number').val());
        // brief pause
        html='<div class="col-md-12">\n' +
            '                            <div class="card m-b-20 box-shadow-note">\n' +
            '                                <div class="card-body">\n' +
            '                                    <h6 class="card-text text-center color-black-light">Searching Records...Please Wait.</h6>\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>';
        $('#search_result').html(html);

        $.ajax({
            url:"<?php echo e(route('business.record_search')); ?>",
            type: "POST",
            data: {
                NI_number: $('#NI_search_number').val(),
                dob:$('#dob').val(),
            },
            dataType:"json",
            success:function(res){
                if(res.errors) {
                    $('#space_error').addClass('filled');
                    $('#space_error li').html(res.errors[0]);
                } else if(res.status == 'credits_count_error') {
                    $('#alert_modal').modal('show');
                } else {

                    var html = '';

                    if(res.data.length > 0) {
                        res.data.forEach(function(item, key) {
                            var version = '';

                            if(item.ids && item.ids.length > 0) {
                                for (var i = 0; i < item.ids.length; i++) {
                                    if( i==0 ) {
                                        version += 'View Previous Versions... <a class="text-convey-green" href="javascript:version_view(\'' + item.ids[item.ids.length - i - 1] + '\')" style="margin-right:10px;">' + (i + 1) + '</a>';
                                    } else {
                                        version += '/ <a class="text-convey-green" href="javascript:version_view(\'' + item.ids[item.ids.length - i - 1] + '\')" style="margin-right:10px;">' + (i + 1) + '</a>';
                                    }
                                }
                            }

                            var creat_date = formatDate(item.record_date);

                            if($('#NI_search_number').val() == 'ABC123456789') {
                                item.ocb_name = 'Mars Partners Ltd';
                                item.CBR_id = "RU000000";
                                item.website = "www.marspartnersltd.ccc";
                            }

                            var newDate = new Date();
                            var created_date = new Date(item.time_stamp.split(' ')[0]);
                            var millisecondsPerDay = 24 * 60 * 60 * 1000;
                            const diffInMs = newDate - created_date;
                            const diffInDays = diffInMs / millisecondsPerDay;
                            var past_days = 61 - diffInDays.toFixed();
                            var past_days_html = '';

                            if(past_days >= 1) {
                                if(past_days == 60) {
                                    past_days_html = '<small style="color: #3BC850;">(Record added to the DATABANK today)</small>';    
                                } else if(past_days == 59) {
                                    past_days_html = '<small style="color: #3BC850;">(Record added to the DATABANK 1 day ago)</small>';    
                                } else {
                                    past_days_html = '<small style="color: #3BC850;">(Record added to the DATABANK ' + past_days + ' days ago)</small>';    
                                }
                                
                            }

                            html +='<div class="col-md-12 col-lg-12 col-xl-12">\n' +
        '                            <div class="card m-b-20 box-shadow-note" style="padding-left: 20px">\n' +
        '                                <div class="card-body custom-padding-btop text-center" style="padding-top: 30px;">\n' +
        '                                    <span class="card-title font-20 mt-0 align-middle font-weight-bolder color-black-light text-center">' + $('#NI_search_number').val() + '</span>\n' +
        '                                </div>\n' +
        '                                <div class="card-body ">\n' +
        '                                    <p class="font-20 mt-0 align-middle color-black-light">Created By: <strong>'+item.ocb_name+'</strong></p>\n' +
        '                                    <p class="font-20 mt-0 align-middle color-black-light">Account Number: <strong>' + item.CBR_id + '</strong></p>\n' +
        '                                    <p class="font-20 mt-0 align-middle color-black-light">Website: <strong>' + item.website + '</strong></p>\n' +
        '                                    <p class="ard-title font-20 mt-0 align-middle color-black-light">Type of record: <strong>'+item.record_type+'</strong> '+ past_days_html +'</p>\n' +
        '                                    <p class="ard-title font-20 mt-0 align-middle color-black-light">Record Date: <strong>'+creat_date.substr(0,10)+'</strong></p>\n' +

        '                                    <div style="border:2px solid lightgrey; padding: 10px; border-radius: 3px;">\n'+
                '                                <div class="">\n' +
                '                                    <span class="card-title font-20 mt-0 color-black-light">Record Content:</span>\n' +
                '                                </div>\n' +
            '                                    <div class="color-black-light font-20 pl-5 mt-3">\n'+
                                                    item.RECORD_content.replace(/\<p>A:/g, '<p class="blue-underline">A:') + '</div>\n' +

        '                                       </div>\n' +
        '                                    <p style="float: right; " class="color-black-light">'+version+'</p>\n' +
        '                            </div>\n' +
        '                            </div>\n' +
        '                        </div>';
                        });


                    } else {
                        html='<div class="col-md-12">\n' +
    '                            <div class="card m-b-20 box-shadow-note">\n' +
    '                                <div class="card-body">\n' +
    '                                    <h6 class="card-text text-center color-black-light">No results to show.</h6>\n' +
    '                                    <h6 class="card-text text-center color-black-light">We have not deducted a credit for this search.</h6>\n' +
    '                                </div>\n' +
    '                            </div>\n' +
    '                        </div>';
                    }

                    $('#search_result').html(html);

                    var scroll_move = 0;
                    var width = $(window).width();
                    var search_panel_height = $('#search_panel').height();

                    if(width < 576) {
                        scroll_move = 835;
                    } else if(width >= 576 && width < 768) {
                        scroll_move = 650;
                    } else if(width >= 768 && width < 992) {
                        scroll_move = 615;
                    } else if(width >= 992 && width < 1200) {
                        scroll_move = 615;
                    } else {
                        scroll_move = 440 + (search_panel_height - 275);
                    }

                    doScrolling(scroll_move, 500);
                    // document.body.scrollTop = scroll_move;
                    // document.documentElement.scrollTop = scroll_move;
                }
            },

            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    })

    function doScrolling(elementY, duration) {
        var startingY = window.pageYOffset;
        var diff = elementY - startingY;
        var start;

        // Bootstrap our animation - it will get called right before next frame shall be rendered.
        window.requestAnimationFrame(function step(timestamp) {
            if (!start) start = timestamp;
            // Elapsed milliseconds since start of scrolling.
            var time = timestamp - start;
            // Get percent of completion in range [0, 1].
            var percent = Math.min(time / duration, 1);

            window.scrollTo(0, startingY + diff * percent);

            // Proceed with animation as long as we wanted it to.
            if (time < duration) {
                window.requestAnimationFrame(step);
            }
        })
    }

    function formatDate(d) {
        date = new Date(d);
        var day = date.getDate();
        if (day < 10) {
            day = "0" + day;
        }
        var month = date.getMonth() + 1;
        if (month < 10) {
            month = "0" + month;
        }
        var year = date.getFullYear();
        return day + "/" + month + "/" + year;
    }

    function version_view(id)
    {
        $.ajax({
            url:"<?php echo e(route('business.get_record_version')); ?>",
            type: "POST",
            data: {
                id:id,
            },
            dataType:"json",
            success:function(res){
                var data= res.data;
                $('#version_view_content').html('<p class="color-black-light">'+data.RECORD_content+'</p>');
                $('#version_view_modal').modal('show');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        });
    }



</script>
<script>
    //Get the button
    var btnMoveTop = document.getElementById("btnMoveToTop");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            btnMoveTop.style.display = "block";
        } else {
            btnMoveTop.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        // document.body.scrollTop = 0;
        // document.documentElement.scrollTop = 0;
        smoothScroll({ duration: 1000, direction: 'top' });
    }

    function getProgress(_ref) {
        var duration = _ref.duration,
            runTime = _ref.runTime;
        var percentTimeElapsed = runTime / duration;

        function easeOutCubic(x) {
            return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2 ;
        }

        return easeOutCubic(percentTimeElapsed);
    };

    function getTotalScroll(_ref) {
        var scrollableDomEle = _ref.scrollableDomEle,
            elementLengthProp = _ref.elementLengthProp,
            initialScrollPosition = _ref.initialScrollPosition,
            scrollLengthProp = _ref.scrollLengthProp,
            direction = _ref.direction;
        var totalScroll;

        var documentElement = document.documentElement;
        totalScroll = documentElement.offsetHeight;

        return !!~['left', 'top'].indexOf(direction) ? initialScrollPosition : totalScroll - initialScrollPosition;
    };

    function smoothScroll(_ref2) {
        var scrollableDomEle = window,
            direction = _ref2.direction,
            duration = _ref2.duration,
            scrollAmount = window.outerHeight - window.innerHeight + 5000;
        var startTime = null,
            scrollDirectionProp = null,
            scrollLengthProp = null,
            elementLengthProp = null,
            scrollDirectionProp = 'pageYOffset';
        elementLengthProp = 'innerHeight';
        scrollLengthProp = 'scrollHeight';

        var initialScrollPosition = scrollableDomEle[scrollDirectionProp];
        var totalScroll = getTotalScroll({
            scrollableDomEle: scrollableDomEle,
            elementLengthProp: elementLengthProp,
            initialScrollPosition: initialScrollPosition,
            scrollLengthProp: scrollLengthProp,
            direction: direction
        });

        if (!isNaN(scrollAmount) && scrollAmount < totalScroll) {
            totalScroll = scrollAmount;
        }

        var scrollOnNextTick = function scrollOnNextTick(timestamp) {
            var runTime = timestamp - startTime;
            var progress = getProgress({
                runTime: runTime,
                duration: duration
            });

            if (!isNaN(progress)) {
                var scrollAmt = progress * totalScroll;
                var scrollToForThisTick = direction === 'bottom' ? scrollAmt + initialScrollPosition : initialScrollPosition - scrollAmt;

                if (runTime < duration) {
                    var xScrollTo = 0;
                    var yScrollTo = scrollToForThisTick;
                    window.scrollTo(xScrollTo, yScrollTo);

                    requestAnimationFrame(scrollOnNextTick);
                } else {
                    var _scrollAmt = totalScroll;
                    var scrollToForFinalTick = direction === 'bottom' ? _scrollAmt + initialScrollPosition : initialScrollPosition - _scrollAmt;
                    var _xScrollTo = 0;
                    var _yScrollTo = scrollToForFinalTick;
                    window.scrollTo(_xScrollTo, _yScrollTo);
                }
            }
        };

        requestAnimationFrame(function (timestamp) {
            startTime = timestamp;
            scrollOnNextTick(timestamp);
        });
    };
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-business', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ru/resources/views/front/business/search.blade.php ENDPATH**/ ?>