@extends('layouts.master-hris')
@section('css')
<style>
    .ion-edit:hover{
        cursor: pointer;
    }
    .list-inline-item .text-muted{
        white-space: nowrap;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                   
                </ol>
            </div>
            <h4 class="page-title"></h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-20">
            <div class="card-body p-0">
                <div class="form-group">
                    <span type="button" class="btn waves-effect waves-light mt-1 offset-sm-2 col-md-8 color-black-light" style="font-size: 30px;font-weight: bolder;" >
                        Welcome to Your CONVEY Account...
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 mb-4 font-30 color-black-light text-center">Connection Stats</h4>
                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li class="list-inline-item">
                                <i class="fa fa-bar-chart-o text-convey-green"></i>
                                <h5 class="mb-0">{{$connection->total}}</h5>
                                <p class="text-muted font-14">Total Connections </p>
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-line-chart text-danger"></i>
                                <h5 class="mb-0">{{$connection->this_month}}</h5>
                                <p class="text-muted font-14">This Months Connections </p>
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-area-chart text-danger"></i>
                                <h5 class="mb-0">{{$connection->last_month}}</h5>
                                <p class="text-muted font-14">Last Months Connections  </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 mb-4 font-30 color-black-light text-center">Referral Stats</h4>
                        <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                            <li class="list-inline-item">
                                <i class="fa fa-edit (alias) text-convey-green transform-13"></i>
                                <h5 class="mb-0">{{$total->signup}}</h5>
                                <p class="text-muted font-14">Total SignUp</p>
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-money text-danger transform-13"></i>
                                <h5 class="mb-0">{{round($total->sales,2)}}</h5>
                                <p class="text-muted font-14">Total Sales</p>
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-percent text-convey-green"></i>
                                <h5 class="mb-0">{{round($total->yours, 2)}}</h5>
                                <p class="text-muted font-14">Your 20%</p>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            @foreach($article as $item)
            <div class="col-md-4">
                <div class="card m-b-20 card-body">
                    <h3 class="card-title font-20 mt-0 text-center color-black-light">{{$item->title}}</h3>
                    <p class="card-text color-black-light">{{substr(strip_tags($item->description), 0, 300)}}</p>
                    <div class="col-sm-6 offset-sm-6 text-right">
                        <a href="javascript:get_article('{{$item->id}}')" class="card-link text-right color-black-light" ><span class="font-15">Read More...</span></a>
                    </div>
                </div>

                
            </div>
            @endforeach

            
            
        </div>

    </div>

</div><!-- container -->

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

@endsection  

@section('script')
<script>
    function get_article(id){
        $.ajax({
            url:"{{route('hris.get_article')}}",
            method:"POST",
            data: {
                id:id,
            },
            dataType:"json",
            success:function(html){
                $('#article_title').html(html.title)
                $('#article_detail').html(html.description);
                $('.bs-example-modal-lg').modal('show');
            },
            error:function(){
                alertify.logPosition("top right");
                alertify.error('Server Error!');
            }
        })
    };

</script>
@endsection