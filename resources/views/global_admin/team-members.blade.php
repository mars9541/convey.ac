@extends('layouts.master')
@section('css')
<style>
    .ion-edit:hover{
        cursor: pointer;
    }
    .user_name:hover{
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{route('global.home')}}">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Team Members</a></li>
                </ol>
            </div>
            <h4 class="page-title">Team Members</h4>
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
                    <a class="nav-link active text-dark" data-toggle="tab" href="#home-1" role="tab" id="tab_1">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">New Members</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#profile-1" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">Edit Members</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                    
                    @error('name')
                    <div class="col-sm-10 offset-sm-2 alert alert-success alert-dismissible fade show text-white" style="background-color: #3BC850;" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Warning!</strong> {{ $message }}
                    </div>
                    @enderror
                    <form class="" action="{{route('global.members_insert')}}" method="post" onsubmit="return checkReq();">
                        @csrf
                        <input type="hidden" name="id" id="member_id">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right color-black-light">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name"  required placeholder="Type something"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right color-black-light">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" required placeholder="Type something"/>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label class="col-sm-2 col-form-label text-right color-black-light">Department:</label>
                            <div class="col-sm-8 row">
                                @foreach($department as $d)
                                <div class="col-sm-6">
                                    <input type="checkbox" name="department_id[]" value="{{$d->id}}">
                                    <label class="m-0 p-1 color-black-light">{{$d->department_name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row d-flex align-items-center">
                            <label class="col-sm-2 col-form-label text-right color-black-light">Country:</label>
                            <div class="col-sm-8 row">
                                @foreach($country as $c)
                                <div class="col-sm-6">
                                    <input type="checkbox" name="country_id[]" value="{{$c->id}}">
                                    <label class="m-0 p-1 color-black-light">{{$c->country_name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light float-right" id="submit_btn">
                                Add
                            </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                    <div class="table-rep-plugin">
                            <div class="form-group col-sm-12 row">
                                <label class="col-form-label col-md-2 text-right color-black-light">Department</label>
                                <select class="form-control col-sm-2" id="filter_department">
                                    <option value="-1">All</option>
                                    @foreach($department as $d)
                                    <option value="{{$d->id}}">{{$d->department_name}}</option>
                                    @endforeach
                                </select>
                                <label class="col-form-label col-md-2 text-right color-black-light offset-sm-4">Country</label>
                                <select class="form-control col-sm-2 " id="filter_country">
                                    <option value="-1">All</option>
                                    @foreach($country as $c)
                                    <option value="{{$c->id}}">{{$c->country_name}}</option>
                                    
                                    @endforeach
                                </select>

                            </div>
                            
                            <table id="tech-companies-1" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Member</th>
                                    <th class="text-center">Edit | Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(count($members)<1)
                                    <td class="text-center p-2" colspan="2">No results to view</td>
                                    @endif
                                    @foreach($members as $member)
                                    <tr>
                                        <td class="p-2 text-center filter_td user_name" data-department="{{$member->assigned_departments}}" data-country="{{$member->assigned_countries}}" data-id="{{$member->id}}">{{$member->name}}</td>
                                        <td class="text-center font-20 p-1">
                                            <i class="ion-edit" data-id="{{$member->id}}" data-name="{{$member->name}}" data-department="{{$member->assigned_departments}}" data-country="{{$member->assigned_countries}}"></i> |  <a href="javascript:delete_member({{$member->id}})" class="text-dark"><i class="ion-trash-a"></i></a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                </div>

            </div>

        </div>

    </div>
</div>
<!-- end row -->
<form id="delete_form" action="{{route('global.member_del')}}" method="post" style="display: none;">
    @csrf
    <input type="hidden" name="id" id="delete_id">
</form>



@endsection
@section('script')
<script>
    $(".select2").select2({
       placeholder:'Select',
        width: null
    });
    function checkReq() {
        var status1 = 0;
        var status2 = 0;
      $('input[name="department_id[]"]').each(function(){
            if($(this).prop('checked')==true){
               status1++;
            }
      });
        if(status1==0) alert('Please check Department!')
      $('input[name="country_id[]"]').each(function(){
            if($(this).prop('checked')==true){
                status2++;
            }
      });
        if(status2==0) alert('Please check Country!')
        if(status1>0&&status2>0) 
            return true;
        else
            return false;
    }

    $('.ion-edit').on('click',function() {
        $('#member_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        var department_id = String($(this).data('department')).split(',');
        $('input[name="department_id[]"]').each(function(){
            $(this).prop('checked',false);
            var value = $(this).prop('value');
            var i;
            var j=0;
            for (i = 0; i < department_id.length; i++) {
              if(value == department_id[i])
                var j=1;
            }
            if(j==1)
                $(this).prop('checked',true);
        })
        var country_id = String($(this).data('country')).split(',');
        $('input[name="country_id[]"]').each(function(){
            $(this).prop('checked',false);
            var value = $(this).prop('value');
            var i;
            var j=0;
            for (i = 0; i < country_id.length; i++) {
              if(value == country_id[i])
                var j=1;
            }
            if(j==1)
                $(this).prop('checked',true);
        })
        $('input[name="password"]').removeAttr('required');
        $('#submit_btn').html('Update');
        $('#tab_1').click();
    })

    $('#filter_department').on('change',function(){
        id=$('#filter_department').val();
        $('.filter_td').each(function(){
            $(this).closest('tr').removeAttr('style');
            var department_id = String($(this).data('department')).split(',');
            var i;
            var j=0;
            for(i = 0; i < department_id.length; i++) {
                if(department_id[i]==id)
                    j=1;
            }
            if(id!='-1'&&j==0)
                $(this).closest('tr').attr('style','display:none;');
        })
    })
    

    $('#filter_country').on('change',function(){
        id=$('#filter_country').val();
        $('.filter_td').each(function(){
            $(this).closest('tr').removeAttr('style');
            var country_id = String($(this).data('country')).split(',');
            var i;
            var j=0;
            for(i = 0; i < country_id.length; i++) {
                if(country_id[i]==id)
                    j=1;
            }
            if(id!='-1'&&j==0)
                $(this).closest('tr').attr('style','display:none;');
        })
    })
    function delete_member(id)
    {
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
                $('#delete_id').val(id);
                $('#delete_form').submit();     
                
            }
        });
    }
        
    @if(session('msg')=='delete')
    {    
        Swal.fire("Deleted!", "Your file has been deleted.", "success");
    }
    @endif

    @if(session('msg')=='success')
    {
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })
    }
    @endif

    $('.filter_td').on('click',function(){
        var team_id = $(this).data('id');
        $.ajax({
          url: "{{ route('global.put_team_id')}}",
              method: 'post',
              data: {
                 team_id:team_id,
              },
              success: function(result){
                window.open("{{url('/')}}/global/global_team_admin", "_blank");
              }
        })   
    })

</script>
@endsection