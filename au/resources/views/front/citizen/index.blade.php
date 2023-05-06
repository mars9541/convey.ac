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
                    <button type="button" class="btn waves-effect waves-light mt-1 offset-sm-2 col-md-8 color-black-light" style="font-size: 30px;font-weight: bolder;" role="button" data-toggle="popover" data-trigger="focus"  >
                        Welcome to Your CONVEY Account...
                    </button>
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
@endsection  

@section('script')
<script>
    function get_article(id){
        $.ajax({
            url:"{{route('citizen.get_article')}}",
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