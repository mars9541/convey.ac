@extends('layouts.master-business')
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
                        <li class="breadcrumb-item"><a href="{{url('business/home')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Search Credits</a></li>
                    </ol>
                </div>
                <h4 class="page-title">LIMITED OFFER...</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-md-12">
            <div class="card m-b-20 text-center">
                <div class="card-body" style="padding: 13px;">
                    <label class="m-0 color-black-light text-bold" style="font-size: 2rem;">
                        Get 200% EXTRA search credits for FREE ...
                    </label>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <div class="col-md-12 m-t-15 text-center">
                            <p class="col-form-label col-md-12 color-black-light display-inline font-14" style="font-size: 1.7rem;">
                                Buy 4 search credits now, and we will give you 8 more for <b>FREE</b>
                            </p>
                            <p class="col-form-label col-md-12 color-black-light display-inline font-14" style="font-size: 1.4rem;">
                                This is an exclusive, one time offer only available to your account so don't miss out
                            </p>
                            <br>
                            <div id="paypal-button-container" class="col-md-3 pt-5" style="margin: auto;"></div>
                            <label class="m-0 color-black-light text-bold" style="font-size: 1.8rem;">
                                (This 200% Extra FREE Offer Expire Soon)
                            </label>
                        </div>

                    </div>
                    <div >

                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- end row -->

    <form action="{{route('business.buy_credits')}}" method="post" style="display: none" id="buy_credits_form">
        @csrf
        <input type="hidden" name="amount" id="buy_credits_amount">
    </form>
@endsection

@section('script')
    <script
        src="https://www.paypal.com/sdk/js?client-id=Af_Ms0n04D2x5xKfjM5sAqVwOKbRPSCFjq-ag1bKUh1-NqQAWFYsxPwV_FMcUsSrFzGlG3JoTuqjW2oh&currency=AUD"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
    </script>
    <script>
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
                url:"{{ route('business.paypal_buy_credits') }}",
                method:"POST",
                data:formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function(html){
                    // console.log(html);
                    // $('#show_redirect').show();
                                    window.location = "{{route('business.search-credits')}}";

                }
            })
        }



        function get_purchase_amount(package_number) {
            var formData = new FormData();

            formData.append('package_number', package_number);

            $.ajax({
                url:"{{ route('business.get_purchase_amount') }}",
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
                    buy_credits('4', details);
                    alert('Transaction completed by ' + details.payer.name.given_name);

                });
            },
            onError: (err) => {
                alert('error from the onError callback: ' + err);
            }
        }).render('#paypal-button-container');



        jQuery('document').ready(function(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const tab = urlParams.get('tab');

            if(tab && tab=='2')
            {
                $('#buy_more_tab').click();
            }
        })



    </script>
@endsection
