<script>
    var title = "";
    var startTime = "";
    var endTime = "";
    var allDayTime = "";
    var calendar;

    $(document).ready(function () {


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
            defaultView: 'agendaWeek',
            selectable: true,
            selectHelper: true,
            editable: true,
            resizable: true,
            theme:true,
            minTime:5,
            maxTime:23,
            slotMinutes:30,
            snapMinutes:5,

                select: function (start, end, allDay) {
                startTime = start;
                endTime = end;
                allDayTime = allDay;
                $("#interest_area").jCombo("http://localhost/get_user_interest_areas", { selected_value: '<?php echo "15" ?>' });
                $("#target").jCombo("http://localhost/get_targets/", { parent: "#interest_area" });
                $('#todo_modal').modal('show');
            },
            events: [<?php echo $fc_events; ?>
            ],
            eventClick: function (calEvent, jsEvent, view) {
                if(document.getElementById('idtodo') != null) {
                    alert('id' + calEvent.id);

                    document.getElementById('idtodo').value = calEvent.id;

                    document.getElementById('todo_name').value = calEvent.title;
                    document.getElementById('interest_area').value = calEvent.interest_area;
                    document.getElementById('target').value = calEvent.target;
                    document.getElementById('is_appointment').value = calEvent.is_appointment;
                    document.getElementById('todo_name').value = calEvent.title;
                    document.getElementById('start_time').value = calEvent.start;
                    document.getElementById('due_time').value = calEvent.end;

                }
                $("#interest_area").jCombo("http://localhost/get_user_interest_areas", { selected_value: calEvent.interest_area });
                $("#target").jCombo("http://localhost/get_targets/", { parent: "#interest_area", selected_value: calEvent.target });
                $('#todo_modal').modal('show');
            },
            eventDrop: function (event, dayDelta, minuteDelta) {
                var tmpStart = event.start.valueOf() / 1000;
                var tmpDue = event.end.valueOf() / 1000;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>move_todo_in_calendar",
                    data: {id: (event.id), new_start_time: tmpStart, new_due_time: tmpDue},
                    success: function (data) {
                    }
                });
            },
            eventResize: function (event) {
                var tmpStart = event.start.valueOf() / 1000;
                var tmpDue = event.end.valueOf() / 1000;
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>move_todo_in_calendar",
                    data: {id: (event.id), new_start_time: tmpStart, new_due_time: tmpDue},
                    success: function (data) {
                    }
                });
            }
        });

    });

    function closeDialog(dialogName) {
        $("#" + dialogName + "").modal('hide');
    }
    function saveTask() {

        title = document.getElementById('todo_name').value;
        startTime = document.getElementById('start_time') != null ?document.getElementById('start_time').value:startTime;
        endTime = document.getElementById('due_time') != null ?document.getElementById('due_time').value:endTime;

        var todoId = document.getElementById('idtodo') != null ?document.getElementById('idtodo').value:"";
        var isa = document.getElementById('is_appointment').value;
        var ia = document.getElementById('interest_area').value;
        var ta = document.getElementById('target').value;
        var st = startTime.valueOf() / 1000;
        var dt = endTime.valueOf() / 1000;

        var updateFlag = document.getElementById('idtodo') != null ?true:false;
        alert('value'+todoId +' ' + title + +' ' + isa +' '+ ia +' '+ta);
        if (todoId == "") {
            alert('creating...');

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>create_todo_from_calendar",
                data: {todo_name: title, start_time: st, due_time: dt, is_appointment: isa, target: ta, interest_area: ia},
                dataType: 'json',
                success: function (data, status) {
                    todoId = data.id;
                }
            });
        } else {
            alert('modifying...');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>modify_todo_from_calendar",
                data: {id:todoId, todo_name: title, is_appointment: isa, target: ta, interest_area: ia},
                dataType: 'json',
                success: function (data, status) {
                    alert('modify success.');
                }
            });
        }
        closeDialog('todo_modal');
        if(updateFlag) {
            calendar.fullCalendar( 'removeEvents',todoId);
            calendar.fullCalendar('renderEvent',
                {
                    id: todoId,
                    title: title,
                    start: startTime,
                    end: endTime,
                    allDay: allDayTime
                },
                true
            );
        } else {
            calendar.fullCalendar('renderEvent',
                {
                    id: todoId,
                    title: title,
                    start: startTime,
                    end: endTime,
                    allDay: allDayTime
                },
                true
            );
        }

        calendar.fullCalendar('unselect');
    }

</script>


<div class="span10" id='calendar'>
</div>
</div>
</div>

<div class="modal hide fade" id="todo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            &times;
        </button>
        <h3>
            请对该任务进行操作:
        </h3>
    </div>

    <div class="modal-body">
        <div class="control-group">
            <label class="control-label" for="todo_name">任务名称</label>

            <div class="controls">
                <input type="text" class="input-block-level" id="todo_name" name="todo_name"
                       placeholder="请输入待完成的任务，要简明、清晰，不超过100个汉字"
                       required>
                <span class="help-inline">我们通常会将一个目标分解为多个任务，通常，任务分解应尽可能细化，任务通常在5分钟到2个小时内可完成。</span>
            </div>
        </div>
        <input type="hidden" id="idtodo" name="idtodo">
        <input type="hidden" id="start_time" name="start_time">
        <input type="hidden" id="due_time" name="due_time">

        <div class="control-group">
            <label class="control-label" for="interest_area">所属关注域</label>

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
                <input type="checkbox" name="is_appointment" id="is_appointment" value="1"/>
                <span class="help-inline">定时任务一般指约定的会议，预约的安排等</span>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn" onclick="closeDialog('todo_modal');">
            关闭
        </a>
        <a href="#" class="btn btn-primary" onclick="saveTask();">
            保存
        </a>
    </div>
</div>



