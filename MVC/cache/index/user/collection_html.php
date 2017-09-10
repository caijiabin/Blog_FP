<!DOCTYPE HTML>
<html>
<head>
<title>collection</title>
<link href="public/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="public/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="public/js/jquery.min.js"></script>
<!-- grid-slider -->
<script type="text/javascript" src="public/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="public/js/jquery.contentcarousel.js"></script>
<!-- //grid-slider -->
<!---calender-style---->
<link rel="stylesheet" href="public/css/jquery-ui.css" />
<!---//calender-style---->				  
</head>
<body>
<!-- start header_bottom -->
	  <div class="header-bottom">
		 <div class="container">
			<div class="header-bottom_left">
				<i class="phone"> </i><span>1-200-346-2986</span>
			</div>
			<div class="social">	
			   <ul>	
				  <li class="facebook"><a href="#"><span> </span></a></li>
				  <li class="twitter"><a href="#"><span> </span></a></li>
				  <li class="pinterest"><a href="#"><span> </span></a></li>	
				  <li class="google"><a href="#"><span> </span></a></li>
				  <li class="tumblr"><a href="#"><span> </span></a></li>
				  <li class="instagram"><a href="#"><span> </span></a></li>	
				  <li class="rss"><a href="#"><span> </span></a></li>							
			   </ul>
		   </div>
		   <div class="clear"></div>
		</div>
	  </div>
	  <!-- start menu -->
    <div class="menu">
	  <div class="container">
		 <div class="logo">
			<a href="index.html"><img src="public/images/logo.png" alt=""/></a>
		 </div>
		 <div class="h_menu4"><!-- start h_menu4 -->
		   <a class="toggleMenu" href="#">Menu</a>
			 <ul class="nav">
			  <li ><a href="index.php?m=index&c=index&a=index">首页</a></li>
			   <li ><a href="index.php?m=index&c=blog&a=blog">博客</a></li>
			   <li><a href="index.php?m=index&c=index&a=contact">关于作者</a></li>		
			   <li class="active"><a href="index.php?m=index&c=user&a=collection">个人信息</a></li>
			    <li><a href="index.php?m=index&c=index&a=loginout">退出登录</a></li>
			 </ul>
			  <script type="text/javascript" src="public/js/nav.js"></script>
		  </div><!-- end h_menu4 -->
		 <div class="clear"></div>
	  </div>
	</div>
	<!-- end menu -->
	<div class="main">
	   <div class="about_banner_img"><img src="public/images/about_img.jpg" class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <h1 class="m_11">我的收藏</h1>
      	 </div>
      	 <div class="about-wrapper">
      	    <div class="container">
		       <div class="row about-top">
				 <div class="col-md-5">
				  <img src="public/images/about_img1.jpg" class="img-responsive" alt=""/> 
			     </div>
				 <div class="col-md-7 about-left-text">
				   <h2>Lorem ipsum dolorsit!</h2>
				   <p>nostrud exerci tation ullamcorper suscipit lobortis.</p>
				    <div class="btn3">
				       <a href="index.php?m=index&c=user&a=memberinfo">个人信息修改</a>
			         </div>	
					  <div class="buttons_login">
					  
				  	 <div class="btn4">
					 <?php if(empty($type)):?>
				       <a href="index.php?m=index&c=index&a=contact">我要留言</a>
					 <?php else:?>
					  <a href="index.php?m=admin&c=index&a=adlogin">后台管理</a>
					 <?php endif;?>
			         </div>	
					 
			         <div class="p-ww">

					  <form>
					   <input class="date" id="datepicker" type="text" value=" 今日日历" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'View Calender';}">
					  </form>
				     </div>
			         <div class="clear"></div>
			         <!---strat-date-piker---->
				  <script src="public/js/jquery-ui.js"></script>
				  <script>
				  $(function() {
				    $( "#datepicker" ).datepicker();
				  });
				  </script>
				  </div>
					 
				 </div>
                 <div class="clear"></div>	
               </div>
		    </div>
	      </div>
		 	  
	      	<div class="container" style="margin-right:0;" >
      		<div class="row single-top" style="margin-left:60px;margin-right:-60px;">
			   <div class="col-md-4" style="width:80%" >
			    
					<ul class="single_times" style="margin-bottom:0px;">
					 	<h3>我的 <span class="opening">收藏夹</span></h3>
						<?php if(empty($collect)):?>
					 	<li><i class="calender"> </i><span class="week_class">帖子标题</span><div class="hours_class">发表时间</div>  <div class="clear"></div></li>
						<?php else:?>
						<?php foreach($collect as $key=>$value): ?>
						<li><a href="index.php?m=index&c=blog&a=blog_single&id=<?=$value['id']; ?>"><i class="calender"> </i><span class="week_class"><?=$value['title']; ?></span><div class="hours_class"><?=$value['addtime']; ?></div>  <div class="clear"></div></a></li>
						<?php endforeach;?>
						<?php endif;?>
						
					</ul>		
		  	   <div class="col-md-8" style="text-align:center">
				<ul class="dc_pagination dc_paginationA dc_paginationA06">
				<?php if(empty($listpage)):?>
				   <li><a href="" class="current">首页</a></li>
				  <li><a href="">上一页</a></li>
				  <li><a href="">下一页</a></li>
				  <li><a href="" class="current">尾页</a></li>
				 <?php else:?>
				  <li><a href="<?=$listpage['head']; ?>" class="current">首页</a></li>
				  <li><a href="<?=$listpage['head']; ?>">上一页</a></li>
				  <li><a href="<?=$listpage['head']; ?>">下一页</a></li>
				  <li><a href="<?=$listpage['head']; ?>" class="current">尾页</a></li>
				 <?php endif;?>
				</ul>
			   </div>
			   
				
				
		   	     </div>
				<div class="clear"></div>
			  </div>
      	</div> 
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row section group">
				<div class="col-md-4">
					<img src="public/images/logocai.png" height="171" width="324"/>
				</div>
				<div class="col-md-4">
					<div class="f-logo">
					<img src="public/images/logo.png" alt=""/>
					</div>
					<p class="m_9"><?=$data['sdescription']; ?></p>

					<p class="address">QQ交流群 : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="m_10"><?=$data['s_qqu']; ?></span></p>
					<p class="address">电子邮箱: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="m_10"><?=$data['s_email']; ?></span></p>
					<p class="address">网站网址: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="m_10"><?=$data['surl']; ?></span></p>
				</div>
				<div class="col-md-4" style="padding:0 0;">
					<ul class="list" style="padding:0;" >
						<h4 class="m_7">通信地址:</h4>
						<li style="list-style:none;margin:0;"><a>地 址：<?=$data['s_address']; ?></a></li>
						<li style="list-style:none;margin:0;"><a>联系人：<?=$data['s_contact']; ?></a></li>
						<li style="list-style:none;margin:0;"><a>QQ：<?=$data['s_qq']; ?></a></li>
					</ul>
					<ul class="list1">
						<h4 class="m_7">友情链接</h4>
						<li><a href="#">大兵哥博客</a></li>
						<li><a href="#">博主论坛</a></li>
						<li><a href="#">php学院</a></li>
						<li><a href="#">阿里巴巴</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="copyright">
		<div class="container">
			<div class="copy">
				<p>&copy;copyright &nbsp;&nbsp;<?=$data['scopyright']; ?>&nbsp;&nbsp;站点信息</p>
			</div>
			<div class="social">	
				<ul>	
					<li class="facebook"><a href="#"><span> </span></a></li>
					<li class="twitter"><a href="#"><span> </span></a></li>
					<li class="pinterest"><a href="#"><span> </span></a></li>	
					<li class="google"><a href="#"><span> </span></a></li>
					<li class="tumblr"><a href="#"><span> </span></a></li>
					<li class="instagram"><a href="#"><span> </span></a></li>	
					<li class="rss"><a href="#"><span> </span></a></li>							
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div style="display:none">
		<script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script>
	</div>
	</body>
</html>