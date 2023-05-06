@extends('layouts.master')
@section('css')
<style>
    .ion-edit:hover{
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
                <li class="breadcrumb-item active"><a href="#">Department List</a></li>
            </ol>
        </div>
        <h4 class="page-title">Department List</h4>
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
                    <span class="d-none d-sm-inline-block">Add Department</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" data-toggle="tab" href="#profile-1" role="tab">
                    <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                    <span class="d-none d-sm-inline-block">Edit Department</span>
                </a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active p-3 m-t-30" id="home-1" role="tabpanel">
                <form class="" action="{{route('global.department_insert')}}" method="post">
                    @csrf
                    <div class="form-group row m-t-30">
                        <input type="hidden" name="id" id="department_id">
                        <label class="col-sm-2 col-form-label text-right color-black-light">name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="department_name" id="department_name" required placeholder="Type something" />
                        </div>
                    </div>

                    <div class="button-items m-t-30">
                        <button type="submit" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light float-right" id="submit_btn">
                            Add
                        </button>
                    </div>

                </form>
            </div>
            <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                <div class="table-rep-plugin m-t-30">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Department</th>
                                <th class="text-center">Edit | Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($departments)<1)
                            <td class="text-center p-2" colspan="2">No results to view</td>
                            @endif
                            @foreach($departments as $key => $item)
                            <tr>
                                <th class="p-2 text-center">{{$item->department_name}}</span></th>
                                <td class="text-center font-20 p-1">
                                    <i class="ion-edit" data-id="{{$item->id}}" data-name="{{$item->department_name}}" ></i>
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
</div>
<!-- end row -->


@endsection  
@section('script') 
<script>
    $('.ion-edit').on('click',function() {
        $('#department_id').val($(this).data('id'));
        $('#department_name').val($(this).data('name'));
        $('#submit_btn').html('Update');
        $('#tab_1').click();
    })
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
</script>
@endsection
                      