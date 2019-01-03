<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2"><?php echo $site;?></div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="/admin/shop/doeditType" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name">分类名称</label>
      <input type="text" class="form-control"  name="name" id="name" value="<?php echo $type['name']?> ">
    </div>
    <div class="form-group">
      <label for="recode">备注</label>
      <input type="text" class="form-control"  name="recode" id="recode"   value="<?php echo $type['recode']?> ">
    </div>
    <div class="form-group">
      <label for="exampleInputFile">分类图片</label>
      <input type="file" id="exampleInputFile" name='img'>
      <!-- <p class="help-block">Example block-level help text here.</p> -->
    </div>
    <!-- <div class="form-group">
      <label for="passconf">重复密码</label>
      <input type="password" class="form-control" name="passconf"  id="passconf" placeholder="字母加数字">
    </div> -->
    <input type="hidden" name="id" value="<?php echo $type['id'];?>">
    <button type="submit" class="btn btn-success"">提交</button>
    </form>
  </div>
  <div class="col-md-4"></div>
</div>
