<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $name; ?>�Ĺ�����ҳ</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">


        <?php
        echo put_headers();
        ?>

	</head>
	<body>
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<ul class="nav">
					<li class="active"><a href="home.html">��ҳ</a></li>
					<li><a href="#">����</a></li>
					<li><a href="#">����</a></li>
				</ul>
				<ul class="nav nav-pills pull-right">
					<li><a href="#"><?php echo $name; ?>����ʹ��Peusto</a></li>
					<li><a href="home/logout">�˳�</a></li>
					<li><a href="#">�޸�����</a></li>
				</ul>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">
			
				<div class="span2">
				<!--Sidebar content-->
				<ul class="nav nav-pills nav-stacked">
					<li <?php echo $active_nav_item=='home' ?  "class=\"active\"":""; ?>><a href="home">��������</a></li>
					<li <?php echo $active_nav_item=='target' ?  "class=\"active\"":""; ?>><a href="target">Ŀ�����</a></li>
					<li <?php echo $active_nav_item=='interest_area' ?  "class=\"active\"":""; ?>><a href="interest_area">��ע�����</a></li>
					<li <?php echo $active_nav_item=='time_record' ?  "class=\"active\"":""; ?>><a href="time_record">ʱ��ʹ�������¼</a></li>
					<li <?php echo $active_nav_item=='user_preferences' ?  "class=\"active\"":""; ?>><a href="user_preferences">����ƫ������</a></li>
				</ul>
				</div>
