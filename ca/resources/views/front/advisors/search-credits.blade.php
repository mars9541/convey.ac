@extends('layouts.master-advisors')
@section('css')
<style>
.ion-edit:hover{
    cursor: pointer;
}
.page-item.active .page-link {
    background-color: #3BC850 !important;
    border-color: #3BC850 !important;

}

.page-item .page-link {
    color: #5b636d !important;
}

.num-green-circle {
    font-size: 22px !important;
    padding-top: 8px !important;
    border: 4px solid #3BC850 !important;
    color: #3BC850 !important;
}
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{url('advisors/home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#">Search Credits</a></li>
                </ol>
            </div>
            <h4 class="page-title">Manage Your Search Credits</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20 text-center">
            <div class="card-body" style="padding: 13px;">
                <p class="m-0 color-black-light">Use 1 search credit to find employment records for your new applicant uploaded by their previous employers.</p>
            </div>
        </div>
        @if ($payment['payment'])
            @if ($payment['success'])
                <div class="card m-b-20 text-center">
                    <div class="card-body bg-success" style="background-color: #3bc850 !important;padding: 13px;">
                        <p class="m-0" style="color: white;">Payment succeeded, your credits have been added.</p>
                    </div>
                </div>
            @else
            <div class="card m-b-20 text-center">
                <div class="card-body bg-danger" style="padding: 13px;">
                    <p class="m-0 color-black-light">Payment cancelled, please try again or contact the site administrator if you think it's an error.</p>
                </div>
            </div>
            @endif
        @endif
        <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#current_credits" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-credit-card"></i></span>
                        <span class="d-none d-sm-inline-block">Current Credits</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#buy_more" role="tab" id="buy_more_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-money"></i></span>
                        <span class="d-none d-sm-inline-block">Buy More</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#usage" role="tab" id="history_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user-times"></i></span>
                        <span class="d-none d-sm-inline-block">Usage</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#invoices" role="tab" id="invoices_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-user-times"></i></span>
                        <span class="d-none d-sm-inline-block">Invoices</span>
                    </a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="current_credits" role="tabpanel">
                    <form class="" action="#">
                        <div class="form-group row">
                            <!-- <div class="col-md-12 m-t-15 text-center">
                                <label class="col-form-label col-md-12 color-black-light display-inline font-18">Use 1 search credit to find employment records for your new applicant uploaded by their previous employers.</label>
                            </div> -->
                            <div class="col-md-12 text-center">
                                <label class="col-form-label text-right color-black-light display-inline font-32 m-r-5" for="record_type">You currently have</label>
                                <div class="num-green-circle display-inline" id="div_credit">{{$credit}}</div>
                                <label class="col-form-label text-right color-black-light font-32 p-2" for="record_type">credits.</label>
                            </div>
                            <div class="col-md-12 m-t-15 text-center">
                                <label class="col-form-label col-md-12 color-black-light display-inline font-18">If your search delivers no results you will not be charged a credit, also if you have searched for the same person multiple times in a 6 month period you will only be charged 1 credit.  </label>
                            </div>

                        </div>


                    </form>
                </div>

                <div class="tab-pane p-3" id="buy_more" role="tabpanel">
                    <form class="" action="#">
                        <div class="row text-center" style="background: #f2f5f7;">
                            <div style="width:7%"></div>
                            <div class="col-lg-3 m-t-30">
                                <div class="card plan-card mb-4">
                                    <div class="card-body">
                                        <div class="pt-3 pb-3">
                                            <span class="plan-icon circle-text bg-light-grey"><p style="    margin-top: 25px;">SMALL<br>SIZE<br>BUSINESS<p></span>
                                            <!-- <h6 class="text-uppercase text-primary">Starter Pack</h6> -->
                                        </div>
                                        <div>
                                            <h1 class="plan-price padding-b-15">$18<span class="text-muted m-l-10 valign-init"><sup class="font-18">each</sup></span></h1>
                                            <div class="plan-div-border"></div>
                                        </div>
                                        <div class="plan-features pb-3 mt-3 text-muted padding-t-b-30 line-height-50">
                                            <p class="font-18 line-height-40">When you buy <br>4 credits at a <br>time.</p>

                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="width:5%"></div>
                            <div class="col-lg-3 m-t-30">
                                <div class="card plan-card mb-4">
                                    <div class="card-body">
                                        <div class="pt-3 pb-3">
                                            <span class="plan-icon circle-text bg-darker-grey"><p style="    margin-top: 25px;">MEDIUM<br>SIZE<br>BUSINESS<p></span>
                                        </div>
                                        <div>
                                            <h1 class="plan-price padding-b-15">$14 <span class="text-muted m-l-10 valign-init"><sup class="font-18">each</sup></span></h1>
                                            <div class="plan-div-border"></div>
                                        </div>
                                        <div class="plan-features pb-3 mt-3 text-muted padding-t-b-30 line-height-50">
                                            <p class="font-18 line-height-40">When you buy <br>12 credits at a <br>time.</p>
{{--                                            <a href="javascript:buy_credits('2');" class="btn bg-convey-green m-t-15 text-white">BUY NOW</a>--}}
                                            <div id="paypal-button-container1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="width:5%"></div>
                            <div class="col-lg-3 m-t-30">
                                <div class="card plan-card mb-4">
                                    <div class="card-body">
                                        <div class="pt-3 pb-3">
                                            <span class="plan-icon circle-text bg-light-black"><p style="    margin-top: 25px;">LARGE<br>SIZE<br>BUSINESS<p></span>
                                        </div>
                                        <div>
                                            <h1 class="plan-price padding-b-15">$8<span class="text-muted m-l-10 valign-init"><sup class="font-18">each</sup></span></h1>
                                            <div class="plan-div-border"></div>
                                        </div>
                                        <div class="plan-features pb-3 mt-3 text-muted padding-t-b-30 line-height-50">
                                            <p class="font-18 line-height-40">When you buy <br>100 credits at a <br> time.</p>
{{--                                            <a href="javascript:buy_credits('3');" class="btn bg-convey-green text-white">BUY NOW</a>--}}
                                            <div id="paypal-button-container2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </form>
                </div>


                <div class="tab-pane p-3" id="usage" role="tabpanel">
                    <div class="custom-padding-top">
                        <table id="credits_history" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">New Balance</th>
                                <th class="text-center">Branch</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane p-3" id="invoices" role="tabpanel">
                    <div class="custom-padding-top">
                        <table id="invoice_table" class="table table-bordered table-striped m-t-40">
                            <thead>
                            <tr>
                                <th class="text-center">Document Type</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices_paymentreceipt as $item)
                            <tr>
                                <td class="text-center p-2">Invoice</td>
                                <td class="text-center p-2">{{date_format(date_create($item->date_of_payment),'d/m/Y')}}</td>
                                <td class="text-center p-2 download"><a href="{{route('advisors.invoice_download',['id'=>$item->id])}}" class="text-convey-green">Download</a></td>
                            </tr>
                            <tr>
                                <td class="text-center p-2">Payment Receipt</td>
                                <td class="text-center p-2">{{date_format(date_create($item->date_of_payment),'d/m/Y')}}</td>
                                <td class="text-center p-2 download"><a href="{{route('advisors.receipt_download',['id'=>$item->id])}}" class="text-convey-green">Download</a></td>
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

<form action="{{route('advisors.buy_credits')}}" method="post" style="display: none" id="buy_credits_form">
    @csrf
    <input type="hidden" name="amount" id="buy_credits_amount">
</form>
@endsection

@section('script')
<script
    src="https://www.paypal.com/sdk/js?client-id=Af_Ms0n04D2x5xKfjM5sAqVwOKbRPSCFjq-ag1bKUh1-NqQAWFYsxPwV_FMcUsSrFzGlG3JoTuqjW2oh&currency=CAD"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>
<script>
    var first_package_amount = 0;
    var second_package_amount = 0;
    var third_package_amount = 0;

    $(document).ready(function(){
        get_purchase_amount();
    })

    function buy_credits(package_type, details)
    {
        var formData = new FormData();
        formData.append('package_type', package_type);
        formData.append('create_time', details.create_time);
        formData.append('id', details.id);

        $.ajax({
            url:"{{ route('advisors.paypal_buy_credits') }}",
            method:"POST",
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(html){
                // console.log(html);
                // $('#show_redirect').show();
                /*console.log($('#div_credit').html());
                var balance = $('#div_credit').html();
                balance = balance + html.credit;
                $('#div_credit').html(balance);
console.log(balance);*/
                window.location = "{{route('advisors.search-credits')}}";
            }
        })
    }

    function get_purchase_amount(package_number) {
        var formData = new FormData();

        formData.append('package_number', package_number);

        $.ajax({
            url:"{{ route('advisors.get_purchase_amount') }}",
            method:"POST",
            data:formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(html){
                first_package_amount = html.amount.first_amount;
                second_package_amount = html.amount.second_amount;
                third_package_amount = html.amount.third_amount;
            }
        })
    }

    paypal.Buttons({
        style: {
            layout: 'vertical',
            // tagline: false
        },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: first_package_amount
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                buy_credits('1', details);
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
        },
        onError: (err) => {
            alert('error from the onError callback: ' + err);
        }
    }).render('#paypal-button-container');

    paypal.Buttons({
        style: {
            layout: 'vertical',
            // tagline: false
        },
        enableStandardCardFields: true,
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                intent: 'CAPTURE',
                /*payer: {
                    name: {
                        given_name: "PayPal",
                        surname: "Customer"
                    },
                    address: {
                        address_line_1: '123 ABC Street',
                        address_line_2: 'Apt 2',
                        admin_area_2: 'San Jose',
                        admin_area_1: 'CA',
                        postal_code: '95121',
                        country_code: 'US'
                    },
                    email_address: "customer@domain.com",
                    phone: {
                        phone_type: "MOBILE",
                        phone_number: {
                            national_number: "14082508100"
                        }
                    }
                },*/
                purchase_units: [{
                    amount: {
                        value: second_package_amount
                    }/*,
                    payee: {
                        'email_address': 'xiaogao323@gmail.com'
                    }*/
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                buy_credits('2', details);
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
        }
    }).render('#paypal-button-container1');

    paypal.Buttons({
        style: {
            layout: 'vertical',
            // tagline: false
        },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: third_package_amount
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                buy_credits('3', details);
                alert('Transaction completed by ' + details.payer.name.given_name);
            });
        }
    }).render('#paypal-button-container2');

    jQuery('document').ready(function(){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const tab = urlParams.get('tab');

        if(tab && tab == '2')
        {
            $('#buy_more_tab').click();
        }
    })

    $('#history_tab').on('click',function(){
        $('#credits_history').DataTable().ajax.reload();
    })

    $('#credits_history').DataTable({
            // lengthMenu: false,
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: false,
        autoWidth: false,

        ajax:{
            url: "{{ route('advisors.search_credits') }}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'Date',
                    data: 'time_stamp',
                    class: 'text-center p-2',
                    render:function (data,type,row){
                        var y = data.substr(0,4);
                        var m = data.substr(5,2);
                        var d = data.substr(8,2);
                        return d+'/'+m+'/'+y;
                    }
                },
                {
                    name: 'New Balance',
                    data: 'balance',
                    class: 'text-center p-2',
                },
                {
                    name: 'Branch',
                    data: 'branch_name',
                    class: 'text-center p-2',
                },
                {
                    name: 'Action',
                    data: 'adjustment_value',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(data=='1')
                            return 'added';
                        else
                            return 'usage';

                    }
                },

                ]
        });




    $('#invoice_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: false,
        // order : [[1,'desc']],
        autoWidth: false
    })

</script>
@endsection
