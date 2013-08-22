<script type="text/javascript">

        $(function() {
            $("#lft").jCombo("http://localhost/get_hierachy_targets" );
            $('.due_time').datetimepicker({
                language:  'zh-CN',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                minView:'month',
                showMeridian:false
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
        <input type="hidden" name="idtarget" value="<?php echo isset($target_tbm) ? $target_tbm['idtarget'] : '' ?>"/>

        <div class="control-group">
            <label class="control-label" for="target_name">目标名称</label>

            <div class="controls">
                <input class="span12" type="text" id="target_name" name="target_name"
                       value="<?php echo isset($target_tbm) ? $target_tbm['target_name'] : '' ?>"
                       placeholder="请输入目标名称"/>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="target_type">上一级目标</label>

            <div class="controls">
                <select id="lft" name="lft">

                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="due_time">完成时间</label>

            <div class="controls date due_time" align="left" data-date-format="yyyy年MMdd日"
                 data-link-field="due_time">
                <input size="12" type="text" value="" placeholder="请选择任务开始时间" readonly>
                <span class="add-on"><i class="icon-remove"></i></span>
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
            <input type="hidden" id="due_time" name="due_time" value=""/>
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
    while (list($key, $target_group) = each($targets)) {
        ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="6"><?php echo $key ?></th>

            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($target_group as $target_item):
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $target_item['target_name'] ?></td>
                    <td><?php echo $target_item['priority'] ?>优先级</td>
                    <td><?php echo $target_item['target_type_name'] ?></td>
                    <td>
                        <a href="<?php echo site_url('target/modify/' . $target_item['idtarget']) ?>">更新</a>
                    </td>
                    <td>
                        <a href="<?php echo site_url('target/delete/' . $target_item['idtarget']) ?>">删除</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php } ?>
</div>

</div>
</div>

