<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2"><?php echo $site;?></div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action="/admin/shop/doeditshop" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="typeid">所属分类</label>
      <select class="form-control" name="typeid" id='typeid'>
        <?php 
           foreach ($type as $v) {
              if($v['id']==$Shop['typeid']){
                $select = 'selected="selected"';
              }else{
                $select = '';
              }
              echo "<option {$select} value='{$v['id']}'>{$v['name']}</option>";       
           }
         ?>
      </select>
    </div>
    <div class="form-group">
      <label for="name">名称</label>
      <input type="text" class="form-control"  name="name" id="name" value="<?php echo $Shop['name'];?>">
    </div>
    <div class="form-group">
      <label for="tag">属性标签</label>
      <input type="text" class="form-control"  name="tag" id="tag"  value="<?php echo $Shop['tag'];?>">
    </div>
    <div class="form-group">
      <label for="price">价格</label>
      <input type="text" class="form-control"  name="price" id="price" value="<?php echo $Shop['price'];?>">
    </div>
    <div class="form-group">
      <label for="discount">优惠价格</label>
      <input type="text" class="form-control"  name="discount" id="discount" value="<?php echo $Shop['discount'];?>">
    </div>
    <div class="form-group">
      <label for="discountdate">优惠截止时间</label>
      <input type="text" class="form-control"  name="discountdate" id="discountdate" value="<?php echo $Shop['discountdate'];?>" >
    </div>
    <div class="form-group">
      <label for="exampleInputFile">图片</label>
      <input type="file" id="exampleInputFile" name='pic'>
      <!-- <p class="help-block">Example block-level help text here.</p> -->
    </div>
    <!-- <div class="form-group">
      <label for="passconf">重复密码</label>
      <input type="password" class="form-control" name="passconf"  id="passconf" placeholder="字母加数字">
    </div> -->
    <input type="hidden" name="id" value="<?php echo $Shop['id'];?>">
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
