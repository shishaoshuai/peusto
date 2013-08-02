<div class="span7">
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open('interest_area/create', $attributes);
    ?>

    <fieldset>
        <legend>关注域管理</legend>
        <div class="control-group">
            <label class="control-label" for="interest_area_name">关注域名称</label>

            <div class="controls">
                <input type="text" id="interest_area_name" name="interest_area_name" placeholder="请输入关注域名称" required/>
                <span class="help-inline">关注域要简明扼要，不超过10个汉字</span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="display_order">显示顺序</label>

            <div class="controls">
                <input type="text" id="display_order" name="display_order" placeholder="只能输入正整数"
                       data-validation-regex-regex="^[0-9]*[1-9][0-9]*$"
                       data-validation-regex-message="只能输入正整数  "
                    />
                <span class="help-inline">数字小的显示在前面</span>
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

<div class="span3">

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>关注域</th>
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
                <td><?php echo $interest_area_item['interest_area_name'] ?></td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>

</div>
</div>
