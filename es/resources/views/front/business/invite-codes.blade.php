@extends('layouts.master-business')
@section('css')
<style>
    .ion-edit:hover{
        cursor: pointer;
    }
    #withdraw_btn:disabled,#show_edit_bank:disabled{
      background-color: #516277;
      border: 1px solid #516277;
    }

    /* ==============
  Pricing
===================*/
    .invite-icon {
        display: inline-block;
        width: 100%;
        height: 100%;
        color: #ffffff;
        line-height: 25px;
        overflow: hidden;
        border: 5px solid #ffffff;
        border-radius: 10%;
        -webkit-box-shadow: 0 0 3px #0c0c0c;
        box-shadow: 0 0 3px #0c0c0c;
        -webkit-transition: all .3s;
        transition: all .3s;
        padding-bottom: 25px;
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
                    <li class="breadcrumb-item active"><a href="#">Invite Codes</a></li>
                </ol>
            </div>
            <h4 class="page-title">Manage Your Invite Codes</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-md-12">
        <div class="row mb-2">
            <div class="col-md-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        {{--<h3 >Invite…</h3>--}}
                        <span class="invite-icon bg-darker-grey">
                            <p style="margin-top: 2rem; font-size: 2rem; font-weight: bold;">Invite…</p>
                            <p class="m-0" style="font-size: 1rem; margin-top: 1rem;">
                                Send an email to your contacts inviting them to check us out
                            </p>
                            <a href="javascript:view_temp()" style="color: #ffffff;">(see example)</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <span class="invite-icon" style="background-color: #585858;">
                            <p style="margin-top: 2rem; font-size: 2rem; font-weight: bold;">Include…</p>
                            <p class="m-0" style="font-size: 1rem; margin-top: 1rem;">
                                Include a unique referral code which gives them 50% more credits on their first purchase.
                            </p>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <span class="invite-icon" style="background-color: #383636;">
                            <p style="margin-top: 2rem; font-size: 2rem; font-weight: bold;">Profit…</p>
                            <p class="m-0" style="font-size: 1rem; margin-top: 1rem;">
                                You get 20% of whatever they spend.
                                <br>
                                (Not just once but for life)
                            </p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs m-t-10" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#your_code" role="tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-key"></i></span>
                        <span class="d-none d-sm-inline-block">Your Code</span>
                    </a>
                </li>

                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#payments_received" role="tab" id="received_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-list-alt"></i></span>
                        <span class="d-none d-sm-inline-block">Payments Received</span>
                    </a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-dark" data-toggle="tab" href="#withdraw_funds" role="tab" id="withdraw_tab">
                        <span class="d-inline-block d-sm-none"><i class="fa fa-paypal"></i></span>
                        <span class="d-none d-sm-inline-block">Withdraw Funds</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3 bg-custom-grey" id="your_code" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center h-100">
                                <div class="card-body color-black-light">
                                    <h6 class="text-center color-black-light m-t-40">Universal Codes</h6>
                                    <div class="text-left m-t-20">
                                        <p class="color-black-light">Our universal codes expire after 10 days, you can generate one code every 30 days and one code can be shared with multiple businesses.</p>
                                    </div>
                                    <div class="text-center m-t-20" id="universal_code">
                                        @if(!isset($universal_code) || isset($universal_code) && $universal_code->message == '')
                                            <form action="{{route('business.generate_universal_code')}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light">Click to reveal Your Code</button>
                                            </form>
                                        @else
                                            @if($universal_code->view_code == 'yes')
                                                <div class="row">
                                                    <input type="text" class="form-control display-inline col-sm-4 offset-4" value="{{$universal_code->invite_code}}" readonly>
                                                    <span class="display-inline col-sm-4 text-left m-t-5 color-black-light" >{{$universal_code->message}}</span>
                                                </div>
                                            @else
                                                <span class="text-center color-black-light">{{$universal_code->message}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body color-black-light">
                                    <h6 class="text-center m-t-40 color-black-light">Unique Codes</h6>
                                    <div class="text-left m-t-20">
                                        <p class="color-black-light">Unique codes last for 10 days and can be sent to just one other business, the advantage with unique codes is that after you send your email containing the link, we will send 2 reminder emails to your contacts.</p>
                                    </div>
                                    <table id="unique_code_table" class="table table-bordered table-striped m-t-20">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="33%">Your contacts email address</th>
                                            <th class="text-center" width="33%">Unique code</th>
{{--                                            <th class="text-center" width="33%">Expires on</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div class="text-center m-t-20">
                                        <button type="button" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light" id="add_unique_code">Add another line</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--<div class="table-rep-plugin">
                        <div class="mb-0" data-pattern="priority-columns">
                            <div class="row p-1">
                                <div class="card col-md-6">
                                    <div class="card-body">
                                        <h6 class="text-center color-black-light">Universal Codes</h6>
                                        <div class="text-left m-t-20">
                                            <p class="color-black-light">Our universal codes expire after 10 days, you can generate one code every 30 days and one code can be shared with multiple businesses.</p>
                                        </div>
                                        <div class="text-center m-t-20" id="universal_code">
                                            @if(!isset($universal_code)||isset($universal_code)&&$universal_code->message =='')
                                            <form action="{{route('business.generate_universal_code')}}" method="post">
                                                @csrf
                                            <button type="submit" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light">Click to reveal Your Code</button>
                                            </form>
                                            @else
                                                @if($universal_code->view_code == 'yes')
                                                <div class="row">
                                                    <input type="text" class="form-control display-inline col-sm-4 offset-4" value="{{$universal_code->invite_code}}" readonly>
                                                    <span class="display-inline col-sm-4 text-left m-t-5 color-black-light" >{{$universal_code->message}}</span>
                                                </div>
                                                @else
                                                    <span class="text-center color-black-light">{{$universal_code->message}}</span>
                                                @endif

                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card col-md-6">
                                    <div class="card-body">
                                        <h6 class="text-center m-t-40 color-black-light">Unique Codes</h6>
                                        <div class="text-left m-t-20">
                                            <p class="color-black-light">Unique codes last for 10 days and can be sent to just one other business, the advantage with unique codes is that after you send your email containing the link, we will send 2 reminder emails to your contacts.</p>
                                        </div>
                                        <table id="unique_code_table" class="table table-bordered table-striped m-t-20">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="33%">Your contacts email address</th>
                                                    <th class="text-center" width="33%">Unique code</th>
                                                    <th class="text-center" width="33%">Expires on</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div class="text-center m-t-20">
                                            <button type="button" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light" id="add_unique_code">Add another line</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>--}}

                </div>
                <div class="tab-pane p-3" id="payments_received" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="col-md-12 text-center m-t-40">
                                <h4 class="text-center m-t-40 color-black-light">Received funds: €<span id="received_amout">0</span></h4>
                                <div class="text-center m-t-20">
                                    <p>(minimum amount to be withdrawn €100).</p>
                                </div>
                                <table id="received_table" class="table table-bordered table-striped m-t-20">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="25%">You Referred</th>
                                        <th class="text-center" width="25%">They Spent</th>
                                        <th class="text-center" width="25%">Your 20%</th>
                                        <th class="text-center" width="25%">Transaction Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane p-3" id="withdraw_funds" role="tabpanel">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <div class="col-md-12">
                              <div class="card m-b-20 text-center">
                                  <div id="withdraw_done" class="card-body bg-success" style="display: none; background-color: #3bc850 !important;padding: 13px;">
                                      <p class="m-0" style="color: white;">Withdrawal Requested... Awaiting Manual Approval.</p>
                                  </div>
                              </div>

                              <div id="bank_account_box" class="card m-b-20 text-center"  >
                                  <div>
                                  <h3>Paypal Account Details</h3>
                                  <span style ="cursor: pointer; color:#3BC850;position: absolute; top: 15px; right: 25%;" id="edit_bank_box" class="d-inline-block"><i class="fa fa-pencil"></i></span>
                                  </div>
                                  <div id="bank_account_details">
                                      <div class="color-black-light row">
                                          <label class="col-form-label col-md-4 text-right color-black-light"></label>
                                          <label class="col-form-label col-md-3 text-left color-black-light">PayPal Address:</label>
                                          <label class="col-form-label col-md-3 text-left color-black-light" id="paypal_account">{{$paypal_account}}</label>
                                          <label class="col-form-label col-md-2 text-left color-black-light"></label>
                                      </div>
                                  </div>
                              </div>

                                <div class="text-center">
                                    <button type="button" id="withdraw_btn" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light">
                                    <div style="display:none;" class="loading-show2">
                                      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                    Withdraw €<span id="withdrawn_amount">0</span> Now</button>
                                </div>

                                <table id="withdraw_table" class="table table-bordered table-striped m-t-20">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="25%">Withdrawal Date </th>
                                        <th class="text-center" width="25%">Amount</th>
                                        <th class="text-center" width="25%">Status</th>
                                        <th class="text-center" width="25%">View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center p-2">10 12 20</td>
                                        <td class="text-right p-2">50.00</td>
                                        <td class="text-center p-2">Pending</td>
                                        <td class="text-center p-2">Payment Advice Note</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>

    </div>
</div>
<!-- end row -->

<div class="modal fade" id="unique_code_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Unique Code Generate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <div class="color-black-light row">
                    <label class="col-form-label col-md-3 text-right color-black-light" for="email">Email Address</label>
                    <input type="text" class="col-sm-8 form-control" name="email" id="email" />
                </div>
                <div class="row color-black-light m-t-20">
                    <label class="col-form-label col-md-3 text-right color-black-light" for="record_type">Unique Code</label>
                    <input type="text" class="col-sm-8 form-control" name="code" id="unique_code" readonly />
                </div>
                <a href="javascript:generate_unique_code()" class="float-right text-convey-green">Generate Unique Code</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-convey-green text-white" id="unique_code_generate">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-lg" id="article_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="article_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="form-group" id="article_detail">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade bs-example-modal-lg" id="bank_account" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title mt-0">Receiving Paypal Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>

            <div class="modal-body">
              <form id = "bank_form" action="post" onsubmit="return false;">
                <div class="color-black-light row">
                    <label class="col-form-label col-md-3 text-right color-black-light" for="email">Reciever account</label>
                    <input type="text" class="col-sm-8 form-control" name="receiver_account" id="receiver_account"  value="{{$paypal_account}}" />
                    <div class="col-md-3"></div> <div class="col-sm-8"><span class="bank_error error" id="receiver_account_error"></span></div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="save_bank" type="button" class="btn bg-emerald text-white btn-wd-200 waves-effect waves-light" >
                  <div class="loading-hide">
                    <span>Save</span>
                  </div>
                  <div style="display:none;" class="loading-show">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script')

<script>

    $(document).ready(function (){
        setTimeout(function (){
            var max_height = $('.col-md-4 >.card')[0].offsetHeight;
            $($('.col-md-4 >.card')[1]).css('height', max_height+'px');
            $($('.col-md-4 >.card')[2]).css('height',max_height+'px');
        },200 );
    })
    function view_temp()
    {
        $.ajax({
            url:"{{ route('business.get_guide_temp') }}",
            method:"POST",
            data: {
                item:'business_email',
            },
            cache:false,
            dataType:"json",
            success:function(data)
            {
                $('#article_detail').html(data);
                $('#article_modal').modal('show');
            },
            error:function (e)
            {
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }

        })

    }

    $('#unique_code_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "{{ route('business.get_unique_code') }}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'Your contacts email address',
                    data: 'assigned_to',
                    class: 'text-center p-2',
                },
                {
                    name: 'Unique code',
                    data: 'invite_code',
                    class: 'text-center p-2',
                }/*,
                {
                    name: 'Expires on',
                    data: 'expires_on',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        var y = data.substr(0,4);
                        var m = data.substr(5,2);
                        var d = data.substr(8,2);
                        return m+'/'+d+'/'+y;
                    }
                }*/
                ]
        });

    $('#add_unique_code').on('click', function(){
        $('#unique_code').val('');
        $('#unique_code_modal').modal('show');
    })

    var rand = function() {
        return Math.random().toString(36).substr(2); // remove `0.`
    };

    var token = function() {
        return rand(); // to make it longer
    };

    function generate_unique_code()
    {
        $('#unique_code').val(token());
        if($('#email').val() != '') {
            $('#form_result').html('');
        }
    }

    $('#unique_code_generate').on('click', function() {
        if(($('#email').val()!='') && ($('#unique_code').val()!=''))
        {
            $.ajax({
                url:"{{ route('business.save_unique_code') }}",
                method:"POST",
                data: {
                    email:$('#email').val(),
                    unique_code:$('#unique_code').val(),
                },
                cache:false,
                dataType:"json",
                success:function(data)
                {
                    $('.loading-show2').css('display','none');

                    if(data.status == 'success') {
                        $('#unique_code_modal').modal('hide');
                        $('#unique_code_table').DataTable().ajax.reload();
                    } else if(data.status == "already_exist") {
                        html='<div class="alert alert-convey-danger">The email address you entered has already received an invite.</div>';
                        $('#form_result').html(html);
                    }
                }
            })
        }else{

            html='<div class="alert alert-convey-danger">Please fill out</div>';
            $('#form_result').html(html);
        }
    })

    function get_received_amount()
    {
        $.ajax({
            url:"{{ route('business.get_received_amount')}}",
            method:"POST",
            data: {

            },
            cache:false,
            dataType:"json",
            success:function(data)
            {
                if(data.amount)
                {
                    var amount = (Math.round(data.amount * 100) / 100).toFixed(2);
                    $('#received_amout').html(amount);
                    $('#withdrawn_amount').html(amount);
                    if(data.amount < 100){
                      $('#withdraw_btn').prop( "disabled", true );
                    }
                    paypal_withdraw_amount = amount;
                }else{
                    $('#received_amout').html('0');
                    $('#withdrawn_amount').html('0');
                    $('#withdraw_btn').prop( "disabled", true );
                }
            }
        })
    }
</script>
<script>


    $('#received_tab').on('click', function(){
        get_received_amount();
        $('#received_table').DataTable().ajax.reload();
    });
    $('#received_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: false,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "{{ route('business.receive_his') }}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'You Referred',
                    data: 'referrer_email',
                    class: 'text-center p-2',
                },
                {
                    name: 'They Spent',
                    data: 'spent_amount',
                    class: 'text-center p-2',
                },
                {
                    name: 'Your 20%',
                    data: 'deposit_amount_including_vat',
                    class: 'text-center p-2',
                },
                {
                    name: 'View',
                    data: 'date_of_wallet_deposit',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        var Y = data.substr(0,4);
                        var m = data.substr(5,2);
                        var d = data.substr(8,2)
                        return m+'/'+d+'/'+Y;
                    }
                }
                ]
        });
