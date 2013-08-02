<div class="span7">
    <?php
    $attributes = array('class' => 'form-horizontal');
    echo form_open('interest_area/create', $attributes);
    ?>

    <fieldset>
        <legend>��ע�����</legend>
        <div class="control-group">
            <label class="control-label" for="interest_area_name">��ע������</label>

            <div class="controls">
                <input type="text" id="interest_area_name" name="interest_area_name" placeholder="�������ע������" required/>
                <span class="help-inline">��ע��Ҫ������Ҫ��������10������</span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="display_order">��ʾ˳��</label>

            <div class="controls">
                <input type="text" id="display_order" name="display_order" placeholder="ֻ������������"
                       data-validation-regex-regex="^[0-9]*[1-9][0-9]*$"
                       data-validation-regex-message="ֻ������������  "
                    />
                <span class="help-inline">����С����ʾ��ǰ��</span>
            </div>
        </div>
        <div class="control-group">
            <div class="controls" text-align="center">
                <button type="submit" class="btn btn-primary">����</button>
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
                <th>��ע��</th>
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
