@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                        <li class="breadcrumb-item active"><a href="#">Signup Form</a></li>
                    </ol>
                </div>
                <h4 class="page-title">SignUp Form Rules</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-12">
{{--            <div class="card m-b-20 text-center">--}}
{{--                <div class="card-body" style="padding: 13px;">--}}
{{--                    <p class="m-0 color-black-light"></p>--}}
{{--                </div>--}}

{{--            </div>--}}
            <div class="card">
                <div class="card-body">
                    <div class="tab-pane p-3" id="email_types" role="tabpanel">
                        <div class="card-body custom-padding-btop col-md-10" style="margin: auto; min-height: content-box">
                            <div class="card-title mt-0 color-black-light">
                                <h5>SignUp Form Email Address Check list</h5>
                                <button class="btn bg-convey-green text-white" style="float: right;" id="email_type_add_btn">add</button>
                            </div>
                            <div class="table-responsive ">
                                <table class="table table-hover" id="email_types_table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Manage</th>
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
    <div class="modal fade" id="email_types_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Email type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="email_type_id">
                    <div class="form-group row">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text"  id="email_type_text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-emerald text-white" id="email_type_save_btn">Save & changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script>
        $('#email_types_table').DataTable({
            lengthMenu: true,
            searching: false,
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            autoWidth: false,
            ajax:{
                url: "{{url('signup_rule/email_types_list')}}",
                method:'post',
                data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
            },
            columns:[
                {
                    name: 'No',
                    data: 'email_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'Manage',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        return '<a href="javascript:insert_rule('+data+',\''+row.email_type+'\')" class="text-dark edit" ><i class="ion-edit"></i></a> |  <a href="javascript:delete_rule('+data+')" class="text-dark"><i class="ion-trash-a"></i></a>';
                    }
                }
            ]
        });
        $('#email_type_add_btn').on('click',function(){
            $('#email_type_id').val('');
            $('#email_type_text').val('');
            $('#email_types_modal').modal('show');
        })

        function insert_rule(id,text){
            $('#email_type_id').val(id);
            $('#email_type_text').val(text);
            $('#email_types_modal').modal('show');
        }

        $('#email_type_save_btn').on('click',function(){
            $.ajax({
                url:"{{url('signup_rule/email_type_save')}}",
                type: "POST",
                data: {
                    id:$('#email_type_id').val(),
                    email_type:$('#email_type_text').val()
                },
                dataType:"json",
                success:function(data){
                    $('#email_types_table').DataTable().ajax.reload();

                    alertify.logPosition("top right");
                    alertify.success(data.success);
                    $('#email_types_modal').modal('hide');
                },
                error:function(){
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                    $('#email_types_modal').modal('hide');
                }
            })
        });

        function delete_rule(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3bc850",
                cancelButtonColor: "#ec4561",
                confirmButtonText: "Yes, Remove it!"
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url:"{{url('signup_rule/email_type_delete')}}/"+id,
                        dataType:"json",
                        success:function(data){
                            alertify.logPosition("top right");
                            alertify.success(data.success);

                            $('#email_types_table').DataTable().ajax.reload();
                            $('#email_types_modal').modal('hide');
                        }
                    })

                }
            });

        }
    </script>

@endsection
