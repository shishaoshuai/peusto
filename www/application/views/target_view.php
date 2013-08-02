
				
				<div class="span6">
				
					<form class="form-horizontal">
						<fieldset>
						<legend>目标管理</legend>
						<div class="control-group">
							<label class="control-label" for="targetName">目标名称</label>
							<div class="controls">
								<input type="text" id="targetName" placeholder="请输入目标名称" />
								<span class="help-inline">目标要简明扼要，不超过30个汉字</span>
							</div> 
						</div>						 
						<div class="control-group">
							<label class="control-label" for="interestArea">所隶属的关注域</label>
							<div class="controls">
                                <select  id="interest_area" name="interest_area">
                                    <?php
                                    foreach($interest_area_list as $interest_area_item)
                                        echo "<option value='". $interest_area_item['idinterest_area'] ."'>". $interest_area_item['interest_area_name'] ."</option>";
                                    ?>
                                </select>
								<span class="help-inline">请输入该任务所属的关注域</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="priority">优先级</label>
							<div class="controls">
								<select id="priority">
								  <option>高</option>
								  <option>中</option>
								  <option>低</option>
								</select>
								<span class="help-inline">优先级高的将显示在前面</span>
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

