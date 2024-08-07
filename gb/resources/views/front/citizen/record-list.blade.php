@extends('layouts.master-citizen')
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
                    <li class="breadcrumb-item"><a href="{{url('citizen/home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Record List</a></li>
                </ol>
            </div>
            <h4 class="page-title">List of Your Records</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-body">
                <label class="col-form-label col-md-12 text-center color-black-light display-inline font-20">
                    Records Created For You
                </label>
                <table id="record_history_table" class="table table-bordered table-striped m-t-40">
                    <thead>
                    <tr>
                        <th class="text-center">Record Type</th>
                        <th class="text-center">Added By</th>
                        <th class="text-center">Created On</th>
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

    $('#record_history_table').DataTable({
        lengthMenu: false,
        searching: false,
        processing: false,
        serverSide: false,
        paging: true,
        ordering: false,
        info: true,
        autoWidth: false,
        ajax:{
            url: "{{ route('citizen.get_record_list') }}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'Record Type',
                    data: 'record_type',
                    class: 'text-center p-2',
                },
                {
                    name: 'Added By',
                    data: 'lrd_firstname',
                    class: 'text-center p-2',
                },
                {
                    name: 'Created On',
                    data: 'time_stamp',
                    class: 'text-center p-2'
                }
                ]
        });

    $('#record_history_table_length').addClass('d-none');

</script>
@endsection
