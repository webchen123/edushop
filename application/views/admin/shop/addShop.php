<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2"><?php echo $site;?></div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="/admin/shop/doaddshop" method="post">
    <div class="form-group">
      <label for="typeid">所属分类</label>
      <select class="form-control" name="typeid" id='typeid'>
        <?php 
           foreach ($type as $v) {
              echo "<option value='{$v[id]}'>{$v['name']}</option>";       
           }
         ?>
      </select>
    </div>
    <div class="form-group">
      <label for="name">名称</label>
      <input type="text" class="form-control"  name="name" id="name">
    </div>
    <div class="form-group">
      <label for="tag">属性标签</label>
      <input type="text" class="form-control"  name="tag" id="tag"  placeholder="属性标签以“-”分割">
    </div>
    <div class="form-group">
      <label for="price">价格</label>
      <input type="text" class="form-control"  name="price" id="price" >
    </div>
    <div class="form-group">
      <label for="discount">优惠价格</label>
      <input type="text" class="form-control"  name="discount" id="discount" >
    </div>
    <div class="form-group">
      <label for="discountdate">截止时间</label>
      <input type="text" class="form-control"  name="discountdate" id="discountdate" >
    </div>
    <div class="form-group">
      <label for="exampleInputFile">课程图片</label>
      <input type="file" id="exampleInputFile" name='pic'>
      <!-- <p class="help-block">Example block-level help text here.</p> -->
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
<script >
  var date = new Date();
  $('#discountdate').datetimepicker({
    format: 'yyyy-mm-dd',
    language:'zh-CN',
    minView:2,
    todayHighlight:true,
    startDate:date,
    autoclose:true
});
</script>
