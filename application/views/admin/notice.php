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
</head>
<body>
    
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
        <div class="alert <?php echo $status? 'alert-success':'';'alert-danger' ?>" role="alert">
          <p class="text-center h1"><?php echo $msg;?></p>
          <a href="<?php echo $url;?>" class="alert-link">3秒后自动跳转或点击直接跳转</a>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
    <script >
        window.setTimeout(jump('<?php echo $url?>'), 3000);    
        function jump(url){
            window.location.href=url;
        }
    </script>
</body>
</html>