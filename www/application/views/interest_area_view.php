<div class="span7">
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open($action_name, $attributes);
    ?>

    <fieldset>
        <legend>关注域管理</legend>
        <input type="hidden" name="iduser_interest_area" value="<?php echo isset( $uia_tbm)? $uia_tbm['iduser_interest_area']:'' ?>" />
        <div class="control-group">
            <label class="control-label" for="user_interest_area_name">关注域名称</label>

            <div class="controls">
                <input type="text" id="user_interest_area_name" name="user_interest_area_name"
                       placeholder="请输入关注域名称"
                       value="<?php echo isset($uia_tbm) ?$uia_tbm['user_interest_area_name']:'' ?>"
                       minlength="2" maxlength="10"
                       required/>
                <span class="help-inline">不少于2个汉字，且不超过10个汉字</span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="display_order">显示顺序</label>

            <div class="controls">
                <input type="number" id="display_order" name="display_order"
                       data-validation-number-message="只能输入正整数"
                       placeholder="只能输入正整数" min="1"
                       value="<?php echo isset($uia_tbm) ?$uia_tbm['display_order']:'' ?>"

                    />
                <span class="help-inline">正整数，数字越小，显示顺序越靠前</span>
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

<div class="span3">

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>关注域</th>
                <th colspan="2">操作</th>
            </tr>
        </thead>

        <tbody>
        <?php
            $i =0;
            foreach ($interest_areas as $interest_area_item):
                $i++;
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $interest_area_item['user_interest_area_name'] ?></td>
                <td>
                    <a href="<?php echo site_url('interest_area/modify/'.$interest_area_item['iduser_interest_area']) ?>">更新</a>
                </td>
                <td>
                    <a href="<?php echo site_url('interest_area/delete/'.$interest_area_item['iduser_interest_area']) ?>">删除</a>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

</div>
</div>
