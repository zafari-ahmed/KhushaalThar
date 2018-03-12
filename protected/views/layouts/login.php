<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo Yii::app()->baseUrl?>/assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <?php echo $content?>
  </body>

  <script type="text/javascript">
      var BASE_URL = '<?php echo Yii::app()->baseUrl?>';
      var actionID = '<?php echo Yii::app()->controller->action->id?>';
      var controllerID = '<?php echo Yii::app()->controller->id?>';
    
    function displayAlert(title,text,type){
        PNotify.removeAll();
        new PNotify({
            title: title,
            text: text,
            type: type,
            hide: true,
            styling: 'bootstrap3',
            /*addclass: 'dark'*/
        });
      }
      
    </script>
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl?>/assets/vendors/pnotify/dist/pnotify.js"></script>

    <script type="text/javascript">
    $(document).keypress(function(e) {
      if(actionID=='index'){
        if(e.keyCode == 13) {
           $('#loginBtn').trigger('click');
        }  
      }
      if(actionID=='resetpassword'){
        if(e.keyCode == 13) {
           $('#resetBtn').trigger('click');
        }  
      }
      
    });
    

    $('#loginBtn').click(function(){
        if($('#email').val()!='' && $('#password').val()!=''){
          $.ajax( {
                url: BASE_URL+'/site/authenticate',
                type: 'POST',
                data: $('#loginForm').serialize(),
                success: function(data) {
                  var d = JSON.parse(data);
                    if(typeof d.error == 'undefined'){
                        displayAlert('Success',d.success,'success');
                        window.location = BASE_URL+'/dashboard';
                    } else{
                        if(typeof d.expire == 'undefined'){
                          displayAlert('Warning',d.error,'error');
                        } else{
                          displayAlert('Warning',d.error,'error');
                          setTimeout(function(){ window.location = d.link; }, 3000);
                          
                        }
                    }
                },
            });
        } else{
          displayAlert('Warning','Enter required fields','error');
        }
    });
    $('#resetBtn').click(function(){
        if($('#password').val()!='' && $('#conf_password').val()!=''){
          $.ajax( {
                url: BASE_URL+'/site/changepassword',
                type: 'POST',
                data: $('#resetForm').serialize(),
                success: function(data) {
                  var d = JSON.parse(data);
                    if(typeof d.error == 'undefined'){
                        displayAlert('Success',d.success,'success');
                        window.location = BASE_URL;
                    } else{
                        displayAlert('Warning',d.error,'error');
                    }
                },
            });
        } else{
          displayAlert('Warning','Enter required fields','error');
        }
    });

    $('#forgotBtn').click(function(e){

        if($('#email_reset').val()!=''){
          displayAlert('','Loading...','success');
          e.preventDefault();
          $.ajax( {
                url: BASE_URL+'/site/forgotemail',
                type: 'POST',
                data: $('#forgotForm').serialize(),
                success: function(data) {
                  var d = JSON.parse(data);
                    if(typeof d.error == 'undefined'){
                        displayAlert('Success',d.success,'success');
                        //window.location = BASE_URL;
                    } else{
                        displayAlert('Warning',d.error,'error');
                    }
                },
            });
        } else{
          displayAlert('Warning','Enter required fieldsss','error');
        }
    });
    
    </script>
</html>
