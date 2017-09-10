<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title></title>  
    <link rel="stylesheet" href="public/css/pintuer.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <script src="public/js/jquery.js"></script>
    <script src="public/js/pintuer.js"></script>  
</head>
<body>
<form method="post" action="index.php?m=admin&c=member&a=member">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 粉丝管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="submit" class="button border-red"><span class="icon-trash-o"></span> 批量删除</button>
        </li>
      </ul>
    </div>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>姓名</th>       
        <th>电话</th>
        <th>邮箱</th>
        <th>QQ</th>
        <th>注册时间</th>
        <th>操作</th>       
      </tr> 
	<?php if(!empty($user) ):?>
	<?php foreach($user as $key=>$value): ?>
        <tr>
          <td><input type="checkbox" name="id[]" value="<?=$value['uid']; ?>" />
            <?=$value['uid']; ?></td>
          <td><?=$value['username']; ?></td>
          <td><?=$value['phone']; ?></td>
          <td><?=$value['email']; ?></td>  
          <td><?=$value['qq']; ?></td>  
           <td><?=$value['regtime']; ?></td>         
          <td><div class="button-group"> <a class="button border-red" href="index.php?m=admin&c=member&a=member&uid=<?=$value['uid']; ?>" onclick="javascript:void(0)"><span class="icon-trash-o"></span> 删除</a> </div></td>
        </tr>
	<?php endforeach;?>
    <?php endif;?>
         
		 
		 <!-- <a href="">上一页</a> 
					<a href="">1</a>
					<a href="">2</a>
					<a href="">3</a>
					<a href="">下一页</a>
					<a href="">尾页</a>  -->
					
		<tr>
			<td colspan="8">
				<div class="pagelist"> 
					<a href="<?=$listpage['head']; ?>">首页</a>
					<a href="<?=$listpage['prev']; ?>">上一页</a>
					<a href="<?=$listpage['next']; ?>">下一页</a>
					<a href="<?=$listpage['last']; ?>">尾页</a>
				</div>
			</td>
		</tr>
		
    </table>
  </div>
</form>

<script type="text/javascript">

function del(id){
	if(confirm("您确定要删除吗?")){
		
	}
}

$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false; 		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

</script>


</body></html>