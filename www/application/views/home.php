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
					<li class="active"><a href="#">待办任务</a></li>
					<li><a href="targetMgmt.html">目标管理</a></li>
					<li><a href="interestAreaMgmt.html">关注域管理</a></li>
					<li><a href="timeRecord.html">时间使用情况记录</a></li>
					<li><a href="preferences.html">个人偏好设置</a></li>
				</ul>
				</div>
				
				<div class="span6">
				
					<form class="form-horizontal">
						<fieldset>
						<legend>任务管理</legend>
						<div class="control-group">
							<label class="control-label" for="task">任务名称</label>
							<div class="controls">
								<input type="text" class="input-block-level" id="task" placeholder="请输入待完成的任务，要简明、清晰，不超过100个汉字" required></input>
								<span class="help-inline">我们通常会将一个目标分解为多个任务，通常，任务分解应尽可能细化，任务通常在5分钟到2个小时内可完成。</span>
							</div> 
						</div>			
						<div class="control-group">
							<label class="control-label" for="duration">预计耗时</label>
							<div class="controls">
								<input id="duration_hour"  class="input-oneword" name="value">小时
								<input id="duration_minute"  class="input-oneword" name="value">分钟
								<span class="help-inline">本任务预计花费的时间</span>
							</div> 
						</div>			
						<div class="control-group">
							<label class="control-label" for="dtp_input1">完成时间</label>
							<div class="controls date form_finishTime"  align="left" data-date-format="yyyy年MMdd日 - hh:ii" data-link-field="dtp_input1">
								<input size="12" type="text" value="" readonly>
								<span class="add-on"><i class="icon-remove"></i></span>
								<span class="add-on"><i class="icon-th"></i></span>
							</div>
							<input type="hidden" id="dtp_input1" value="" />
						</div>						
						<div class="control-group">
							<label class="control-label" for="target">所属目标</label>
							<div class="controls">
								<select>
									<option>无</option>
									<option>建设时间管理网站</option>
									<option>坚持每周锻炼两次</option>
									<option>管理分析类数据标准落地</option>
									<option>行业主题挖掘分析</option>
								</select>
								<span class="help-inline">请输入该任务所属的目标</span>
							</div>
						</div>						
						<div class="control-group">
							<label class="control-label" for="target">所属关注域</label>
							<div class="controls">
								<select>
									<option>无</option>
									<option>生活</option>
									<option>工作</option>
									<option>事业</option>
									<option>个人健康</option>
								</select>
								<span class="help-inline">请输入该任务所属的关注域</span>
							</div>
						</div>			
						<div class="control-group">
							<label class="control-label">
								<input type="checkbox">定时任务</input>
							</label>
							<div class="controls date form_appointTime"  align="left" data-date-format="yyyy年MMdd日 - hh:ii" data-link-field="dtp_input1">
								<input size="12" type="text" value="" readonly>
								<span class="add-on"><i class="icon-remove"></i></span>
								<span class="add-on"><i class="icon-th"></i></span>
							</div>
							<input type="hidden" id="dtp_input2" value="" />
						</div>	

						<div class="control-group">
							<div class="controls" text-align="center">
								<button type="submit" class="btn btn-primary">创建</button>
							</div>
						</div>
						</fieldset>
					</form>
				</div>
				
				<div class="span4">
				
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>任务名称</th>
								<th>关注域</th>
								<th>截止时间</th>

							</tr>
						</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>制作用户首页</td>
									<td>个人事业</td>
									<td>6小时后</td>
								</tr>
								<tr>
									<td>2</td>
									<td>制作维护关注域页面</td>
									<td>个人事业</td>
									<td>10小时</td>
								</tr>
								<tr>
									<td>3</td>
									<td>制作目标管理维护页面</td>
									<td>个人事业</td>
									<td>16小时</td>
								</tr>
						  </tbody>
					</table>
				</div>
				
			</div>
		</div>

		<footer>
			<p class="text-center">&copy; Peusto Co. Ltd 2013</p>
		</footer>


		
		
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
		
	</body>
</html>