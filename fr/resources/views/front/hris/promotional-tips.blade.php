@extends('layouts.master-hris')
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
                    <li class="breadcrumb-item"><a href="{{url('hris/home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Promotional Tips</a></li>
                </ol>
            </div>
            <h4 class="page-title">Promote For Success </h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">
            <div class="card-body color-black-light">
                {!! $data !!}
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs m-t-10" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" data-toggle="tab" href="#software" role="tab" id="software_tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                            <span class="d-none d-sm-inline-block">HRIS Software</span>
                        </a>
                    </li>

                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link text-dark" data-toggle="tab" href="#both" role="tab" id="both_tab">
                            <span class="d-inline-block d-sm-none"><i class="fa fa-record"></i></span>
                            <span class="d-none d-sm-inline-block">Include ATS/VMS Software providers</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active p-3 " id="software" role="tabpanel">
                        <table id="hris_software_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">HRIS Provider</th>
                                <th class="text-center">Website</th>
                                <th class="text-center">Guide</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane p-3 " id="both" role="tabpanel">
                        <table id="hris_both_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">HRIS Provider</th>
                                <th class="text-center">Website</th>
                                <th class="text-center">Guide</th>
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
<!-- end row -->
@endsection
@section('script')
<script>
    $('#hris_software_table').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: true,
        autoWidth: false,
        "language": {
            "emptyTable": "<div><span class='pr-3 d-inline-block'>Details Awaiting Approval</span>" +
                "               <div class='sk-three-bounce d-inline-block m-0'>\n" +
                "            <div class='sk-child sk-bounce1' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce2' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce3' style='background: #3bc850;'></div>\n" +
                "               </div> " +
                "           </div>" +
                "<div class='mt-2'><span class='pr-3 d-inline-block'>Details Awaiting Approval</span>" +
                "               <div class='sk-three-bounce d-inline-block m-0'>\n" +
                "            <div class='sk-child sk-bounce1' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce2' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce3' style='background: #3bc850;'></div>\n" +
                "               </div> " +
                "           </div>" +
                "<div class='mt-2'><span class='pr-3 d-inline-block'>Details Awaiting Approval</span>" +
                "               <div class='sk-three-bounce d-inline-block m-0'>\n" +
                "            <div class='sk-child sk-bounce1' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce2' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce3' style='background: #3bc850;'></div>\n" +
                "               </div> " +
                "           </div>"
        },

        ajax:{
            url: "{{ route('hris.get_hris') }}",
            method:'post',
            data: function ( d ) {
                d.filter = 'software';
            },
        },
        columns:[
            {
                name: 'HRIS Provider',
                data: 'ocb_name',
                class: 'text-center',
            },
            {
                name: 'Website',
                data: 'website',
                class: 'text-center',
            },
            {
                name: 'Guide',
                data: 'hris_guide',
                class: 'text-center',
                render: function (data, type, row) {
                    return '<a href="{{url("public/upload")}}/'+data+'" target="_blank"><img src="{{asset("assets/images/pdf.png")}}" width="30px"></a>';
                }
            }
        ]
    });

    $('#hris_both_table').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: true,
        autoWidth: false,
        "language": {
            "emptyTable": "<div><span class='pr-3 d-inline-block'>Details Awaiting Approval</span>" +
                "               <div class='sk-three-bounce d-inline-block m-0'>\n" +
                "            <div class='sk-child sk-bounce1' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce2' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce3' style='background: #3bc850;'></div>\n" +
                "               </div> " +
                "           </div>" +
                "<div class='mt-2'><span class='pr-3 d-inline-block'>Details Awaiting Approval</span>" +
                "               <div class='sk-three-bounce d-inline-block m-0'>\n" +
                "            <div class='sk-child sk-bounce1' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce2' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce3' style='background: #3bc850;'></div>\n" +
                "               </div> " +
                "           </div>" +
                "<div class='mt-2'><span class='pr-3 d-inline-block'>Details Awaiting Approval</span>" +
                "               <div class='sk-three-bounce d-inline-block m-0'>\n" +
                "            <div class='sk-child sk-bounce1' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce2' style='background: #3bc850;'></div>\n" +
                "            <div class='sk-child sk-bounce3' style='background: #3bc850;'></div>\n" +
                "               </div> " +
                "           </div>"
        },

        ajax:{
            url: "{{ route('hris.get_hris') }}",
            method:'post',
            data: function ( d ) {
                d.filter = 'both';
            },
        },
        columns:[
            {
                name: 'HRIS Provider',
                data: 'ocb_name',
                class: 'text-center',
            },
            {
                name: 'Website',
                data: 'website',
                class: 'text-center',
            },
            {
                name: 'Guide',
                data: 'hris_guide',
                class: 'text-center',
                render: function (data, type, row) {
                    return '<a href="{{url("public/upload")}}/'+data+'" target="_blank"><img src="{{asset("assets/images/pdf.png")}}" width="30px"></a>';
                }
            }
        ]
    });
</script>
@endsection
