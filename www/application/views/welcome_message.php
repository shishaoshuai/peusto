<!DOCTYPE html>
<html>
	<head>
		<title>Peusto时间管理网</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Peusto是个人管理工具的提供商，旨在通过这些工具，提高个人管理效率，提高时间管理、时间规划和时间运用的能力。">
		<meta name="author" content="Peusto">
		<meta name="keywords" content="个人管理,时间管理,时间跟踪,时间规划">
		<meta name="robots" content="index,follow">
		<!-- Bootstrap -->
		<link href="<?php echo asset_url();?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo asset_url();?>/css/docs.css" rel="stylesheet" media="screen">
	</head>
	<body onload="document.forms[0].elements[0].focus()">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<ul class="nav">
					<li class="active"><a href="#">首页</a></li>
					<li><a href="#">帮助</a></li>
					<li><a href="#">关于</a></li>
				</ul>
                <?php
                    $attributes = array('class' => 'navbar-form pull-right');
                    echo form_open('user/login',$attributes);
                ?>
					用户名：<input class="input-large" name="name" type="text" placeholder="用户名/电子邮件/手机号">
					<input class="input-small" name="password" type="password" placeholder="密码">
					<button class="btn btn-primary" type="submit">登录</button>
					<button class="btn btn-danger" type="button" onclick="window.location.href='register'" >注册</button>
				</form>
			</div>
		</div>

		<div class="bs-docs-example">
			<div id="myCarousel" class="carousel slide">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<img src="<?php echo asset_url();?>img/bootstrap-mdo-sfmoma-01.jpg" alt="">
						<div class="carousel-caption">
							<h4>时间是最公平的</h4>
							<p></p>
						</div>
					</div>
					<div class="item">
						<img src="<?php echo asset_url();?>img/bootstrap-mdo-sfmoma-02.jpg" alt="">
						<div class="carousel-caption">
							<h4>时间产生的价值却迥然不同</h4>
							<p></p>
						</div>
					</div>
					<div class="item">
						<img src="<?php echo asset_url();?>img/bootstrap-mdo-sfmoma-03.jpg" alt="">
						<div class="carousel-caption">
							<h4>我们希望借助我们的工具，让您在公平的时间面前，创造更大的价值</h4>
							<p></p>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>

		<hr>

		<footer>
		<p class="text-center">&copy; Peusto Co. Ltd 2013</p>
		</footer>

		<script src="<?php echo asset_url();?>/js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo asset_url();?>/js/bootstrap.js"></script>
	</body>
</html>