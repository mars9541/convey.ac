@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Article Manager</a></li>
                </ol>
            </div>
            <h4 class="page-title">Article Manager</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12 bg-white">
        <div class="row" style="height: 20px;"></div>
        <div class="col-md-12">
            <button type="button" class="btn bg-emerald col-sm-1 text-white waves-effect waves-light" id="add_article">
                Add New
            </button>
            <div class="form-group float-right">
                <select class="form-control float-right" id="selecte_section">
                    <option value="" selected>Filter by Section</option>
                    <option value="hris">HRIS</option>
                    <option value="business">Business</option>
                    <option value="consultant">Consultant</option>
                    <option value="citizen">Citizen</option>
                </select>
            </div>
        </div>
        <div class="row" style="height: 20px;"></div>
        <div class="form-group row" id="article_list">

        </div>


    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="article_form">
                <input type="hidden" name="id" id="article_id">
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="col-form-label">Section Type</label>
                        <div class="col-sm-12">
                            <select class="form-control select2" id="account_type" name="account_type" required>
                                <option value="">Select</option>
                                <option value="hris">HRIS</option>
                                <option value="business">Business</option>
                                <option value="consultant">Consultant</option>
                                <option value="citizen">Citizen</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label">Priority</label>
                        <div class="col-sm-12">
                            <select class="form-control select2" id="priority" name="priority" required>
                                <option value="">Select</option>
                                @for($x = 1; $x <= $maxPriority; $x++)
                                <option value="{{$x}}">{{$x}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <label class="col-form-label">Description</label>
                <textarea id="description" class="summernote" name="description" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary bg-emerald">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script>
    $(document).ready(function(){
        reload_sections();
        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                 // set focus to editable area after initializing summernote
        });
    })

    $('#selecte_section').on('change',function(){
        reload_sections();
    })

    function reload_sections(){
        var type = $('#selecte_section').val();
        $.ajax({
            url:"{{ route('article_list') }}",
            method:"POST",
            data: {type:type},
            dataType:"json",
            success:function(html)
            {
                $('#article_list').empty();
                if(html.data.length > 0)
                {
                    var articles = '';
                    for (var i = 0; i < html.data.length; i++) {
                        if (html.data[i].title.strlen > 80) {
                            var title = html.data[i].title.substr(0, 80) + ' ...';
                        }
                        else {
                            var title = html.data[i].title;
                        }

                        if(html.data[i].description.length > 200) {
                            var description = html.data[i].description.substr(0, 200) + ' ...';
                            description = description.split('<div>');
                            if(description.length > 0) {
                                description = description + '</div>'
                            }
                        }
                        else {
                            var description = html.data[i].description;
                        }

                        articles +='<div class="col-md-6 col-lg-6 col-xl-4">\n' +
                        '                <div class="card m-b-20">\n' +
                        '                    <div class="card-body">\n' +
                        '                        <h4 class="card-title font-20 mt-0">' + title + '</h4>\n' +
                        '                        <p class="card">' + description + '</p>\n' +
                        '                    </div>\n' +
                        '                    <div class="card-body p-3 offset-5 col-sm-7 text-right">\n' +
                        '                        <a href="javascript:edit_article(\'' + html.data[i].id + '\')" class="text-dark m-r-10"><i class="ion-edit"></i><span class="m-2">Edit</span></a>\n' +
                        '                        <a href="javascript:delete_article(\'' + html.data[i].id + '\')" class="text-dark"><i class="ion-trash-a"></i><span class="m-2">Delete</span></a>\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div>';
                    }

                    $('#article_list').append(articles);
                }
            }
        })
    }

    $('#add_article').on('click',function(){
        $('#article_id').val('');
        $('#article_form')[0].reset();
        $('.modal-title').html('Add');
        $('#description').summernote('code','');
        $('#article_modal').modal('show');
    })
    $('#article_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('save_article') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data)
            {
                alertify.logPosition("top right");
                alertify.error(data.success);
                reload_sections();
                $('#article_modal').modal('hide');

            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    });



    function edit_article(id){
        $.ajax({
            url:"{{url('get_article')}}/"+id,
            dataType:"json",
            success:function(html){
                $('#article_id').val(html.data.id);
                $('#priority').val(html.data.priority);
                $('#description').summernote('code',html.data.description);
                $('#account_type').val(html.data.account_type).click();
                $('#title').val(html.data.title);
                $('.modal-title').html('Edit');
                $('#article_modal').modal('show');

            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    };

     function delete_article(id){
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
                    url:"{{url('delete_article')}}/"+id,
                    dataType:"json",
                    success:function(data){
                        reload_sections();
                        alertify.logPosition("top right");
                        alertify.error(data.success);
                    },
                    error:function(){
                        alertify.logPosition("top right");
                        alertify.error('Server Error!');

                    }

                })

            }
        });

    };
</script>

@endsection
