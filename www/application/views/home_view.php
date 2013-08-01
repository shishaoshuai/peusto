
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
