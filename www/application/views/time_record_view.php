<script>
    var title="";
    var startTime ="";
    var endTime="";
    var allDayTime="";
    var calendar;

    $(document).ready(function () {
        $("#interest_area").jCombo("http://localhost/get_user_interest_areas", { selected_value : '<?php echo "15" ?>' } );
        $("#target").jCombo("http://localhost/get_targets/", { parent: "#interest_area" } );

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();



        calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            editable: true,

            select: function (start, end, allDay) {
                startTime =start;
                endTime=end;
                allDayTime=allDay;
                $('#task_modal').modal('show');
            },
            events: [
            ]
        });

    });

    function closeDialog () {
        $('#task_modal').modal('hide');
    }
    function saveTask () {
        title = document.getElementById('task_name').value
        closeDialog ();
        calendar.fullCalendar('renderEvent',
            {
                title: title,
                start: startTime,
                end: endTime,
                allDay: allDayTime
            },
            true
        );
        calendar.fullCalendar('unselect');
        title="";
    }

</script>


<div class="span10" id='calendar'>

    <div class="modal hide fade" id="task_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                &times;
            </button>
            <h3>
                请输入任务详情
            </h3>
        </div>
        <?php
        $attributes = array('class' => 'form-horizontal');
        echo form_open('home/create', $attributes);
        ?>
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label" for="task_name">任务名称</label>

                <div class="controls">
                    <input type="text" class="input-block-level" id="task_name" name="task_name"
                           placeholder="请输入待完成的任务，要简明、清晰，不超过100个汉字"
                           required>
                    <span class="help-inline">我们通常会将一个目标分解为多个任务，通常，任务分解应尽可能细化，任务通常在5分钟到2个小时内可完成。</span>
                </div>
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

        </div>
        <div class="modal-footer">
            <a href="#" class="btn" onclick="closeDialog();">
                关闭
            </a>
            <a href="#" class="btn btn-primary" onclick="saveTask();">
                保存
            </a>
        </div>
        </form>
    </div>
</div>
</div>
</div>




