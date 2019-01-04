<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2"><?php echo $site;?></div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="/admin/type/doaddtype" method="post">
    <div class="form-group">
      <label for="type">所属分类</label>
      <select class="form-control" name="type" id='type'>
        <option value="0">顶级类别</option>
        <?php 
           foreach ($type as $v) {
              echo "<option value='{$v[id]}'>{$v['name']}</option>";       
           }
         ?>
      </select>
    </div>
    <div class="form-group">
      <label for="name">类别名称</label>
      <input type="text" class="form-control"  name="name" id="name" placeholder="字母加数字">
    </div>
    <!-- <div class="form-group">
      <label for="passconf">重复密码</label>
      <input type="password" class="form-control" name="passconf"  id="passconf" placeholder="字母加数字">
    </div> -->
    <button type="submit" class="btn btn-success"">提交</button>
    </form>
  </div>
  <div class="col-md-4"></div>
</div>
