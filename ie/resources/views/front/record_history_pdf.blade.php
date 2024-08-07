
<!DOCTYPE >
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
    @font-face {
        font-family: 'verdana1';
        src: url({{ storage_path('fonts\verdana.ttf') }}) format('truetype');
        font-weight: 400;
        font-style: normal;
    }

    .fa-star:before {

        /*content: "\2729";*/
        content:"";
    }

    .font-verdana {
        font-family: 'verdana1' !important;
    }

    td {
        font-family: 'verdana1' !important;
    }

    *, ::after, ::before {
        box-sizing: border-box;
    }
    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: 24px;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    * {
        outline: none !important;
    }
    *, ::after, ::before {
        box-sizing: border-box;
    }
    /*input{*/
    /*    margin-left:50px;*/
    /*}*/
    p > input, p > img:nth-of-type(1){
        margin-left:50px;
    }
    p:nth-child(even) {
        margin: 0 0 5px 0 !important;
        font-family: 'verdana1' !important;
    }

    p:nth-child(odd) {
        margin: 0 0 15px 0 !important;
        font-family: 'verdana1' !important;
    }
</style>

</head>
<body style="background-color:white;">
<div class="row" >

    <div style="background-color:white;">
        <table>
            <tr>
                <div>
                    @if($record_logo)
                        <img src="{{url('public/upload')}}/{{$record_logo}}" style="float: right; height: 50px;"/>
                    @else
                        <img src="{{url('public')}}/logo.png" style="float: right; height: 50px;"/>
                    @endif
                </div>
            </tr>
        </table>
        <table>
            <tr>
                <div style="margin-top: 120px;">
                    <div style="text-align: center; font-size: 20px;" class="font-verdana">
                        {{$record_title}}
                    </div>

                </div>
            </tr>
        </table>
        <table style="min-width: 600px">
            <tbody>

            <tr>
                <div class="modal-body">
                    {!! $qa_info !!}
                </div>
            </tr>

            </tbody>
        </table>

    </div>
</div>
</body>
</html>
