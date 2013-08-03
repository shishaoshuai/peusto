<div class="span6">
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open('task/create', $attributes);
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
            <label class="control-label" for="expected_duration">预计耗时</label>

            <div class="controls">
                <input id="duration_hour" class="input-oneword" name="value" value="0">小时
                <input id="duration_minute" class="input-oneword" name="value" value="30">分钟
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
            <input type="hidden" id="due_time" value=""/>
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
            <label class="control-label" for="start_time">
                开始时间
            </label>

            <div class="controls date start_time" align="left" data-date-format="yyyy年MMdd日 - hh:ii"
                 data-link-field="start_time">
                <input size="12" type="text" value="" readonly>
                <span class="add-on"><i class="icon-remove"></i></span>
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
            <input type="hidden" id="start_time" value=""/>
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
