
<!DOCTYPE HTML>
<html>
<head>
<title>Blog_single</title>
<link href="public/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="public/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
 -->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="public/js/jquery.min.js"></script>
<!-- grid-slider -->
<script type="text/javascript" src="public/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="public/js/jquery.contentcarousel.js"></script>
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
			<a href="index.html"><img src="public/images/logo.png" class="img-responsive" alt=""/></a>
		 </div>
		 <div class="h_menu4"><!-- start h_menu4 -->
		   <a class="toggleMenu" href="#">Menu</a>
			 <ul class="nav">
			   <li><a href="index.php?m=index&c=index&a=index">首页</a></li>
			   <li class="active"><a href="index.php?m=index&c=blog&a=blog">博客</a></li>
			   <li><a href="index.php?m=index&c=index&a=contact">关于作者</a></li>

				<?php if(empty($username)):?>
			   <li><a href="index.php?m=index&c=user&a=login">登录/注册</a></li>
			   <?php else:?>
			   <li><a href="index.php?m=index&c=user&a=collection">个人信息</a></li>
			    <li><a href="index.php?m=index&c=index&a=loginout">退出登录</a></li>
				<?php endif;?>
			 </ul>
			  <script type="text/javascript" src="public/js/nav.js"></script>
		  </div>
		  
		  <!-- end h_menu4 -->
		  
		 <div class="clear"></div>
	  </div>
	</div>
	<!-- end menu -->
	 <div class="main">
       <div class="about_banner_img"><img src="public/images/blog_single.jpg"  class="img-responsive" alt=""/></div>
		 <div class="about_banner_wrap">
      	    <a href="index.php?m=index&c=blog&a=blog" ><h1 class="m_11">Blog<span class="class_1">&nbsp;&nbsp; &gt;&nbsp;&nbsp;&nbsp;&nbsp; <?=$article['title']; ?> </span></h1></a>
      	</div>
      	<div class="border"> </div>
      	<div class="container">
		
		  <div class="row single-top">
		  	   <div class="col-md-8" style="width:100%">
		  	     <div class="blog_single_grid">
				  <ul class="links_blog">
				  	<h3><a href=""><?=$article['title']; ?> </a></h3>
		  			<li><a href="#"><i class="blog_icon5"> </i><span><?=$article['addtime']; ?></span></a> <div class="clear"></div></li>
		  			<li><a href="#"><i class="blog_icon6"> </i><span>caijiabin</span></a><div class="clear"></div></li>
					
					<?php if(empty($article['likered'])):?>
					<li><a href="index.php?m=index&c=blog&a=likedo&id=<?=$article['id']; ?>&do=1" title="点赞" ><img src="public/images/1zan.png"/><span>&nbsp;&nbsp;<?=$article['likecount']; ?></span></a></li>
					<?php else:?> 
					<li><a href="index.php?m=index&c=blog&a=cancel&id=<?=$article['id']; ?>&do=1" title="取消赞" ><img src="public/images/2zan.png"/><span>&nbsp;&nbsp;<?=$article['likecount']; ?></span></a></li>
					<?php endif;?>
	
		  			<li><a href="index.php?m=index&c=blog&a=blog_single&id=<?=$article['id']; ?>#reply"><i class="blog_icon8"> </i><span><?=$recount; ?></span></a><div class="clear"></div></li>
					

					<?php if(!empty($article['isred'])):?>
					<li><a href="index.php?m=index&c=blog&a=nocollect&id=<?=$article['id']; ?>&do=1" title="取消收藏"><i class="blog_icon3"><img src="public/images/1heart.png"/></i><br></a></li>
					<?php else:?> 
					<li><a href="index.php?m=index&c=blog&a=collect&id=<?=$article['id']; ?>&do=1" title="添加收藏"><i class="blog_icon3"></i><br><span></span></a></li>
					<?php endif;?>
					<li>
						<span class="postcom">
							<a class="bshareDiv" style="margin-left: 500px;  float:left;" href="http://www.bshare.cn/share">点击分享</a>
							<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=bc4840eb-1a02-4d9b-948b-1ee39f3935c6&amp;
							style=1&amp;bp=qqmb,bsharesync,sinaminiblog,qzone,renren,tianya,shouji,ifengmb,neteasemb,qqxiaoyou,weixin,qqim">
							</script>
						</span>					
					</li>
		  		  </ul>
				<!--   <img src="public/images/blog_single1.jpg" class="img-responsive" alt=""/> -->
				  <div class="blog_single_desc">
				    <p class="m_16"><?=$article['content']; ?></p>
				  </div>
				  <ul class="social_blog">	
				   	<h3>Share</h3>
					 <li class="fb"><a href="#"><span> </span></a></li>
					 <li class="tw"><a href="#"><span> </span></a></li>
					 <li class="google_blog"><a href="#"><span> </span></a></li>
					 <li class="linkedin"><a href="#"><span> </span></a></li>	
					 <div class="clear"></div>
				 </ul>
				 <ul class="comments">
				 <a href="reply" name="reply"></a>
				
				 	<h4>当前<?=$recount; ?>条评论</h4>
					
					<?php if(!empty($reply)):?>
					<?php foreach($reply as $key => $value): ?>				
			        <li>
			        	<ul class="comment_head">
			        		<h5><?=$value['username']; ?>&nbsp;&nbsp;&nbsp; <span class="m_21"><a href="#"><?=$value['comtime']; ?></a></span></h5> <div class="reply1"><i class=""> </i><span class="m_22"><a href=""> </a></span></div><div class="clear"></div>
			        	</ul>
						<?php if(empty($value['picture'])):?>
			            <i class="preview"><img src="public/images/deficon.jpg"/></i>
						<?php else:?>
			            <i class="preview"><img src="<?=$value['picture']; ?>" height="56"/> </i>
						<?php endif;?>
			            <div class="data">
			               <p><?=$value['rcontent']; ?></p>
			            </div>
			            <div class="clear"></div>
			        </li>				
					<?php endforeach;?>
					<?php endif;?>
				<!-- 分页开始 -->
				<!-- <ul class="dc_pagination dc_paginationA dc_paginationA06">
				  <li><a href="" class="current">首页</a></li>
				  <li><a href="" class="current">上一页</a></li>
				  <li><a href="" class="current">下一页</a></li>
				  <li><a href="" class="current">尾页</a></li>
		       </ul> -->
			   
			   
			   <ul class="dc_pagination dc_paginationA dc_paginationA06">
				  <li><a href="<?=$listpage['head']; ?>&id=<?=$article['id']; ?>" class="current">首页</a></li>
				  <li><a href="<?=$listpage['prev']; ?>&id=<?=$article['id']; ?>" class="current">上一页</a></li>
				  <li><a href="<?=$listpage['next']; ?>&id=<?=$article['id']; ?>" class="current">下一页</a></li>
				  <li><a href="<?=$listpage['last']; ?>&id=<?=$article['id']; ?>" class="current">尾页</a></li>
		       </ul>
			   
			   
	  			 	<h4>留下你的评论吧</h4>
					 <a href="reply" name="reply"></a>
	  			  <form id="commentform" action="index.php?m=index&c=blog&a=blog_single&id=<?=$article['id']; ?>" method="post">
				
					 <p class="comment-form-comment">
						<label for="comment">Comment</label>
						<textarea id="comment" name="rcontent" cols="45" rows="8" aria-required="true"></textarea>
					 </p>
					<p class="form-submit">
			           <input name="submit" type="submit" id="submit" value="Send">
					</p>
					<div class="clear"></div>
				   </form>
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