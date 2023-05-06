@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Knowledge Base</a></li>
                </ol>
            </div>
            <h4 class="page-title">Knowledge Base</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#add_new_question" role="tab" id="qa_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">Add New Question</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#existing_questions" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Existing Questions</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="add_new_question" role="tabpanel">
                    <form id="qa_form">
                        <input type="hidden" name="id" id="knowledge_id">
                        <div class="form-group row">
                            <label for="text_question" class="col-lg-1 col-form-label">Question:</label>
                            <div class="col-lg-11">
                                <textarea id="text_question" name="text_question" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Section:</label>
                            <div class="col-lg-11">
                                <select class="form-control select2" id="sections" name="section" required>
                                    <option value="">Select Section</option>
                                    <option value="business">Business</option>
                                    <option value="advisors">Advisors</option>
                                    <option value="hris">HRIS</option>
                                    <option value="Citizen">citizen</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="text_answer" class="col-lg-1 col-form-label">Answer:</label>
                            <div class="col-lg-11">
                                <textarea id="text_answer" name="text_answer" rows="8" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn bg-emerald offset-sm-10 col-sm-2 text-white waves-effect waves-light float-right" id="qa_btn">
                                Add
                            </button>
                        </div>

                    </form>
                </div>

                <div class="tab-pane p-3" id="existing_questions" role="tabpanel">
                    <div class="custom-padding-top">
                        <table id="qa_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">Question</th>
                                <th class="text-center">Answer</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center p-2">Question here</td>
                                <td class="text-center p-2">Answer here</td>
                                <td class="text-center font-20 p-1">
                                    <a href="#" class="text-dark"><i class="ion-edit"></i></a> |  <a href="#" class="text-dark"><i class="ion-trash-a"></i></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>

    </div>
</div>
<!-- end row -->
@endsection

@section('script')
<script>

    $('#qa_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"{{ route('save_knowledge') }}",
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
                $('#qa_table').DataTable().ajax.reload();
                $('#knowledge_id').val('');
                $('#qa_form')[0].reset();
                $('#qa_btn').html('Add');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    });



</script>
<script>
    $('#qa_table').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "{{ route('knowledge_list') }}",
            method:'post',
            data:{
                _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:[
            {
                name: 'Question',
                data: 'question',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    if(data.length>50)
                        return data.substr(0,50)+'...';
                    else
                        return data;
                }
            },
            {
                name: 'Answer',
                data: 'answer',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    if(data.length>50)
                        return data.substr(0,50)+'...';
                    else
                        return data;
                }
            },
            {
                name: 'Manage',
                data: 'id',
                class: 'text-center p-2',

                render: function (data, type, row) {
                  return '<a href="javascript:edit_qa(\''+data+'\')" class="text-dark edit" ><i class="ion-edit"></i></a>   |  <a href="javascript:delete_qa(\''+data+'\')" class="text-dark"><i class="ion-trash-a"></i></a>';
                }

            }
        ]
    });

    function edit_qa(id){
        $.ajax({
            url:"{{url('get_knowledge')}}/"+id,
            dataType:"json",
            success:function(html){
                $('#knowledge_id').val(html.data.id);
                $('#text_question').val(html.data.question);
                $('#sections').val(html.data.section).click();
                $('#text_answer').val(html.data.answer);
                $('#qa_tab').click();

            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');

            }
        })
    };

     function delete_qa(id){
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
                    url:"{{url('delete_knowledge')}}/"+id,
                    dataType:"json",
                    success:function(data){
                        $('#qa_table').DataTable().ajax.reload();
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
