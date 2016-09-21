<?php
global $aiosc_settings, $aiosc_capabilities;
?>
<input type="hidden" name="section" value="general" />
<table class="form-table">
    <tbody>

    <tr>
        <th><label for="update_role"><?php _e('Remove old SC roles','aiosc')?></label>
            <a href="#" class="aiosc-info-tooltip dashicons dashicons-lightbulb"></a>
            <small><?php _e('If you had old Support Center (v1.3.9) installed, you should check this box.','aiosc')?> </small></th>
        <td>
            <label>
                <input type="checkbox" id="remove_old_sc_roles" name="remove_old_sc_roles" />
                <?php _e('Yes, get rid of old Support Center roles.','aiosc')?>
            </label>
        </td>
    </tr>
    <tr>
        <th><label for="update_role"><?php _e('Update Current Roles','aiosc')?></label>
            <a href="#" class="aiosc-info-tooltip dashicons dashicons-lightbulb"></a>
            <small><?php _e('Mass-Update current roles for all users (except staff members).','aiosc')?> </small></th>
        <td>
            <select id="update_role" name="update_role">
                <option value=""><?php _e('- Select role -','aiosc')?></option>
                <?php
                $allowed_roles = $aiosc_capabilities->get_allowed_massupdate_roles();
                foreach($allowed_roles as $k=>$v) :
                    ?>
                    <option value="<?php echo $k?>"><?php echo $v['name']?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <td>
            <input type="submit" class="button button-primary" id="aiosc-form-submit" value="<?php _e('Submit','aiosc')?>" />
            <button type="button" class="button" id="aiosc-form-discard"><?php _e('Discard','aiosc')?></button>
        </td>
    </tr>
    </tbody>
</table>