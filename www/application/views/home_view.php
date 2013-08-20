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

        calendar = $('#dayCalendar').fullCalendar({
            header: false,
//            header: {
//                left: 'prev,next today',
//                center: 'title',
//                right: 'month,agendaWeek,agendaDay'
//            },
            defaultView: 'agendaDay',
            theme:true,
            aspectRatio: 0.15,
            contentHeight:640,
            selectable: true,
            selectHelper: true,
            editable: true,
            resizable: true,
            allDaySlot:false,
            minTime: 5,
            maxTime: 23,
            firstHour:8,
            slotMinutes: 30,
            snapMinutes: 30


        });

    });

    function closeDialog(dialogName) {
        $("#" + dialogName + "").modal('hide');
    }
    function saveTask() {

        title = document.getElementById('todo_name').value;
        startTime = document.getElementById('start_time') != null ? document.getElementById('start_time').value : startTime;
        endTime = document.getElementById('due_time') != null ? document.getElementById('due_time').value : endTime;

        var todoId = document.getElementById('idtodo') != null ? document.getElementById('idtodo').value : "";
        var isa = document.getElementById('is_appointment').value;
        var ia = document.getElementById('interest_area').value;
        var ta = document.getElementById('target').value;
        var st = startTime.valueOf() / 1000;
        var dt = endTime.valueOf() / 1000;

        var updateFlag = document.getElementById('idtodo') != null ? true : false;
        alert('value' + todoId + ' ' + title + +' ' + isa + ' ' + ia + ' ' + ta);
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
                data: {id: todoId, todo_name: title, is_appointment: isa, target: ta, interest_area: ia},
                dataType: 'json',
                success: function (data, status) {
                    alert('modify success.');
                }
            });
        }
        closeDialog('todo_modal');
        if (updateFlag) {
            calendar.fullCalendar('removeEvents', todoId);
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
<div class="span7">

    <div class="row-fluid">
        <div class="">
            <h3> 现在，你应该着手去做 </h3>
        </div>
        <div>
            <h3>您的本周目标是：</h3>
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
                                <a href="<?php echo site_url('target/modify/' . $target_item['idtarget']) ?>">新建待办</a>
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

<div class="span3" id='dayCalendar'>

</div>

</div>
</div>
