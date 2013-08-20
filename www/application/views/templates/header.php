<!DOCTYPE html>
<html>
<head>
    <Meta http-equiv="Content-Type" Content="text/html; Charset=utf-8">

    <title><?php echo $username; ?>的管理首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='<?php echo asset_url() ?>css/fullcalendar.print.css' rel='stylesheet' media='print'/>
    <?php
    echo put_headers();
    ?>

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <ul class="nav">
            <li class="active"><a href="<?php echo site_url('home') ?>">首页</a></li>
            <li><a href="#">帮助</a></li>
            <li><a href="#">关于</a></li>
        </ul>
        <ul class="nav nav-pills pull-right">
            <li><a href="#">欢迎<?php echo $username; ?></a></li>
            <li><a href="<?php echo site_url('logout') ?>">退出</a></li>
            <li><a href="#">修改密码</a></li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="span2 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                <li <?php echo $active_nav_item == 'home' ? "class=\"active\"" : ""; ?>><a
                        href="<?php echo site_url('home') ?>">首页</a></li>
                <li <?php echo $active_nav_item == 'todo' ? "class=\"active\"" : ""; ?>><a
                        href="<?php echo site_url('todo') ?>">待办任务</a></li>
                <li <?php echo $active_nav_item == 'target' ? "class=\"active\"" : ""; ?>><a
                        href="<?php echo site_url('target') ?>">目标管理</a></li>
                <li <?php echo $active_nav_item == 'interest_area' ? "class=\"active\"" : ""; ?>><a
                        href="<?php echo site_url('interest_area') ?>">关注域管理</a></li>
                <li <?php echo $active_nav_item == 'time_record' ? "class=\"active\"" : ""; ?>><a
                        href="<?php echo site_url('time_record') ?>">时间使用情况记录</a></li>
                <li <?php echo $active_nav_item == 'user_preferences' ? "class=\"active\"" : ""; ?>><a
                        href="<?php echo site_url('user_preferences') ?>">个人偏好设置</a></li>
            </ul>
        </div>
