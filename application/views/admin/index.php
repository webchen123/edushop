<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8 text-center">
    <table class="table table-hover " >
      <tdead>
        <tr style="font-weight: bold;">
          <td>#</td>
          <td>登录名</td>
          <td>姓名</td>
          <td>电话</td>
          <td>注册时间</td>
          <td>是否禁用</td>
          <td>操作</td>
        </tr>
      </tdead>
      <tbody>
        <?php foreach ($data as  $v): ?>
          <tr>
            <td scope="row"><?php echo $v['id'] ?></td>
            <td><?php echo $v['acount'] ?></td>
            <td><?php echo $v['name'] ?></td>
            <td><?php echo $v['phone'] ?></td>
            <td><?php echo $v['time'] ?></td>
            <td><?php echo $v['status']?'正常':'禁用'; ?></td>
            <td>
              <button type="button" class="btn btn-link"><a href="/admin/manager/editManager?id=<?php echo $v['id']?>">修改</a></button>
              <button type="button" class="btn btn-info " id="delManager">删除</button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-2"></div>
</div>
<script >
  $('#delManager').click(function(){
    var tr = $(this).parents('tr');
    var id = $(this).parents('tr').children().first().text();
    $.ajax({
      url:'/admin/manager/delManager',
      data:{'id':id},
      success:function(res){
        if(res){
            tr.remove();

            alert('删除成功');
        }else{
            alert('删除失败，联系管理员');
        }
      }      
    })
  })
</script>
