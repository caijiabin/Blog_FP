
<!DOCTYPE HTML>
<html>
<head>
<title>Contact</title>
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
<script type="text/javascript" src="public/js/jquery.easing.1.3.js"></script>
<!-- //grid-slider -->
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
			   <li><a href="index.php?m=index&c=index&a=index">首页</a></li>
			  <li><a href="index.php?m=index&c=blog&a=blog">博客</a></li>
			   <li class="active"><a href="index.php?m=index&c=index&a=contact">关于作者</a></li>
			   
				<?php if(empty($username)):?>
			   <li><a href="index.php?m=index&c=user&a=login">登录/注册</a></li>
			   <?php else:?>
			   <li><a href="index.php?m=index&c=user&a=collection">个人信息</a></li>
			    <li><a href="index.php?m=index&c=index&a=loginout">退出登录</a></li>
				<?php endif;?>
			 </ul>
			  <script type="text/javascript" src="public/js/nav.js"></script>
		  </div><!-- end h_menu4 -->
		 <div class="clear"></div>
	  </div>
	</div>
	<!-- end menu -->
    <div class="main">
		<img src="public/images/class_img.jpg">
        <div class="about_banner_wrap">
      	   <h1 class="m_11">关于博主</h1>
      	</div>
      	<div class="border"> </div>
      	<div class="rwo contact">
      	  <div class="container">
      		 <div class="col-md-8 contact-top">
			  <h3>给我留言</h3>
			  <p class="contact_msg">每个人注定都要经历一番失败的痛苦，一起加油。</p>
			     <form method="post" action="index.php?m=index&c=index&a=contact">
					<div class="to">
                     	<input type="text" class="text" name="name" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
						
					 	<input type="text" class="text" name="email"  value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" style="margin-left:20px">
						
					 <!-- 	<input type="text" class="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}" style="margin-left:20px"> -->
					</div>
					<div class="text">
	                   <textarea name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'message';}">Message:</textarea>
	                </div>
	                <div class="form-submit1">
			           <input name="submit" type="submit" id="submit" value="飞吧！留言" onclick="" /><br>
			           <p class="m_msg">留下正确邮箱，方便博主联系你</p>
					</div>
					<div class="clear"></div>
                 </form>
             </div>
			 
             <div class="col-md-4 contact-top_right">
			<!--   <h3>contact info</h3>
			  <p>diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis.</p> -->
			  
			  <ul class="contact_info">
			  	<li><i class="mobile"> </i><span>+1-900-235-2456</span></li>
			  	<li><i class="message"> </i><span class="msg">info(at)gym.com</span></li>
			  </ul>
	 		 </div>
			 
			 
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