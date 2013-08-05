<!DOCTYPE html>
<html>
	<head>
		<title>***的管理首页</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/datetimepicker.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="css/jquery-ui/jquery.ui.all.css">
		
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/jquery.ui.core.js"></script>
		<script src="js/jquery.ui.widget.js"></script>
		<script src="js/jquery.ui.tabs.js"></script>
		
		<script>
			$(function() {
				$( "#tabs" ).tabs();
			});
		</script>
		
		<script language=javascript>
			function addRow() {
				if(document.all.startTime.value == "" ){ 
					alert("请先输入开始时间！");
				} else{
					var day = "星期九"; 
					var startTime = document.getElementById("startTime");
					var endTime = document.getElementById("endTime");
					var table1 = document.getElementById("table1");
					var mytr=table1.insertRow(-1);
					var mytd=mytr.insertCell();
					
					mytd.innerHTML="<i class=\"icon-remove\" title = \"删除\" onclick=\"javaScript:document.all.table1.deleteRow(event.srcElement.parentElement.parentElement.rowIndex);\">";
					mytd=mytr.insertCell();
					mytd.innerText=endTime.value;
					mytd=mytr.insertCell();
					mytd.innerText=startTime.value;
					mytd=mytr.insertCell();
					mytd.innerText=day;
					mytd=mytr.insertCell();
					mytd.innerText=table1.rows.length-1;
				}
			}
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
					<li><a href="#">师少帅正在使用Peusto</a></li>
					<li><a href="index.html">退出</a></li>
					<li><a href="#">修改密码</a></li>
				</ul>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">			
				<div class="span2">
					<!--Sidebar content-->
					<ul class="nav nav-pills nav-stacked">
						<li><a href="home.html">待办任务</a></li>
						<li><a href="targetMgmt.html">目标管理</a></li>
						<li><a href="interestAreaMgmt.html">关注域管理</a></li>
						<li><a href="timeRecord.html">时间使用情况记录</a></li>
						<li class="active"><a href="preferences.html">个人偏好设置</a></li>
					</ul>
				</div>				
				<div class="span10">
					<div id="tabs">
						<ul>
							<li><a href="#tabs-1">高效工作时间</a></li>
							<li><a href="#tabs-2">每天固定安排</a></li>
							<li><a href="#tabs-3">每周固定安排</a></li>
						</ul>
						<div id="tabs-1">							
							<table class="table table-hover" id="table1">
								<thead>
									<tr>
										<th>#</th>
										<th>星期</th>
										<th>开始时间</th>
										<th>截止时间</th>
										<th>操作</th>
									</tr>
								</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>制作用户首页</td>
											<td>个人事业</td>
											<td>6小时后</td>
											<td></td>
										</tr>
										<tr>
											<td>2</td>
											<td>制作维护关注域页面</td>
											<td>个人事业</td>
											<td>10小时</td>
											<td></td>
										</tr>
										<tr>
											<td>3</td>
											<td>制作目标管理维护页面</td>
											<td>个人事业</td>
											<td>16小时</td>
											<td></td>
										</tr>
								  </tbody>
							</table>
						
						<form id="form1" method="post">
							<div class="control-group">
								<div class="controls">
									&nbsp;从<input class="input-mini" type="text" id="startTime" placeholder="开始时间">
									到<input class="input-mini" type="text" id="endTime" placeholder="结束时间">
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1" checked> 星期一
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 星期二
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox3" value="option3" checked> 星期三
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox4" value="option1" checked> 星期四
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox5" value="option2" checked> 星期五
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox6" value="option3"> 星期六
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox7" value="option3"> 星期日
									</label>
									&nbsp;&nbsp;
									
									<button class="btn btn-small btn-primary" type="button" onclick="javaScript:addRow();">新增</button>
								</div>
							</div>
						</form>
						</div>
						
						<div id="tabs-2">
							<form id="form2" method="post">
							<div class="controls">每天
								<input class="input-mini" type="startTime" placeholder="开始时间">&nbsp;到&nbsp;
								<input class="input-mini" type="endTime" placeholder="结束时间">
								<input class="input-large" type="action" placeholder="请输入固定任务">
								<select class="span2" placeholder="关注域">
								  <option>家庭</option>
								  <option>工作</option>
								  <option>个人健康</option>
								  <option>个人事业</option>
								  <option>娱乐</option>
								</select>
								<select class="span2" placeholder="所对应目标">
									<option>无</option>
									<option>建设时间管理网站</option>
									<option>坚持每周锻炼两次</option>
									<option>管理分析类数据标准落地</option>
									<option>行业主题挖掘分析</option>
								</select>
								&nbsp;&nbsp;
								<button class="btn btn-small btn-primary" type="button">删除</button>
								<button class="btn btn-small btn-primary" type="button">增加</button>
							</div>
							</form>
						</div>
						<div id="tabs-3">
							<form id="form3" method="post">
							<div class="control-group">
							<label class="control-label" for="dtp_input1"></label>					
								<div class="controls">每周&nbsp;
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1" checked> 星期一
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 星期二
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox3" value="option3" checked> 星期三
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox1" value="option1" checked> 星期四
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 星期五
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox3" value="option3"> 星期六
									</label>
									<label class="checkbox inline">
									  <input type="checkbox" id="inlineCheckbox3" value="option3"> 星期日
									</label>
									<br/>
									&nbsp;从&nbsp;<input class="input-mini" type="startTime" placeholder="开始时间">&nbsp;到&nbsp;
									<input class="input-mini" type="endTime" placeholder="结束时间">
									<input class="input-large" type="action" placeholder="请输入固定任务">
									<select class="span2" placeholder="关注域">
									  <option>家庭</option>
									  <option>工作</option>
									  <option>个人健康</option>
									  <option>个人事业</option>
									  <option>娱乐</option>
									</select>
									<select class="span2" placeholder="所对应目标">
										<option>无</option>
										<option>建设时间管理网站</option>
										<option>坚持每周锻炼两次</option>
										<option>管理分析类数据标准落地</option>
										<option>行业主题挖掘分析</option>
									</select>
									
									&nbsp;&nbsp;
									<button class="btn btn-small btn-primary" type="button">删除</button>
									<button class="btn btn-small btn-primary" type="button">增加</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>							
			</div>
		</div>

		<footer>
			<p class="text-center">&copy; Peusto Co. Ltd 2013</p>
		</footer>
		
		<script src="js/bootstrap.js"></script>
		<script Charset="UTF-8" src="js/jqBootstrapValidation.js"></script>
		<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
		<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
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