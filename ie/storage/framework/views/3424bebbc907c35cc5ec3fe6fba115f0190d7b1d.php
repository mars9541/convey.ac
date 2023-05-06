
<!DOCTYPE >
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
    @font-face {
        font-family: 'verdana1';
        src: url(<?php echo e(storage_path('fonts\verdana.ttf')); ?>) format('truetype');
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
                    <?php if($record_logo): ?>
                        <img src="<?php echo e(url('public/upload')); ?>/<?php echo e($record_logo); ?>" style="float: right; height: 50px;"/>
                    <?php else: ?>
                        <img src="<?php echo e(url('public')); ?>/logo.png" style="float: right; height: 50px;"/>
                    <?php endif; ?>
                </div>
            </tr>
        </table>
        <table>
            <tr>
                <div style="margin-top: 120px;">
                    <div style="text-align: center; font-size: 20px;" class="font-verdana">
                        <?php echo e($record_title); ?>

                    </div>

                </div>
            </tr>
        </table>
        <table style="min-width: 600px">
            <tbody>

            <tr>
                <div class="modal-body">
                    <?php echo $qa_info; ?>

                </div>
            </tr>

            </tbody>
        </table>

    </div>
</div>
</body>
</html>
<?php /**PATH /home/sites/15a/f/fc05c3f35d/public_html/ie/resources/views/front/record_history_pdf.blade.php ENDPATH**/ ?>