<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <link rel="shortcut icon" href="images/favicon.ico">
        <title>Applicant ID Card</title>
        <link href="<?php echo Yii::app()->baseUrl?>/assets/card/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl?>/assets/card/css/responsive.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl?>/assets/card/css/style.css" rel="stylesheet">

    </head>

    <body>
        <?php echo $content?>
        <!-- ***********javascript*********** -->
        <script src="<?php echo Yii::app()->baseUrl?>/assets/card/js/jquery.js" type="text/javascript" ></script>
        <script src="<?php echo Yii::app()->baseUrl?>/assets/card/js/bootstrap.min.js" type="text/javascript" ></script>

    </body>

</html>

