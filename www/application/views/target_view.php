
				
				<div class="span6">
                    <?php
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open('target/create', $attributes);
                    ?>
						<fieldset>
						<legend>目标管理</legend>
						<div class="control-group">
							<label class="control-label" for="target_name">目标名称</label>
							<div class="controls">
								<input type="text" id="target_name" name="target_name" placeholder="请输入目标名称" />
								<span class="help-inline">目标要简明扼要，不超过30个汉字</span>
							</div> 
						</div>						 
						<div class="control-group">
							<label class="control-label" for="interest_area">所隶属的关注域</label>
							<div class="controls">
                                <select  id="interest_area" name="interest_area">
                                    <?php
                                    foreach($interest_area_list as $interest_area_item)
                                        echo "<option value='". $interest_area_item['iduser_interest_area'] ."'>". $interest_area_item['user_interest_area_name'] ."</option>";
                                    ?>
                                </select>
								<span class="help-inline">请输入该任务所属的关注域</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="priority">优先级</label>
							<div class="controls">
								<select id="priority" name="priority">
								  <option value="1">高</option>
								  <option value="2">中</option>
								  <option value="3">低</option>
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
								<th>目标</th>
								<th>优先级</th>
							</tr>
						</thead>
							<tbody>
                            <?php
                            $i =0;
                            foreach ($targets as $target_item):
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $target_item['target_name'] ?></td>
                                    <td><?php echo $target_item['priority'] ?></td>
                                </tr>
                            <?php endforeach ?>
						  </tbody>
					</table>
				</div>
				
			</div>
		</div>

