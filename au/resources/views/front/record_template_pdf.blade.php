
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
    p {
        margin: 2px 0px;
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
            <?php
            $qa_info = "";
            $i = 0;
            $star_png = \URL::asset('assets/images/star.png');
            // dd(public_path("assets/images/star.png").'   '.$star_png);
            $yellow_star_png = \URL::asset('assets/images/yellow_star.png');
            $star_img = "<img src=$star_png width=14px/>";
            $yellow_star_img = "<img src=$yellow_star_png width=14px/>";

            foreach($qa_record_list as $qa_record_info) {
            $i++;

                if(isset($qa_record_info['answer_text'])){
                    $qa_record_info['answer_text'] = str_replace('<span class="fa fa-star"></span>', $star_img, $qa_record_info['answer_text']);
                    $qa_record_info['answer_text'] = str_replace('<span class="fa fa-star marked"></span>', $yellow_star_img, $qa_record_info['answer_text']);
                    $qa_record_info['answer_text'] = str_replace('<p>', '<p class="font-verdana">', $qa_record_info['answer_text']);
                    $qa_record_info['answer_text'] = str_replace('<p class="">', '<p class="font-verdana">', $qa_record_info['answer_text']);
                    $q_info = 'Q: '.$qa_record_info['question_name'];
                    $a_info = $qa_record_info['answer_text'];
                } else {
                    $q_info = 'Q: '.$qa_record_info['question_name'];
                    $a_info = 'A: ';
                }
            ?>

            <tr>
                <td>
                    {!! $q_info !!}
                </td>

            </tr>
            <tr>
                <td>
                    {!! $a_info !!}
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>


            <?php
                if($i == 7) {
                ?>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
                <?php
                }
                if(!isset($qa_record_info['answer_text'])){
                ?>
            <tr>
                <td>
                    &nbsp;
                </td>
            </tr>
<?php
                }
            }
            ?>
            </tbody>
        </table>

    </div>
</div>
</body>
</html>
