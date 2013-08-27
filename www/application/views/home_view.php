<script>
    var title = "";
    var startTime = "";
    var endTime = "";
    var allDayTime = "";
    var calendar;




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

    function showCreateTodoModal(targetId) {
        document.getElementById('target').value=targetId;

        $('#todo_modal').modal('show');
    }

    var setting = {
        edit: {
            enable: true,
            showRemoveBtn: false,
            showRenameBtn: false
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        view: {
            dblClickExpand: false
        },
        check: {
            enable: true
        },
        callback: {
            onRightClick: OnRightClick,
            beforeDrag: beforeDrag,
            beforeDrop: beforeDrop
        }
    };

    var zNodes =[
        <?php
         $display_arr="";

        foreach($targets as $target_item)
        {
            $display_arr .= '{';
            $display_arr .= 'id:'.$target_item['idtarget'];
            $display_arr .= ',pId:'.($target_item['parent_target']==null?0:$target_item['parent_target']) ;
            $display_arr .= ',name:"'.$target_item['target_name'] .'"';
            $display_arr .= ',open:true';
            $display_arr .= ',drag:'. ($target_item['parent_target']==null ?'false':'true');
            $display_arr .= '},';
        }
        $display_arr = substr($display_arr,0, strlen($display_arr)-1);
        echo $display_arr;?>
    ];


//    { id:1, pId:0, name:"随意拖拽 1", open:true},
//    { id:11, pId:1, name:"随意拖拽 1-1"},
//    { id:12, pId:1, name:"随意拖拽 1-2", open:true},
//    { id:121, pId:12, name:"随意拖拽 1-2-1"},
//    { id:122, pId:12, name:"随意拖拽 1-2-2"},
//    { id:123, pId:12, name:"随意拖拽 1-2-3"},
//    { id:13, pId:1, name:"禁止拖拽 1-3", open:true, drag:false},
//    { id:131, pId:13, name:"禁止拖拽 1-3-1", drag:false},
//    { id:132, pId:13, name:"禁止拖拽 1-3-2", drag:false},
//    { id:133, pId:13, name:"随意拖拽 1-3-3"},
//    { id:2, pId:0, name:"随意拖拽 2", open:true},
//    { id:21, pId:2, name:"随意拖拽 2-1"},
//    { id:22, pId:2, name:"禁止拖拽到我身上 2-2", open:true, drop:false},
//    { id:221, pId:22, name:"随意拖拽 2-2-1"},
//    { id:222, pId:22, name:"随意拖拽 2-2-2"},
//    { id:223, pId:22, name:"随意拖拽 2-2-3"},
//    { id:23, pId:2, name:"随意拖拽 2-3"}
    function beforeDrag(treeId, treeNodes) {
        for (var i=0,l=treeNodes.length; i<l; i++) {
            if (treeNodes[i].drag === false) {
                return false;
            }
        }
        return true;
    }
    function beforeDrop(treeId, treeNodes, targetNode, moveType) {
        return targetNode ? targetNode.drop !== false : true;
    }

    function OnRightClick(event, treeId, treeNode) {
        if (!treeNode && event.target.tagName.toLowerCase() != "button" && $(event.target).parents("a").length == 0) {
            zTree.cancelSelectedNode();
            showRMenu("root", event.clientX, event.clientY);
        } else if (treeNode && !treeNode.noR) {
            zTree.selectNode(treeNode);
            showRMenu("node", event.clientX, event.clientY);
        }
    }

    function showRMenu(type, x, y) {
        $("#rMenu ul").show();
        if (type=="root") {
            $("#m_del").hide();
            $("#m_check").hide();
            $("#m_unCheck").hide();
        } else {
            $("#m_del").show();
            $("#m_check").show();
            $("#m_unCheck").show();
        }
        rMenu.css({"top":y+"px", "left":x+"px", "visibility":"visible"});

        $("body").bind("mousedown", onBodyMouseDown);
    }
    function hideRMenu() {
        if (rMenu) rMenu.css({"visibility": "hidden"});
        $("body").unbind("mousedown", onBodyMouseDown);
    }
    function onBodyMouseDown(event){
        if (!(event.target.id == "rMenu" || $(event.target).parents("#rMenu").length>0)) {
            rMenu.css({"visibility" : "hidden"});
        }
    }
    var addCount = 1;
    function addTreeNode() {
        hideRMenu();
        var newNode = { name:"增加" + (addCount++)};
        if (zTree.getSelectedNodes()[0]) {
            newNode.checked = zTree.getSelectedNodes()[0].checked;
            zTree.addNodes(zTree.getSelectedNodes()[0], newNode);
        } else {
            zTree.addNodes(null, newNode);
        }
    }
    function removeTreeNode() {
        hideRMenu();
        var nodes = zTree.getSelectedNodes();
        if (nodes && nodes.length>0) {
            if (nodes[0].children && nodes[0].children.length > 0) {
                var msg = "要删除的节点是父节点，如果删除将连同子节点一起删掉。\n\n请确认！";
                if (confirm(msg)==true){
                    zTree.removeNode(nodes[0]);
                }
            } else {
                zTree.removeNode(nodes[0]);
            }
        }
    }
    function checkTreeNode(checked) {
        var nodes = zTree.getSelectedNodes();
        if (nodes && nodes.length>0) {
            zTree.checkNode(nodes[0], checked, true);
        }
        hideRMenu();
    }
    function resetTree() {
        hideRMenu();
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    }

    var zTree, rMenu;

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

            select: function (start, end, allDay) {
                startTime = start;
                endTime = end;
                allDayTime = allDay;
                $("#interest_area").jCombo("http://localhost/get_user_interest_areas", { selected_value: '<?php echo "15" ?>' });
                $("#target").jCombo("http://localhost/get_targets/", { parent: "#interest_area" });
                $('#todo_modal').modal('show');
            },

            eventClick: function (calEvent, jsEvent, view) {
                if (document.getElementById('idtodo') != null) {
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


        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        zTree = $.fn.zTree.getZTreeObj("treeDemo");
        rMenu = $("#rMenu");
    });

</script>

<style type="text/css">
    div#rMenu {position:absolute; visibility:hidden; top:0; background-color: #555;text-align: left;padding: 2px;}
    div#rMenu ul li{
        margin: 1px 0;
        padding: 0 5px;
        cursor: pointer;
        list-style: none outside none;
        background-color: #DFDFDF;
    }
</style>
<div class="span8">

    <div class="row-fluid">
        <div class="">
            <h3> 现在，你应该着手去做 </h3>
        </div>
        <div>
            <ul id="treeDemo" class="ztree"></ul>
        </div>
    </div>
</div>

<div class="span2" id='dayCalendar'>

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
        <input type="hidden" id="target" name="target">
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


<div id="rMenu">
    <ul>
        <li id="m_add" onclick="addTreeNode();">增加节点</li>
        <li id="m_del" onclick="removeTreeNode();">删除节点</li>
        <li id="m_check" onclick="checkTreeNode(true);">Check节点</li>
        <li id="m_unCheck" onclick="checkTreeNode(false);">unCheck节点</li>
        <li id="m_reset" onclick="resetTree();">恢复zTree</li>
    </ul>
</div>