</script>
<script>
    $('#withdraw_tab').on('click', function(){
        get_received_amount();
    });

    function withdraw_request(){
        var withdraw_amount = $('#withdrawn_amount').html();
        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#receiver_account').val()))
        {
            if(parseInt(withdraw_amount) >= 100){
                $('.loading-show2').css('display','contents');
                $('#withdraw_btn').prop('disabled', true);
                $.ajax({
                    url:"{{ route('business.withdraw_request')}}",
                    method:"POST",
                    data: {
                        amount:withdraw_amount,
                    },
                    cache:false,
                    dataType:"json",
                    success:function(data)
                    {
                        $('.loading-show2').css('display','none');
                        if(data.status=='success')
                        {
                            $('#withdraw_done').show();
                            get_received_amount();
                            $('#withdraw_table').DataTable().ajax.reload();
                        }
                    }
                });
            }
        }else{
            confirm('Please confirm your paypal address!');
        }

    }

    $('#edit_bank_box').on('click', function(){
        $('#bank_account').modal('show');
    });

    $('#save_bank').on('click', function(){
        // $('.bank_error').hide();
        $('.loading-hide').hide();
        $('.loading-show').show();
        $('#save_bank').prop('disabled', true);
        $.ajax({
            url:"{{ route('business.add_paypal') }}",
            method:"POST",
            data: new FormData(document.getElementById("bank_form")),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data){

                $('#withdraw_btn').show();
                get_received_amount();
                $('#bank_account').modal('hide');
                $('.loading-hide').show();
                $('.loading-show').hide();
                $('#save_bank').prop('disabled', false);
                $('#paypal_account').html($('#receiver_account').val());
            }
        });
    })

    $('#withdraw_btn').on('click', function(){
      // withdraw_action();
      withdraw_request();
    });

    $('#withdraw_table').DataTable({
            // lengthMenu: false,
        searching: false,
        processing: true,
        serverSide: false,
        paging: true,
        ordering: false,
        info: false,
        autoWidth: false,
        ajax:{
            url: "{{ route('business.withdraw_his') }}",
            method:'post',
            data:{
                    _token: $('meta[name="_token"]').attr('content')
                }
        },
        columns:[
                {
                    name: 'Withdrawal Date',
                    data: 'date_of_withdraw',
                    class: 'text-center p-2',
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
                        if(data == '0') {
                            $('#withdraw_done').show();
                          return "Pending";
                        } else if(data == '1'){
                          return "Approved";
                        } else if(data == '2'){
                          return "Failed";
                        }
                    }
                },
                {
                    name: 'View',
                    data: 'id',
                    class: 'text-center p-2',
                    render: function (data, type, row) {
                        if(row.status == '0') {
                            return '';
                        } else if(row.status == '1') {
                            return `<a href="{{url('business/advice_note_download')}}/`+data+`" class="text-convey-green">payment advice note</a>`;
                        }
                    }
                }
                ]
        });

</script>

@endsection
