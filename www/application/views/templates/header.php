<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $name; ?>的管理首页</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="<?php echo asset_url();?>/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="<?php echo asset_url();?>/css/datetimepicker.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="<?php echo asset_url();?>/css/jquery-ui/jquery.ui.all.css">


		<script src="<?php echo asset_url();?>/js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo asset_url();?>/js/bootstrap.js"></script>
		<script src="<?php echo asset_url();?>/js/jqBootstrapValidation.js"></script>
		<script src="<?php echo asset_url();?>/js/jquery.ui.core.js"></script>
		<script src="<?php echo asset_url();?>/js/jquery.ui.widget.js"></script>
		<script src="<?php echo asset_url();?>/js/jquery.ui.tabs.js"></script>
		<script src="<?php echo asset_url();?>/js/jquery.mousewheel.js"></script>
		<script src="<?php echo asset_url();?>/js/jquery.ui.button.js"></script>
		<script src="<?php echo asset_url();?>/js/jquery.ui.spinner.js"></script>
		<script>
			$(function() {
				var spinner_hour = $( "#duration_hour" ).spinner({
					min: 0,
					max: 500,
					step: 1,
					start: 0
				});
				var spinner_minute = $( "#duration_minute" ).spinner({
					min: 0,
					max: 60,
					step: 5,
					start: 0
				});
				 $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
			});
		</script>

        <script type="text/javascript" src="<?php echo asset_url();?>/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo asset_url();?>/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
        <script type="text/javascript">
            $('.form_finishTime').datetimepicker({
                language:  'zh-CN',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });


            $('.form_appointTime').datetimepicker({
                language:  'zh-CN',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 1
            });
        </script>
	</head>
	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<ul class="nav">
					<li class="active"><a href="home.html">首页</a></li>
					<li><a href="#">帮助</a></li>
					<li><a href="#">关于</a></li>
				</ul>
				<ul class="nav nav-pills pull-right">
					<li><a href="#"><?php echo $name; ?>正在使用Peusto</a></li>
					<li><a href="home/logout">退出</a></li>
					<li><a href="#">修改密码</a></li>
				</ul>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">
			
				<div class="span2">
				<!--Sidebar content-->
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="home">待办任务</a></li>
					<li><a href="target">目标管理</a></li>
					<li><a href="interest_area">关注域管理</a></li>
					<li><a href="time_record">时间使用情况记录</a></li>
					<li><a href="user_preferences">个人偏好设置</a></li>
				</ul>
				</div>
