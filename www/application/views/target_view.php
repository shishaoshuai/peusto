
				
				<div class="span6">
				
					<form class="form-horizontal">
						<fieldset>
						<legend>Ŀ�����</legend>
						<div class="control-group">
							<label class="control-label" for="targetName">Ŀ������</label>
							<div class="controls">
								<input type="text" id="targetName" placeholder="������Ŀ������" />
								<span class="help-inline">Ŀ��Ҫ������Ҫ��������30������</span>
							</div> 
						</div>						 
						<div class="control-group">
							<label class="control-label" for="interestArea">�������Ĺ�ע��</label>
							<div class="controls">
                                <select  id="interest_area" name="interest_area">
                                    <?php
                                    foreach($interest_area_list as $interest_area_item)
                                        echo "<option value='". $interest_area_item['idinterest_area'] ."'>". $interest_area_item['interest_area_name'] ."</option>";
                                    ?>
                                </select>
								<span class="help-inline">����������������Ĺ�ע��</span>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="priority">���ȼ�</label>
							<div class="controls">
								<select id="priority">
								  <option>��</option>
								  <option>��</option>
								  <option>��</option>
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
								<th>����ע��</th>
							</tr>
						</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>������ҵ</td>
									<td>��</td>
								</tr>
								<tr>
									<td>2</td>
									<td>����</td>
									<td>��</td>
								</tr>
								<tr>
									<td>3</td>
									<td>���˽���</td>
									<td>��</td>
								</tr>
								<tr>
									<td>4</td>
									<td>��ͥ</td>
									<td>��</td>
								</tr>
								<tr>
									<td>5</td>
									<td>����</td>
									<td>��</td>
								</tr>
						  </tbody>
					</table>
				</div>
				
			</div>
		</div>

