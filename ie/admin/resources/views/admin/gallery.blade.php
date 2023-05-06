@extends('layouts.master')
@section('css')
    <style>
        .login_user:hover{
            cursor: pointer;
        }
        .page-item.active .page-link {
            background-color: #3BC850 !important;
            border-color: #3BC850 !important;
        }
        td > p {
            width: 100%!important;
        }
    </style>
@endsection
@section('content')
    <!-- Start right Content here -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                        <li class="breadcrumb-item active"><a href="#">Gallery</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Gallery</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="table-responsive mb-0" data-pattern="priority-columns">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="col-md-12 m-t-10">
                        <h6 class="text-center m-t-30 color-black-light">Add a New Gallery</h6>
                    </div>
                    <span id="e_form_result"></span>
                    <form method="post" id="gallery_form" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" id="image_id">
                        <div class="col-md-12 m-t-30">
                            <label class="col-form-label col-md-2 text-right color-black-light display-inline" for="gallery_title">Title: </label>
                            <div class="col-md-9 display-inline">
                                <input type="text" class="form-control" name="gallery_title" id="gallery_title" />
                                <div class="">
                                    <ul class="parsley-errors-list float-left" id="title_required">
                                        <li class="parsley-required">This value is required.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 m-t-15 display-inline">
                            <label class="col-form-label col-md-2 align-top text-right color-black-light display-inline" for="gallery_text">Text: </label>
                            <div class="col-md-9 display-inline">
                                <textarea class="summernote" name="gallery_text" rows="5" id="gallery_text"></textarea>
                                <div class="">
                                    <ul class="parsley-errors-list float-left" id="text_required">
                                        <li class="parsley-required">This value is required.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 m-t-15">
                            <label class="col-form-label col-md-2 align-top text-right color-black-light display-inline" for="image">Image: </label>
                            <div class="col-md-3 display-inline">
                                <input type="file" class="filestyle" id="image" data-input="false"
                                       data-buttonname="btn-secondary" name="image"
                                       accept=".png, .jpg, .jpeg, .gif">
                                <div class="">
                                    <ul class="parsley-errors-list float-left" id="file_required">
                                        <li class="parsley-required">This value is required.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6 display-inline" style="vertical-align: top">
                                <img src="" id="gallery_image" name="gallery_image" width="300px"
                                     style="display: none;">
                            </div>

                        </div>

                        <div class="col-md-12 m-t-15 display-inline">
                            <label class="col-form-label col-md-2 text-right color-black-light" for="recommend_post">
                                &nbsp;
                            </label>
                            <div class="col-md-3 display-inline">
                                <input type="checkbox" name="recommend_post" class="rem_me" id="recommend_post">
                                <label for="recommend_post" class="col-form-label color-black-light">
                                    RECOMMEND POST
                                </label>
                            </div>

                        </div>

                        <div class="col-md-12 m-t-30">
                            <button type="submit" class="btn bg-emerald text-white offset-sm-9 col-sm-2 waves-effect waves-light" id="new_gallery">
                                Create New Gallery
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6 class="text-center m-t-10 color-black-light">Manage Existing Galleries</h6>

                    <table id="gallery_table" class="table table-bordered table-striped m-t-20">
                        <thead>
                        <tr>
                            <th class="text-center" width="15%">Image</th>
                            <th class="text-center" width="20%">Title</th>
                            <th class="text-center" width="45%">Text</th>
                            <th class="text-center" width="10%">Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('script')
    <script>
        $('#gallery_text').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        })

        $('#gallery_text').summernote('code', '<p><br></p>');

        $('#gallery_table').DataTable({
            searching: true,
            processing: true,
            serverSide: false,
            paging: true,
            ordering: true,
            info: true,
            autoWidth: false,
            ajax:{
                url: "{{ route('gallery_list') }}",
                method:'post',

            },
            columns:[
                {
                    name: 'Image',
                    data: 'path_big',
                    class: 'text-center gallery_id',
                    render: function (data, type, row) {
                        image_path = "{{url('public/upload/images')}}/" + data;
                        image_path = image_path.replace('admin/', '');
                        return '<img src="' + image_path + '" width="100px">';
                    }

                },
                {
                    name: 'Title',
                    data: 'gallery_title',
                    class: 'text-left',
                },
                {
                    name: 'Text',
                    data: 'gallery_text',
                    class: 'text-left',
                    // orderable: false,
                    render: function (data, type, row) {
                        return data;
                    }
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center',
                    render: function (data, type, row) {
                        return '<a href="javascript:edit_gallery(\''+data+'\')" class="text-dark edit" title="Edit"><i class="ion-edit"></i></a> |  ' +
                            '<a href="javascript:delete_gallery(\''+data+'\')" class="text-dark" title="Remove"><i class="ion-trash-a"></i></a>';
                    }
                }

            ]
        });

        $('#gallery_title').on('input',function() {
            $('#title_required').removeClass('filled');
        })

        $('#gallery_text').on('input',function() {
            $('#text_required').removeClass('filled');
        })

        $('#gallery_form').on('submit', function(event) {
            event.preventDefault();

            var error_detect = 0;
            var text_answer_code = $('#text_answer').summernote('code');
            var condition_flag = '<p data-nsfw-filter-status="swf"><br></p>';
            var condition_flag1 = '<p><br></p>';

            if($('#gallery_title').val() == '') {
                $('#title_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#title_required').removeClass('filled');
            }

            if(condition_flag == text_answer_code || condition_flag1 == text_answer_code) {
                $('#text_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#text_required').removeClass('filled');
            }

            if($('#gallery_image').attr('src') == '') {
                $('#file_required').addClass('filled');
                error_detect = 1;
            } else {
                $('#file_required').removeClass('filled');
            }

            if(error_detect == 1) {
                return false;
            }

            if($('#image_id').val() == '')
            {
                $.ajax({
                    url:"{{ route('gallery_add') }}",
                    method:"POST",
                    data: new FormData(this),
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
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            $('#gallery_form')[0].reset();
                            $('#image_id').val('');
                            $('#gallery_table').DataTable().ajax.reload();
                        }

                        $('#e_form_result').html(html);
                        setTimeout(function () {
                            $('#e_form_result').empty();
                        }, 5000);
                    }
                })
            }

            if($('#image_id').val() != "")
            {
                $.ajax({
                    url:"{{ route('gallery_update') }}",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
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
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            $('#gallery_form')[0].reset();

                            $('#image_id').val('');
                            $('#gallery_table').DataTable().ajax.reload();
                        }
                        $('#e_form_result').html(html);
                        setTimeout(function () {
                            $('#e_form_result').empty();
                        }, 5000);
                    }
                });
            }

            $('#gallery_image').attr('src', '');
            $('#gallery_image').hide();
            $('#new_gallery').text('Create New Gallery');
            $('#gallery_text').summernote('code', '<p><br></p>');
            $("html, body").animate({scrollTop: 0}, "slow");
        });

        function edit_gallery(id) {
            $('#e_form_result').html('');
            $('#new_gallery').text('Save Changes');
            $.ajax({
                url: "{{url('get_gallery')}}/" + id,
                dataType: "json",
                success: function(html) {
                    $('#gallery_title').val(html.data.gallery_title);
                    // $('#gallery_text').val(html.data.gallery_text);
                    $('#gallery_text').summernote('code', html.data.gallery_text);
                    $('#image_id').val(html.data.id);
                    image_path = "{{url('public/upload/images')}}/" + html.data.path_big;
                    image_path = image_path.replace('admin/', '');
                    $('#gallery_image').attr('src', image_path);
                    $('#gallery_image').show();

                    if(html.data.is_recommend != 0) {
                        $('#recommend_post').prop("checked", true);
                    } else {
                        $('#recommend_post').prop("checked", false);
                    }

                    $("html, body").animate({scrollTop: 0}, "slow");
                }
            })
        }

        function delete_gallery(id){
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
                        url: "{{url('delete_gallery')}}/" + id,
                        dataType: "json",
                        success: function(data) {
                            var html = '';
                            if(data.success)
                            {
                                Swal.fire("Deleted!", data.success, "success");
                                // html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                                $('#gallery_form')[0].reset();
                                $('#image_id').val('');
                                $('#gallery_table').DataTable().ajax.reload();
                            }

                            if(data.warning)
                            {
                                Swal.fire("Cancelled!", data.warning, "error");
                                // html = '<div class="alert alert-convey-success">' + data.success + '</div>';
                            }
                            // $('#e_form_result').html(html);
                        }
                    })
                }
            });

        }

        $("#image").change(function () {
            readURL(this);
            $('#file_required').removeClass('filled');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#gallery_image').show();
                    $('#gallery_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

    </script>
@endsection
