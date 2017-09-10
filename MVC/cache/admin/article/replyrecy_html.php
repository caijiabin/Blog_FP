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
<form method="post" action="index.php?m=admin&c=article&a=replyrecy" id="listform">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 回收列表</strong> <a href="" style="float:right; display:none;"></a></div>
 
    <table class="table table-hover text-center">
      <tr>
        <th width="100" style="text-align:left; padding-left:20px;">ID</th>
		 <th>回复者</th>
		<th>对应文章</th>
        <th width="30%">回复内容</th>
       
        <th>回复时间</th>
        <th width="210">操作</th>
      </tr>
      <volist name="list" id="vo">
	  <?php if(!empty($replyrecy)):?>
	  <?php foreach($replyrecy as $key=>$value): ?>
        <tr>
          <td style="text-align:left; padding-left:20px;"><input type="checkbox" name="id[]" value=" <?=$value['rid']; ?>" />
           <?=$value['rid']; ?></td>	
		<td> <?=$value['username']; ?></td>		   
          <td><?=$value['title']; ?></td>
          <td> <?=$value['rcontent']; ?></td>
         
          <td> <?=$value['comtime']; ?></td>
          <td>
			<div class="button-group">
				<a class="button border-red" href="index.php?m=admin&c=article&a=replyrecy&id=<?=$value['rid']; ?>" onclick=""><span class="icon-trash-o"></span> 恢复</a>
				<!-- onclick="del(<?=$value['id']; ?>)" -->
			</div>
		  </td>
        </tr>
		<?php endforeach;?>
		<?php endif;?>
		 	 
      <tr>
        <td colspan="7" style="text-align:left;padding-left:20px;">
		<button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
        <button type="submit" class="button border-green"><span class="icon-trash-o"></span> 批量恢复</button>
			
	    </td> 
      </tr>
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

//搜索
function changesearch(){	
		
}

//单个删除
function del(id,mid,iscid){
	if(confirm("您确定要彻底删除吗?")){
		
	}
}

//全选
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

//批量删除
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
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>
</body>
</html>