<!DOCTYPE html>
<html>
	<head>
		<title>Peustoʱ�������</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Peusto�Ǹ��˹����ߵ��ṩ�̣�ּ��ͨ����Щ���ߣ���߸��˹���Ч�ʣ����ʱ�����ʱ��滮��ʱ�����õ�������">
		<meta name="author" content="Peusto">
		<meta name="keywords" content="���˹���,ʱ�����,ʱ�����,ʱ��滮">
		<meta name="robots" content="index,follow">
		<!-- Bootstrap -->
		<link href="<?php echo asset_url();?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo asset_url();?>/css/docs.css" rel="stylesheet" media="screen">
	</head>
	<body onload="document.forms[0].elements[0].focus()">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<ul class="nav">
					<li class="active"><a href="#">��ҳ</a></li>
					<li><a href="#">����</a></li>
					<li><a href="#">����</a></li>
				</ul>
                <?php
                    $attributes = array('class' => 'navbar-form pull-right');
                    echo form_open('user/login',$attributes);
                ?>
					�û�����<input class="input-large" name="name" type="text" placeholder="�û���/�����ʼ�/�ֻ���">
					<input class="input-small" name="password" type="password" placeholder="����">
					<button class="btn btn-primary" type="submit">��¼</button>
					<button class="btn btn-danger" type="button" onclick="window.location.href='register'" >ע��</button>
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
							<h4>ʱ�����ƽ��</h4>
							<p></p>
						</div>
					</div>
					<div class="item">
						<img src="<?php echo asset_url();?>img/bootstrap-mdo-sfmoma-02.jpg" alt="">
						<div class="carousel-caption">
							<h4>ʱ������ļ�ֵȴ��Ȼ��ͬ</h4>
							<p></p>
						</div>
					</div>
					<div class="item">
						<img src="<?php echo asset_url();?>img/bootstrap-mdo-sfmoma-03.jpg" alt="">
						<div class="carousel-caption">
							<h4>����ϣ���������ǵĹ��ߣ������ڹ�ƽ��ʱ����ǰ���������ļ�ֵ</h4>
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