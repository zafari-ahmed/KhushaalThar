<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl?>/assets/print/images/favicon.ico">
        <title>Labor Print</title>
        <link href="<?php echo Yii::app()->baseUrl?>/assets/print/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl?>/assets/print/css/responsive.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl?>/assets/print/css/style.css" rel="stylesheet">

    </head>

    <body>
        <div class="heading">
            <div class="col-xs-4">
                <h1>Registration Form</h1>
            </div>
            <div class="col-xs-4 center">
                <img src="<?php echo Yii::app()->baseUrl?>/assets/print/images/logo.png" alt="img" style="width:80px"/>
            </div>
            <div class="col-xs-4 pull-right">
                <h2>فارم درخواست</h2>
            </div>
        </div>
        <div class="col-xs-12">
            <?php echo $content?>
        </div>
        <!-- ***********javascript*********** -->
        <script src="<?php echo Yii::app()->baseUrl?>/assets/print/js/jquery.js" type="text/javascript" ></script>
        <script src="<?php echo Yii::app()->baseUrl?>/assets/print/js/bootstrap.min.js" type="text/javascript" ></script>

    </body>

</html>
