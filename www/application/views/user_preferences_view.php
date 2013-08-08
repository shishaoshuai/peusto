<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form input:checkbox').click(function () {
            if ($(this).is(':checked')) {
                $.post('http://localhost/add_target_type/' + $(this).val());
            } else {
                $.post('http://localhost/delete_target_type/' + $(this).val());
            }
        });
    });
</script>
<script language=javascript>
    function addRow() {
        if (document.all.startTime.value == "") {
            alert("请先输入开始时间！");
        } else {
            var day = "星期九";
            var startTime = document.getElementById("startTime");
            var endTime = document.getElementById("endTime");
            var table1 = document.getElementById("table1");
            var mytr = table1.insertRow(-1);
            var mytd = mytr.insertCell();

            mytd.innerHTML = "<i class=\"icon-remove\" title = \"删除\" onclick=\"javaScript:document.all.table1.deleteRow(event.srcElement.parentElement.parentElement.rowIndex);\">";
            mytd = mytr.insertCell();
            mytd.innerText = endTime.value;
            mytd = mytr.insertCell();
            mytd.innerText = startTime.value;
            mytd = mytr.insertCell();
            mytd.innerText = day;
            mytd = mytr.insertCell();
            mytd.innerText = table1.rows.length - 1;
        }
    }
</script>
<div class="span10">
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">工作时间</a></li>
            <li><a href="#tabs-2">高效工作时间</a></li>
            <li><a href="#tabs-3">每天固定安排</a></li>
            <li><a href="#tabs-4">每周固定安排</a></li>
            <li><a href="#tabs-5">目标类型设置</a></li>
        </ul>
        <div id="tabs-1">
            <form id="form2" method="post">
                <div class="controls">每天
                    <input class="input-mini" type="startTime" placeholder="开始时间">&nbsp;到&nbsp;
                    <input class="input-mini" type="endTime" placeholder="结束时间">
                    <input class="input-large" type="action" placeholder="请输入固定任务">
                    <select class="span2" placeholder="关注域">
                        <option>家庭</option>
                        <option>工作</option>
                        <option>个人健康</option>
                        <option>个人事业</option>
                        <option>娱乐</option>
                    </select>
                    <select class="span2" placeholder="所对应目标">
                        <option>无</option>
                        <option>建设时间管理网站</option>
                        <option>坚持每周锻炼两次</option>
                        <option>管理分析类数据标准落地</option>
                        <option>行业主题挖掘分析</option>
                    </select>
                    &nbsp;&nbsp;
                    <button class="btn btn-small btn-primary" type="button">删除</button>
                    <button class="btn btn-small btn-primary" type="button">增加</button>
                </div>
            </form>
        </div>
        <div id="tabs-2">
            <table class="table table-hover" id="table1">
                <thead>
                <tr>
                    <th>#</th>
                    <th>星期</th>
                    <th>开始时间</th>
                    <th>截止时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>制作用户首页</td>
                    <td>个人事业</td>
                    <td>6小时后</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>制作维护关注域页面</td>
                    <td>个人事业</td>
                    <td>10小时</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>制作目标管理维护页面</td>
                    <td>个人事业</td>
                    <td>16小时</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <?php
            $attributes = array('class' => 'form-horizontal');
            echo form_open('user_preferences/create', $attributes);
            ?>
            <form id="form1" method="post">
                <div class="control-group">
                    <div class="controls">
                        &nbsp;从<input class="input-mini" type="text" id="startTime" placeholder="开始时间">
                        到<input class="input-mini" type="text" id="endTime" placeholder="结束时间">
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1" checked> 星期一
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 星期二
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3" checked> 星期三
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox4" value="option1" checked> 星期四
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox5" value="option2" checked> 星期五
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox6" value="option3"> 星期六
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox7" value="option3"> 星期日
                        </label>
                        &nbsp;&nbsp;

                        <button class="btn btn-small btn-primary" type="button" onclick="javaScript:addRow();">新增
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div id="tabs-3">
            <form id="form2" method="post">
                <div class="controls">每天
                    <input class="input-mini" type="startTime" placeholder="开始时间">&nbsp;到&nbsp;
                    <input class="input-mini" type="endTime" placeholder="结束时间">
                    <input class="input-large" type="action" placeholder="请输入固定任务">
                    <select class="span2" placeholder="关注域">
                        <option>家庭</option>
                        <option>工作</option>
                        <option>个人健康</option>
                        <option>个人事业</option>
                        <option>娱乐</option>
                    </select>
                    <select class="span2" placeholder="所对应目标">
                        <option>无</option>
                        <option>建设时间管理网站</option>
                        <option>坚持每周锻炼两次</option>
                        <option>管理分析类数据标准落地</option>
                        <option>行业主题挖掘分析</option>
                    </select>
                    &nbsp;&nbsp;
                    <button class="btn btn-small btn-primary" type="button">删除</button>
                    <button class="btn btn-small btn-primary" type="button">增加</button>
                </div>
            </form>
        </div>
        <div id="tabs-4">
            <form id="form3" method="post">
                <div class="control-group">
                    <label class="control-label" for="dtp_input1"></label>

                    <div class="controls">每周&nbsp;
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1" checked> 星期一
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 星期二
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3" checked> 星期三
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1" checked> 星期四
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 星期五
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3"> 星期六
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3"> 星期日
                        </label>
                        <br/>
                        &nbsp;从&nbsp;<input class="input-mini" type="startTime" placeholder="开始时间">&nbsp;到&nbsp;
                        <input class="input-mini" type="endTime" placeholder="结束时间">
                        <input class="input-large" type="action" placeholder="请输入固定任务">
                        <select class="span2" placeholder="关注域">
                            <option>家庭</option>
                            <option>工作</option>
                            <option>个人健康</option>
                            <option>个人事业</option>
                            <option>娱乐</option>
                        </select>
                        <select class="span2" placeholder="所对应目标">
                            <option>无</option>
                            <option>建设时间管理网站</option>
                            <option>坚持每周锻炼两次</option>
                            <option>管理分析类数据标准落地</option>
                            <option>行业主题挖掘分析</option>
                        </select>

                        &nbsp;&nbsp;
                        <button class="btn btn-small btn-primary" type="button">删除</button>
                        <button class="btn btn-small btn-primary" type="button">增加</button>
                    </div>
                </div>
            </form>
        </div>

        <div id='tabs-5'>
            <?php
            $attributes = array('class' => 'form-horizontal');
            echo form_open('target/create', $attributes);
            ?>
            <fieldset>
                <legend>您想管理的目标</legend>

                <div class="control-group">
                    <div class="controls">
                        <?php
                        $target_type_item_index = 0;
                        $user_target_type_item_index = 0;
                        foreach ($target_types as $target_type_item) {
                            echo "<input type='checkbox' class='target_type_checkbox' value='" . ($target_type_item_index+1) . "'";
                            $checked = "";
                            if ($target_type_item_index+1 == current($user_target_types[$user_target_type_item_index])) {
                                $checked = " checked='true'";
                                if ($user_target_type_item_index < count($user_target_types) - 1) {
                                    $user_target_type_item_index++;
                                }
                            }
                            echo $checked . ">";
                            echo $target_types[$target_type_item_index];
                            $target_type_item_index++;
                        }
                        ?>
                    </div>
                </div>
            </fieldset>
            </form>
        </div>
    </div>
</div>
</div>
</div>
