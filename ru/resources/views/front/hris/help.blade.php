@extends('layouts.master-hris')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{url('hris/home')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Find Help</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Finding Help to Get You Started</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20 text-center">
                <div class="card-body" style="padding: 13px;">
                    <p class="m-0 color-black-light">If you are building a unique connection to the CONVEY DATABANK using our API, or you are looking for some 3rd party advice about how best to use CONVEYABLE records, you can find some independent professionals below. </p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs m-t-10" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" data-toggle="tab" href="#advisor" role="tab" id="advisor_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-home"></i></span>
                                <span class="d-none d-sm-inline-block">Find an Independent Business/HR Advisor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-toggle="tab" href="#develop" role="tab" id="develop_tab">
                                <span class="d-inline-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-inline-block">Find an Independent Business System/Software Developer</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active p-3" id="advisor" role="tabpanel">

                            <table id="advisors_provide_table" class="table table-bordered table-striped m-t-10 p-2">
                                <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Website</th>
                                    <th class="text-center">Type</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane p-3" id="develop" role="tabpanel">

                            <table id="advisors_develop_table" class="table table-bordered table-striped m-t-10 p-2">
                                <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Website</th>
                                    <th class="text-center">Type</th>
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
        $('#advisor_tab').on('click',function () {
            $('#advisors_provide_table').DataTable().ajax.reload();
        })
        $('#develop_tab').on('click',function () {
            $('#advisors_develop_table').DataTable().ajax.reload();
        })
        $('#advisors_provide_table').DataTable({
            searching: true,
            processing: true,
            serverSide: false,
            paging: true,
            ordering: true,
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
                url: "{{ route('help.get_advisors') }}",
                method:'post',
                data: function ( d ) {
                    d.type = 'advisor';
                },
            },
            columns:[
                {
                    name: 'Name',
                    data: 'ocb_name',
                    class: 'text-center',
                },
                {
                    name: 'Website',
                    data: 'website',
                    class: 'text-center',
                },
                {
                    name: 'Type',
                    data: 'id',
                    class: 'text-center',
                    render: function (data, type, row) {
                        return 'Advisor';
                    }
                }
            ]
        });

    </script>

    <script>
        $('#advisors_develop_table').DataTable({
            searching: true,
            processing: true,
            serverSide: false,
            paging: true,
            ordering: true,
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
                url: "{{ route('help.get_advisors') }}",
                method:'post',
                data: function ( d ) {
                    d.type = 'developer';
                },
            },
            columns:[
                {
                    name: 'Name',
                    data: 'ocb_name',
                    class: 'text-center',
                },
                {
                    name: 'Website',
                    data: 'website',
                    class: 'text-center',
                },
                {
                    name: 'Type',
                    data: 'id',
                    class: 'text-center',
                    render: function (data, type, row) {
                        return 'Developer';
                    }
                }
            ]
        });

    </script>
@endsection
