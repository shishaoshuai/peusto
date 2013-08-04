<div class="span6">
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open('home/create', $attributes);
    ?>
    <script type="text/javascript">
        $(function() {
             $("#interest_area").jCombo("http://localhost/get_user_interest_areas", { selected_value : '<?php echo "15" ?>' } );
             $("#target").jCombo("http://localhost/get_targets/", { parent: "#interest_area" } );
        });
    </script>
    <fieldset>
        <legend>任务管理</legend>
        <div class="control-group">
            <label class="control-label" for="task_name">任务名称</label>

            <div class="controls">
                <input type="text" class="input-block-level" id="task_name" name="task_name"
                       placeholder="请输入待完成的任务，要简明、清晰，不超过100个汉字"
                       required></input>
                <span class="help-inline">我们通常会将一个目标分解为多个任务，通常，任务分解应尽可能细化，任务通常在5分钟到2个小时内可完成。</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="start_time">
                开始时间
            </label>

            <div class="controls date start_time" align="left" data-date-format="yyyy年MMdd日 - hh:ii"
                 data-link-field="start_time">
                <input size="12" type="text" value="" readonly>
                <span class="add-on"><i class="icon-remove"></i></span>
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
            <input type="hidden" id="start_time" name="start_time" value=""/>
        </div>
        <div class="control-group">
            <label class="control-label" for="expected_duration">预计耗时</label>

            <div class="controls">
                <input id="duration_hour" name="duration_hour" class="input-oneword" name="value" value="0">小时
                <input id="duration_minute" name="duration_minute" class="input-oneword" name="value" value="30">分钟
                <span class="help-inline">本任务预计花费的时间</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="due_time">完成时间</label>

            <div class="controls date due_time" align="left" data-date-format="yyyy年MMdd日 - hh:ii"
                 data-link-field="due_time">
                <input size="12" type="text" value="" readonly>
                <span class="add-on"><i class="icon-remove"></i></span>
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
            <input type="hidden" id="due_time" name="due_time" value=""/>
        </div>

        <div class="control-group">
            <label class="control-label" for="target">所属关注域</label>

            <div class="controls">
                <select id="interest_area" name="interest_area">

                </select>
                <span class="help-inline">请输入该任务所属的关注域</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="target">所属目标</label>

            <div class="controls">
                <select id="target" name="target">

                </select>
                <span class="help-inline">请输入该任务所属的目标</span>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label" for="is_appointment">定时任务</label>

            <div class="controls">
                <input type="checkbox" name="is_appointment" value="1"/>
                <span class="help-inline">定时任务一般指约定的会议，预约的安排等</span>
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
    <?php
    while(list($key, $task_group) =each($tasks)) {
        ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th colspan="3"><?php echo $key ?></th>

            </tr>
            </thead>
            <tbody>
            <?php
            $i =0;
            foreach ($task_group as $task_item):
                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $task_item['task_name'] ?></td>
                    <td><?php echo $task_item['target_name'] ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php } ?>
</div>

</div>
</div>
