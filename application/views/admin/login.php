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
    <title>后台登录</title>
</head>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2">后台登录</div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="/admin/login/dologin" method="post">
    <div class="form-group">
      <label for="acount">登录名</label>
      <input type="acount" class="form-control"  name="acount" id="acount" placeholder="登录名">
    </div>
    <div class="form-group">
      <label for="password">密码</label>
      <input type="password" class="form-control"  name="password" id="password" placeholder="字母加数字">
    </div>
    <div class="form-group">
      <label class="sr-only" for="exampleInputAmount">验证码</label>
      <div class="input-group">
        <div class="input-group-addon">验证码</div>
        <input type="text" class="form-control" id="exampleInputAmount" name="captword">
        <div class="input-group-addon" style="padding:0;" id="capt"></div>
      </div>
    </div>
    <button type="submit" class="btn btn-success"">登录</button>
    </form>
  </div>
  <div class="col-md-4"></div>
</div>
</body>
</html>
<script type="text/javascript">
  //获取验证码
  function getCaptcha(){
      $.get('/admin/login/captcha/',{},function(data){
          $('#capt').html(data);
      })
  }
  getCaptcha();
  $('#capt').click(getCaptcha);
</script>
