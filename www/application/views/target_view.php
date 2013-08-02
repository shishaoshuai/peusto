
				
				<div class="span6">
                    <?php
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open('target/create', $attributes);
                    ?>
						<fieldset>
						<legend>Ŀ�����</legend>
						<div class="control-group">
							<label class="control-label" for="target_name">Ŀ������</label>
							<div class="controls">
								<input type="text" id="target_name" name="target_name" placeholder="������Ŀ������" />
								<span class="help-inline">Ŀ��Ҫ������Ҫ��������30������</span>
							</div> 
						</div>						 
						<div class="control-group">
							<label class="control-label" for="interest_area">�������Ĺ�ע��</label>
							<div class="controls">
                                <select  id="interest_area" name="interest_area">
                                    <?php
                                    foreach($interest_area_list as $interest_area_item)
                                        echo "<option value='". $interest_area_item['iduser_interest_area'] ."'>". $interest_area_item['user_interest_area_name'] ."</option>";
                                    ?>
                                </select>
								<span class="help-inline">����������������Ĺ�ע��</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="priority">���ȼ�</label>
							<div class="controls">
								<select id="priority" name="priority">
								  <option value="1">��</option>
								  <option value="2">��</option>
								  <option value="3">��</option>
								</select>
								<span class="help-inline">���ȼ��ߵĽ���ʾ��ǰ��</span>
							</div>
						</div>
						<div class="control-group">
							<div class="controls" text-align="center">
								<button type="submit" class="btn btn-primary">����</button>
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
								<th>��ע��</th>
								<th>���ȼ�</th>
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
                                </tr>
                            <?php endforeach ?>
						  </tbody>
					</table>
				</div>
				
			</div>
		</div>

