
				
				<div class="span6">
				
					<form class="form-horizontal">
						<fieldset>
						<legend>关注域管理</legend>
						<div class="control-group">
							<label class="control-label" for="name">关注域名称</label>
							<div class="controls">
								<input type="text" id="name" placeholder="请输入关注域名称" required />
								<span class="help-inline">关注域要简明扼要，不超过10个汉字</span>
							</div> 
						</div>						 
						
						<div class="control-group">
							<label class="control-label" for="display_order">显示顺序</label>
							<div class="controls">
                                <input type="text" id="display_order" placeholder="只能输入正整数"
                                    data-validation-regex-regex="^[0-9]*[1-9][0-9]*$"
                                    data-validation-regex-message="只能输入正整数  "
                                />
								<span class="help-inline">数字小的显示在前面</span>
							</div>
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
								<th>关注域</th>
								<th>父关注域</th>
							</tr>
						</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>个人事业</td>
									<td>无</td>
								</tr>
								<tr>
									<td>2</td>
									<td>工作</td>
									<td>无</td>
								</tr>
								<tr>
									<td>3</td>
									<td>个人健康</td>
									<td>无</td>
								</tr>
								<tr>
									<td>4</td>
									<td>家庭</td>
									<td>无</td>
								</tr>
								<tr>
									<td>5</td>
									<td>娱乐</td>
									<td>无</td>
								</tr>
						  </tbody>
					</table>
				</div>
				
			</div>
		</div>
