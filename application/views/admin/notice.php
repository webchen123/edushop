<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="/static/js/jquery-1.11.3.min.js"></script>
    <script src="/static/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css">
    <title>消息通知</title>
    <style>
      .text-center p{
          font-size: 24px;
      }
    </style>
</head>
<body>
    
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center"  style="font-color:white;">
        <div class="alert <?php echo $status? 'alert-success':'alert-danger'; ?>" role="alert">
          <p class="text-center"  ><?php echo $msg;?></p>
          <a href="<?php echo $url;?>" class="alert-link" style="color:black;">3秒后自动跳转或点击直接跳转...</a>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
    <script >
        setTimeout(function jump(){
            window.location.href='<?php echo $url;?>';
        },2000);    
    </script>
</body>
</html>