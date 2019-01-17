<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 text-center h2"><?php echo $site;?></div>
  <div class="col-md-4"></div>
</div>
<div class="row" >
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <form class="form-inline" action="/admin/order/" style="margin: 10px 0;">
    <div class="form-group"> 
      <label for="phoneinput">电话：</label>
      <input type="text" name="phone" class="form-control" id="phoneinput" value="<?php echo  isset($where['phone'])?$where['phone']:'';?>"  >
    </div>
    <div class="form-group">
      <label for="phoneinput">状态：</label>
      <select name="status" class="form-control">
          <option value="0" >全部</option>
          <option value="1" <?php  echo isset($where['ispay'])? 'selected="selected"':'';?> >未支付</option>
          <option value="2" <?php  echo isset($where['isdeal'])? 'selected="selected"':'';?> >未处理</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">筛选</button>
  </form>
  </div>
  <div class="col-md-2"></div>
</div>  
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8 text-center">
    <table class="table table-hover " >
      <tdead>
        <tr style="font-weight: bold;">
          <td>#</td>
          <td>会员电话</td>
          <td>商品名</td>
          <td>订单价格</td>
          <td>订单号</td>
          <td>创建时间</td>
          <td>是否支付</td>
          <td>是否处理</td>
          <td>操作</td>
        </tr>
      </tdead>
      <tbody>
        <?php foreach ($order as  $v): ?>
          <tr>
            <td scope="row"><?php echo $v['id'] ?></td>
            <td><?php echo $v['phone'] ?></td>
            <td><?php echo $v['shopname']; ?></td>
            <td><?php echo $v['total']; ?></td>
            <td><?php echo $v['orderid'] ?></td>
            <td><?php echo $v['createtime'] ?></td>
            <td><?php echo $v['ispay'] ?'已支付':'未支付'; ?></td>
            <td><?php echo $v['isdeal'] ?'已处理':'未处理'; ?></td>
            <td>
              <button type="button" class="btn btn-success"><a href="/admin/shop/editshop?id=<?php echo $v['id']?>" style="color:white;">查看</a></button>
              <button type="button" class="btn btn-link delType" >处理</button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-2"></div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4 ">
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <?php echo $page['url']; ?>
      </ul>
    </nav>
  </div>
  <div class="col-md-4"></div>
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
