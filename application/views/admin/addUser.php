<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2">添加会员</div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="/admin/user/doadduser" method="post">
    <div class="form-group">
      <label for="name">昵称</label>
      <input type="name" class="form-control"  name="name" id="name" placeholder="登录名">
    </div>
    <div class="form-group">
      <label for="password">密码</label>
      <input type="password" class="form-control"  name="password" id="password" placeholder="字母加数字">
    </div>
    <div class="form-group">
      <label for="passconf">重复密码</label>
      <input type="password" class="form-control" name="passconf"  id="passconf" placeholder="字母加数字">
    </div>
    <div class="form-group">
      <label for="phone">电话</label>
      <input type="phone" class="form-control" name="phone"  id="phone" placeholder="电话">
    </div>
    <div class="radio">
      <label>
        <input type="radio" name="status" checked ="checked" value="1"> 是否启用
      </label>
    </div>
    <input type="hidden"  name="source"  id="source"  value="后台添加">
    <button type="submit" class="btn btn-success"">提交</button>
    </form>
  </div>
  <div class="col-md-4"></div>
</div>
