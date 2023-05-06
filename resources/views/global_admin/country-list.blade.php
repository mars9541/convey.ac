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
                <li class="breadcrumb-item active"><a href="#">Country List</a></li>
            </ol>
        </div>
        <h4 class="page-title">Country List</h4>
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
                    <span class="d-none d-sm-inline-block">Add Country</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark" data-toggle="tab" href="#profile-1" role="tab">
                    <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                    <span class="d-none d-sm-inline-block">Edit Country</span>
                </a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active p-3" id="home-1" role="tabpanel">
                <form class="" action="{{route('global.country_insert')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <input type="hidden" name="id" id="country_id">
                        <label class="col-sm-2 col-form-label text-right color-black-light">Country name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="country_name" id="country_name" required placeholder="Type something" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right color-black-light">Country Code:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="country_code" id="country_code" required placeholder="Type something" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right color-black-light">DB name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="database_name" id="database_id" required placeholder="Type something" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right color-black-light">DB host:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="database_host" id="database_host" required placeholder="Type something" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right color-black-light">DB user:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="database_user" id="database_user" required placeholder="Type something" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-right color-black-light">DB password:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="database_password" id="database_password" placeholder="Type something" />
                        </div>
                    </div>

                    <div class="button-items">
                        <button type="submit" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light float-right" id="submit_btn">
                            Add
                        </button>
                    </div>

                </form>
            </div>
            <div class="tab-pane p-3" id="profile-1" role="tabpanel">
                <div class="table-rep-plugin">
                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                        <table id="tech-companies-1" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Country</th>
                                <th class="text-center">Edit | Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($countries)<1)
                            <td class="text-center p-2" colspan="2">No results to view</td>
                            @endif
                            @foreach($countries as $key => $item)
                            <tr>
                                <th class="p-2 text-center">{{$item->country_name}}</span></th>
                                <td class="text-center font-20 p-1">
                                    <i class="ion-edit" data-id="{{$item->id}}"
                                       data-code="{{$item->country_code}}"
                                       data-name="{{$item->country_name}}"
                                       data-db="{{$item->database_name}}"
                                       data-dbhost="{{$item->database_host}}"
                                       data-dbuser="{{$item->database_username}}"
                                       data-dbpassword="{{$item->database_password}}"
                                    >
                                    </i>
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
        $('#country_id').val($(this).data('id'));
        $('#country_name').val($(this).data('name'));
        $('#database_id').val($(this).data('db'));
        $('#database_host').val($(this).data('dbhost'));
        $('#database_user').val($(this).data('dbuser'));
        $('#database_password').val($(this).data('dbpassword'));
        $('#country_code').val($(this).data('code'));
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
