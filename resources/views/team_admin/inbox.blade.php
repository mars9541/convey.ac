@extends('layouts.master-team')
@section('content')
<div class="row">
<div class="col-sm-12">
    <div class="page-title-box">
        <div class="float-right">
            <ol class="breadcrumb hide-phone p-0 m-0">
                <li class="breadcrumb-item"><a href="{{route('team.home')}}">Convey</a></li>
                <li class="breadcrumb-item active"><a href="login-to-country.html">Inbox</a></li>
            </ol>
        </div>
        <h4 class="page-title">Inbox</h4>
    </div>
</div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
<div class="col-md-12">
    <div class="card m-b-20">
        <div class="card-body">
            <div class="form-group">
                <div class="dropdown mo-mb-5">
                    <button class="btn btn-secondary offset-sm-10 col-md-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filter by Status
                    </button>
                    <div class="dropdown-menu col-md-2" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">All</a>
                        <a class="dropdown-item" href="#">New</a>
                        <a class="dropdown-item" href="#">Claimed</a>
                        <a class="dropdown-item" href="#">Replied</a>
                    </div>
                </div>
            </div>
            <table id="ticket_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">From</th>
                        <th class="text-center">Country</th>
                        <th class="text-center">Received</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticket as $item)
                    <tr>
                        <td class="text-center p-2">{{$item->email_opened_by}}</td>
                        <td class="text-center p-2">{{$item->country->country_name}}</td>
                        <td class="text-center p-2">{{$item->created_at->format('d/m/Y')}}</td>
                        <td class="text-center p-2">@if($item->status==1)New
                                                    @elseif($item->status==2)Claimed
                                                    @elseif($item->status==3)Replied
                                                    @endif</td>
                        <td class="text-center p-2">{{$item->department->department_name}}</td>
                        <td class="text-center p-2"><a href="javascript:answer_modal('{{$item->id}}')" class="color-black-light">Open</a> </td>

                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>
<!-- end row -->

<div class="modal fade bs-example-modal-lg" id="ticekt_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title">Send Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form id="ticket_form">
            <div class="modal-body">
                <input type="hidden" name="id" id="ticket_id">
                <div class="card-body col-md-12">
                    <label>Question</label>
                    <p class="text-dark" style="word-break: break-all" id="question"></p>
                </div>
                <div class="form-group">
                    <label>Answer</label>
                    <textarea class="form-control" id="answer" name="answer" rows ="5" required></textarea>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary bg-convey-green text-white">Send</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')
<script>
    
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
            url: "{{ route('team.ticket_list') }}",
            method:'post',
            data:{
                _token: $('meta[name="_token"]').attr('content')
            }
        },
        columns:[
            {
                name: 'From',
                data: 'email_opened_by',
                class: 'text-center p-2',

            },
            {
                name: 'Country',
                data: 'country.country_name',
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
                name: 'Status',
                data: 'status',
                class: 'text-center p-2',
                render:function (data, type, row){
                if(data==1)
                    return 'New';
                else if(data == 2) 
                    return 'Claimed';
                else if (data == 3)
                    return 'Replied';
                }
            },
            {
                name: 'Department',
                data: 'department.department_name',
                class: 'text-center p-2',
               
            },
            {
                name: 'Manage',
                data: 'id',
                class: 'text-center p-2',
                render: function (data, type, row) {
                  return '<a href="javascript:ticekt_modal('+data+')" class="text-dark edit" >Open</a>';
                  
                }
                
            }
        ]
    });


    function ticekt_modal(id)
    {
        $.ajax({
            url:"{{route('team.get_ticket')}}",
            method:"POST",
            data: {
                id:id,
            },
            dataType:"json",
            success:function(html){
                $('#ticket_id').val(html.id);
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

    $('#ticket_form').on('submit',function(event){
        event.preventDefault();
        $.ajax({
                url:"{{ route('team.send_ticket') }}",
                method:"POST",
                data: new FormData(this),
                contentType: false,
                cache:false,
                processData: false,
                dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#ticket_form')[0].reset();
                    alertify.logPosition("top right");
                    alertify.error(data.success);
                    $('#ticket_table').DataTable().ajax.reload();
                }else{
                    alertify.logPosition("top right");
                    alertify.error('Server Error!');
                }
                $('.bs-example-modal-lg').modal('hide');
            },
            error:function()
            {
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
        
    })
</script>
@endsection