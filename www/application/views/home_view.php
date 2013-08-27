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
            editNameSelectAll: true,
            showRemoveBtn: showRemoveBtn,
            showRenameBtn: showRenameBtn
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        view: {
            addHoverDom: addHoverDom,
            removeHoverDom: removeHoverDom,
            dblClickExpand: false,
            showTitle:false,
            selectedMulti: false
        },
        callback: {
            onRightClick: OnRightClick,
            beforeDrag: beforeDrag,
            beforeDrop: beforeDrop,
            beforeEditName: beforeEditName,
            beforeRemove: beforeRemove,
            beforeRename: beforeRename,
            onRemove: onRemove,
            onRename: onRename
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

    var log, className = "dark";

    function beforeEditName(treeId, treeNode) {
        className = (className === "dark" ? "":"dark");
        showLog("[ "+getTime()+" beforeEditName ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.selectNode(treeNode);
        return confirm("进入节点 -- " + treeNode.name + " 的编辑状态吗？");
    }
    function beforeRemove(treeId, treeNode) {
        className = (className === "dark" ? "":"dark");
        showLog("[ "+getTime()+" beforeRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.selectNode(treeNode);
        return confirm("确认删除 节点 -- " + treeNode.name + " 吗？");
    }
    function onRemove(e, treeId, treeNode) {
        showLog("[ "+getTime()+" onRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
    }
    function beforeRename(treeId, treeNode, newName, isCancel) {
        className = (className === "dark" ? "":"dark");
        showLog((isCancel ? "<span style='color:red'>":"") + "[ "+getTime()+" beforeRename ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name + (isCancel ? "</span>":""));
        if (newName.length == 0) {
            alert("节点名称不能为空.");
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            setTimeout(function(){zTree.editName(treeNode)}, 10);
            return false;
        }
        return true;
    }
    function onRename(e, treeId, treeNode, isCancel) {
        showLog((isCancel ? "<span style='color:red'>":"") + "[ "+getTime()+" onRename ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name + (isCancel ? "</span>":""));
    }
    function showRemoveBtn(treeId, treeNode) {
        return !treeNode.isFirstNode;
    }
    function showRenameBtn(treeId, treeNode) {
        return !treeNode.isLastNode;
    }
    function showLog(str) {
        if (!log) log = $("#log");
        log.append("<li class='"+className+"'>"+str+"</li>");
        if(log.children("li").length > 8) {
            log.get(0).removeChild(log.children("li")[0]);
        }
    }
    function getTime() {
        var now= new Date(),
            h=now.getHours(),
            m=now.getMinutes(),
            s=now.getSeconds(),
            ms=now.getMilliseconds();
        return (h+":"+m+":"+s+ " " +ms);
    }

    var newCount = 1;
    function addHoverDom(treeId, treeNode) {
        var sObj = $("#" + treeNode.tId + "_span");
        if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
            + "' title='add node' onfocus='this.blur();'></span>";
        sObj.after(addStr);
        var btn = $("#addBtn_"+treeNode.tId);
        if (btn) btn.bind("click", function(){
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            //todo:show add target modal
            $('#todo_modal').modal('show');

            zTree.addNodes(treeNode, {id:(100 + newCount), pId:treeNode.id, name:"new node" + (newCount++)});
            return false;
        });
    };
    function removeHoverDom(treeId, treeNode) {
        $("#addBtn_"+treeNode.tId).unbind().remove();
    };
    function selectAll() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.edit.editNameSelectAll =  $("#selectAll").attr("checked");
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
        $("#selectAll").bind("click", selectAll);
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
    .ztree li span.button.add {margin-left:2px; margin-right: -1px; background-position:-144px 0; vertical-align:top; *vertical-align:middle}

</style>
<div class="span8">

    <div class="row-fluid">
        <div class="">
            <h3> 现在，你应该着手去做 </h3>
        </div>
        <div  class="zTreeDemoBackground left">
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

        </h3>
    </div>

    <div class="modal-body">
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