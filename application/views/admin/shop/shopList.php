<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2"><?php echo $site;?></div>
  <div class="col-md-4"></div>
</div>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8 text-center">
    <table class="table table-hover " >
      <tdead>
        <tr style="font-weight: bold;">
          <td>#</td>
          <td>商品名称</td>
          <td>所属类别</td>
          <td>图片</td>
          <td>价格</td>
          <td>优惠价</td>
          <td>优惠截止时间</td>
          <td>添加时间</td>
          <td>操作</td>
        </tr>
      </tdead>
      <tbody>
        <?php foreach ($Shop as  $v): ?>
          <tr>
            <td scope="row"><?php echo $v['id'] ?></td>
            <td><?php echo $v['classname'] ?></td>
            <td><?php echo $v['typename']; ?></td>
            <td style="width: 72px;"><img src="<?php echo $v['pic'] ?>"   class="img-rounded img-responsive"> </td>
            <td ><?php echo $v['price'] ?></td>
            <td><?php echo $v['discount'] ?></td>
            <td><?php echo $v['discountdate'] ?></td>
            <td><?php echo $v['time'] ?></td>
            <td>
              <button type="button" class="btn btn-success"><a href="/admin/shop/editshop?id=<?php echo $v['id']?>" style="color:white;">修改</a></button>
              <button type="button" class="btn btn-link delType" >删除</button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-2"></div>
</div>
<script >
  $(function(){
    $('.delType').click(function(){
      var tr = $(this).parents('tr');
      var id = $(this).parents('tr').children().first().text();
      $.ajax({
        url:'/admin/shop/delShop',
        data:{'id':id},
        success:function(res){
          switch(res) {
            case '0':
              alert('删除失败，联系管理员');
              break;
            case '1':
              tr.remove();
              alert('删除成功');
              break;
            default :
              alert('分类存在子类不可删除');
              break;
          }
        }      
      })
    })
  })
</script>
