<!DOCTYPE html>
<html>
<head>
    <title>Peusto时间管理网</title>
    <Meta http-equiv="Content-Type" Content="text/html; Charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Peusto是个人管理工具的提供商，旨在通过这些工具，提高个人管理效率，提高时间管理、时间规划和时间运用的能力。">
    <meta name="author" content="Peusto">
    <meta name="keywords" content="个人管理,时间管理,时间跟踪,时间规划">
    <meta name="robots" content="index,follow">
    <script src="<?php echo asset_url(); ?>/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo asset_url(); ?>/js/bootstrap.js"></script>
    <script src="<?php echo asset_url(); ?>/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo asset_url(); ?>/js/jquery.ui.core.js"></script>
    <script src="<?php echo asset_url(); ?>/js/jquery.ui.widget.js"></script>
    <script src="<?php echo asset_url(); ?>/js/jquery.ui.tabs.js"></script>

    <link href="<?php echo asset_url(); ?>css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo asset_url(); ?>css/jquery-ui/jquery.ui.all.css" rel="stylesheet" media="screen">
    <link href="<?php echo asset_url(); ?>css/index.css" rel="stylesheet" media="screen">

    <script>
        $(function () {
            $("#tabs").tabs();
        });
    </script>
</head>


<body>

<div class="container-fluid">
    <div id="header" class="row-fluid">
        <div class="span2 header_area"><img src="<?php echo asset_url(); ?>img/peusto_logo.gif"/></div>
        <div class="span6 header_area"><img src="<?php echo asset_url(); ?>img/slogan.jpg"/></div>
        <div class="span4 header_area">关于我们</div>
    </div>
    <div class="row-fluid">
        <div class="span7 height350">
            <h3>
                树立长远目标，建立近期目标，细化分解任务，促进效能提升
            </h3>

            <p class="lead">
                　　没有目标的人，是可悲的。<strong>PEUSTO</strong>能够帮你更加有效地管理你的目标，并能帮你更加便捷地将长远
                目标分解为短期目标，进而分解为任务。
            </p>

            <p class="lead">
                　　通过对长期目标->短期目标->任务的分解与跟踪，<strong>PEUSTO</strong>能够帮助你提升效能，
                不但能促进你高效地做事，更能促使你一直在朝着目标做正确的事。
            </p>

            <p class="lead">
                　　<strong>PEUSTO</strong>基于目前最先进的时间管理理论，结合你个人的个性化设置，使你从繁重的
                时间管理琐事中解脱出来，生成日程表，跟踪日程表成为一件极为简单的事情。
            </p>
        </div>
        <div class="span5 height350">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">登录</a></li>
                    <li><a href="#tabs-2">注册新用户</a></li>
                </ul>

                <div id="tabs-1" class="well height250">
                    <?php
                    $attributes = array('accept-charset' => 'UTF-8');
                    echo form_open('user/login', $attributes);
                    ?>
                    <fieldset>
                        <legend>请输入登录用户和密码</legend>
                        <?php echo validation_errors(); ?>
                        <input class="span12" placeholder="用户名/电子邮件/手机号码" type="text" name="username" required="true">
                        <input class="span12" placeholder="密码" type="password" name="password" required="true">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" value="1"> 记住我
                        </label>
                        <button class="btn-info btn" type="submit">登录</button>
                    </fieldset>
                    </form>


                </div>
                <div id="tabs-2" class="well height250">
                    <?php
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open('user/create', $attributes);
                    ?>

                    <div class="control-group">
                        <label class="control-label" for="username">用&nbsp;户&nbsp;名</label>

                        <div class="controls">
                            <input type="text" id="username" name="username" minlength="3" placeholder="请输入用户名"
                                   required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">电子邮件</label>

                        <div class="controls">
                            <input type="email" id="email" name="email" placeholder="请输入您常用的电子邮件地址" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="mobile">手&nbsp;&nbsp;&nbsp;&nbsp;机</label>

                        <div class="controls">
                            <input type="text" id="mobile" name="mobile" placeholder="请输入您的手机号">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="password" required>密&nbsp;&nbsp;&nbsp;&nbsp;码</label>

                        <div class="controls">
                            <input type="password" id="password" name="password" minlength="6" placeholder="请输入密码"
                                   required>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password_again">密码确认</label>

                        <div class="controls">
                            <input type="password" id="password_again"
                                   data-validation-match-match="password" name="password_again"
                                   data-validation-match-message="与密码不一致"
                                   placeholder="请确认您的密码">
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
                </div>
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div class="span4 height160">new articles</div>
        <div class="span4 height160">website news</div>
        <div class="span4 height160">website tutorials</div>
    </div>
</div>

<footer>
    <p class="text-center">&copy; Peusto Co. Ltd 2013</p>
</footer>


</body>
</html>