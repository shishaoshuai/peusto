<script type="text/javascript">
    $(function() {
        $("#interest_area").jCombo("http://localhost/get_user_interest_areas", { selected_value : '<?php echo isset( $target_tbm)? $target_tbm['interest_area']:'' ?>' } );
        $("#target_type").jCombo("http://localhost/get_target_types", { selected_value : '<?php echo isset( $target_tbm)? $target_tbm['target_type']:'' ?>' } );
        $('select[name=target_type]').change(function() {
            if($(this).val()=='2')            $('#week_memo').show();

        });

    });
</script>

				<div class="span5">
                    <?php
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open($action_name, $attributes);
                    ?>
						<fieldset>
						<legend>目标管理</legend>
                            <input type="hidden" name="idtarget" value="<?php echo isset( $target_tbm)? $target_tbm['idtarget']:'' ?>" />

                            <div class="control-group">
							<label class="control-label" for="target_name">目标名称</label>
							<div class="controls">
								<input type="text" id="target_name" name="target_name"
                                       value="<?php echo isset( $target_tbm)? $target_tbm['target_name']:'' ?>"
                                       placeholder="请输入目标名称" />
								<span class="help-inline"></span>
							</div> 
						</div>						 
						<div class="control-group">
							<label class="control-label" for="interest_area">所隶属的关注域</label>
							<div class="controls">
                                <select  id="interest_area" name="interest_area">
                                </select>
								<span class="help-inline">请输入该任务所属的关注域</span>
							</div>
						</div>
                            <div class="control-group">
                                <label class="control-label" for="target_type">目标类型</label>
                                <div class="controls">
                                    <select  id="target_type" name="target_type">
                                    </select>
                                    <span class="help-inline">请输入该任务所属的关注域</span>
                                </div>
                            </div>
                            <div class="control-group" id="week_memo" style="display: none">
                                <label class="control-label" for="target_type">目标类型</label>
                                <div class="controls">
                                    <select  id="gg" name="gg">
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
								<button type="submit" class="btn btn-primary">保存</button>
							</div>
						</div>
						</fieldset>
					</form>
				</div>
				
				<div class="span5">
				<?php
                    while(list($key, $target_group) =each($targets)) {
                ?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th colspan="6"><?php echo $key ?></th>

							</tr>
						</thead>
							<tbody>
                            <?php
                            $i =0;
                            foreach ($target_group as $target_item):
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $target_item['target_name'] ?></td>
                                    <td><?php echo $target_item['priority'] ?>优先级</td>
                                    <td><?php echo $target_item['target_type_name'] ?></td>
                                    <td>
                                        <a href="<?php echo site_url('target/modify/'.$target_item['idtarget']) ?>">更新</a>
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('target/delete/'.$target_item['idtarget']) ?>">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
						  </tbody>
					</table>
                <?php } ?>
				</div>
				
			</div>
		</div>

