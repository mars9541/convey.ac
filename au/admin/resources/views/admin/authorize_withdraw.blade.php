@extends('layouts.master')
@section('css')
<style>
    .login_user:hover{
        cursor: pointer;
    }
    .page-item.active .page-link {
        background-color: #3BC850 !important;
        border-color: #3BC850 !important;
    }
</style>
@endsection
@section('content')
<!-- Start right Content here -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Convey</a></li>
                    <li class="breadcrumb-item active"><a href="#">Authorize Withdrawals</a></li>
                </ol>
            </div>
            <h4 class="page-title">Authorize Withdrawals</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12 bg-white">
        <div class="card-body">
            <table id="business_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th class="text-center" width="20%">CBR ID</th>
                    <th class="text-center" width="30%">Receiver Account</th>
                    <th class="text-center" width="15%">Amount</th>
                    <th class="text-center" width="15%">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('script')
<script
    src="https://www.paypal.com/sdk/js?client-id=Af_Ms0n04D2x5xKfjM5sAqVwOKbRPSCFjq-ag1bKUh1-NqQAWFYsxPwV_FMcUsSrFzGlG3JoTuqjW2oh&currency=AUD"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>
<script>
    $('#business_table').DataTable({
        searching: true,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax:{
            url: "{{ route('get_withdraw_list') }}",
            method:'post',
            data: function ( d ) {
                d.filter = "pending";
            },
        },
        columns:[
            {
                name: 'CBR ID',
                data: 'referrer_CBR_id',
                class: 'text-center p-2',

            },
            {
                name: 'Receiver Account',
                data: 'wallet_id',
                class: 'text-center p-2'
            },
            {
                name: 'Amount',
                data: 'withdraw_amount_including_vat',
                class: 'text-center p-2',
            },
            {
                name: 'Status',
                data: 'status',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    if(data == 0) {
                        return 'Pending';
                    } else if(data == 1) {
                        return 'Approved';
                    } else {
                        return 'Failed';
                    }
                }
            },
            {
                name: 'Action',
                data: '',
                class: 'text-center p-2',
                render: function (data, type, row) {
                    var id = 'paypal_button_' + row.id;
                    return '<div class="paypal-button" payee_id="'+row.wallet_id+'" amount="'+row.withdraw_amount_including_vat+'" id="'+ id + '"></div>';

                }
            }
        ]
    });



    $('#business_select').on('change',function(){
        $('#business_table').DataTable().ajax.reload();
    })

    $(document).ready(function(){
        setTimeout(function() { render_button(); } ,  3000);
    })

    function render_button() {
        $('.paypal-button').each(function (index, el) {
            var payee_id = $(this).attr('payee_id');
            var amount = $(this).attr('amount');
            var id = this.id;

            paypal.Buttons({
                style: {
                    layout: 'horizontal',
                    tagline: false
                },
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
                                value: amount
                            },
                        payee: {
                            'email_address': payee_id
                        }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // This function captures the funds from the transaction.
                    return actions.order.capture().then(function(details) {
                        // This function shows a transaction success message to your buyer.
                        alert('Transaction completed by ' + details.payer.name.given_name);
                        update_withdraw(id, details.id);
                    });
                }
            }).render('#' + id);
        });
    }

    function update_withdraw(id, transaction_id)
    {
        var idArray = id.split("_");
        var formData = new FormData();
        formData.append('id', idArray[2]);
        formData.append('transaction_id', transaction_id);

        $.ajax({
            url:"{{ route('update_withdraw') }}",
            method:"POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success:function(html){
                window.location = "{{route('authorize_withdraw')}}";

            },
            error:function (e)
            {
                window.location = "{{route('authorize_withdraw')}}";
            }
        })
    }

</script>
@endsection
