<!DOCTYPE html>
<html>
	<head>
		<title>时间管理->注册</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="<?php echo asset_url();?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<script src="<?php echo asset_url();?>/js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo asset_url();?>/js/bootstrap.js"></script>
		<script Charset="UTF-8" src="<?php echo asset_url();?>/js/jqBootstrapValidation.js"></script>
		<script>
			$(function () 
				{ 
					$("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
				} 
			);
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<ul class="nav">
					<li class="active"><a href="#">首页</a></li>
					<li><a href="#">帮助</a></li>
					<li><a href="#">关于</a></li>
				</ul>

				<form class="navbar-form pull-right" action="home.html">
					<input class="input-large" type="text" placeholder="用户名/电子邮件/手机">
					<input class="input-small" type="password" placeholder="密码">
					<button class="btn btn-primary" type="submit" >登录</button>
				</form>
			</div>
		</div>
		<div class="container">
			<h4>用户注册信息</h4>
            <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('user/create',$attributes);
            ?>

			<div class="control-group">
				<label class="control-label" for="username">用&nbsp;户&nbsp;名</label>
				<div class="controls">
					<input type="text" id="username" name="username" minlength="3" placeholder="请输入用户名" required>
					<span class="help-inline">请选择您经常使用的用户名</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="email">电子邮件</label>
				<div class="controls">
					<input type="email" id="email" name="email" placeholder="请输入您常用的电子邮件地址" required>
					<span class="help-inline">请输入您常用的电子邮件地址</span>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="password" required>密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
				<div class="controls">
					<input type="password" id="password" name="password" minlength="6" placeholder="请输入密码" required>
					<span class="help-inline">密码应大于6位，包含字母、数字、特殊符号的组合</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password_again">密码确认</label>
				<div class="controls">
					<input type="password" id="password_again"
						data-validation-match-match="password" name="password_again"
						data-validation-match-message="与密码不一致"
						placeholder="请确认您的密码">
					<span class="help-inline">密码应大于6位，包含字母、数字、特殊符号的组合</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="mobile">手&nbsp;&nbsp;&nbsp;&nbsp;机</label>
				<div class="controls">
					<input type="text" id="mobile" name="mobile" placeholder="请输入您的手机号">
					<span class="help-inline">请输入您的手机号</span>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox">
					<input type="checkbox"> 我已阅读并同意<a href="#">相关条款</a>
					</label>
					<button type="submit" class="btn btn-primary">注册</button>
				</div>
			</div>
			</form>
			<hr>
			<footer>
				<p class="text-center">&copy; Tris Co. Ltd 2013</p>
			</footer>
		</div>
	</body>
</html>