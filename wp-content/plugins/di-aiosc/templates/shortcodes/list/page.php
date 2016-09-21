<?php aisoc_print_js_debug() ?>
<?php
/**
 * Available Variables
 * $aiosc_user aiosc_User - current aiosc user
 * $aiosc_settings - can be used for retrieving AIOSC settings (->get or aiosc_settings_get())
 * $ticket_count stdClass - contains ticket count for all/queue/open/closed ($ticket_count->queue for example)
 * $departments array - contains array of aiosc_Department instances that current user has access to
 * $priorities array - contains array of aiosc_Priority instances that current user has access to
 * $users array - contains array of WP_User instances for listing in Author & Operator filters
 * $public_mode bool - is publicOnly enabled (true) or (false)
 */
?>
<div class="aiosc-ticket-list">
    <form method="post" id="aiosc-form" action="<?php echo get_admin_url()?>admin-ajax.php">
        <input type="hidden" name="action" value="aiosc_tickets_list" />
        <input type="hidden" name="status" id="list-screen" value="<?php echo in_array(aiosc_pg('status'),aiosc_TicketManager::get_statuses())?aiosc_pg('status'):'all'?>" />
        <input type="hidden" name="order" id="list-order" value="desc" />
        <input type="hidden" name="sort" id="list-sort" value="ID" />
        <input type="hidden" name="frontend" value="1" /> <!-- Important field, don't remove it! -->
        <?php if($publicOnly) : ?>
            <input type="hidden" name="public_mode" value="1" />
        <?php endif; ?>
        <div class="aiosc-toolbar">
            <ul class="aiosc-tabs">
                <li data-screen="all"><?php _e('All','aiosc')?> (<span class="ticket-count-all"><?php echo $ticket_count->all?></span>)</li>
                <li data-screen="queue"><?php _e('In Queue','aiosc')?> (<span class="ticket-count-queue"><?php echo $ticket_count->queue?></span>)</li>
                <li data-screen="open"><?php _e('Open','aiosc')?> (<span class="ticket-count-open"><?php echo $ticket_count->open?></span>)</li>
                <li data-screen="closed"><?php _e('Closed','aiosc')?> (<span class="ticket-count-closed"><?php echo $ticket_count->closed?></span>)</li>
            </ul>
            <!-- Search -->
            <div class="aiosc-search-box">
                <input type="text" name="search" id="ticket-search" placeholder="<?php _e('Search by #ID or term','aiosc')?>" value="<?php echo @$_POST['search']?>" />
                <button type="submit" name="search-submit" id="search-submit" class="button" value="1" title="<?php _e('Search','aiosc')?>"><i class="dashicons dashicons-search"></i></button>
            </div>
        </div>
        <!-- Filters -->
        <div class="aiosc-filters">
            <div class="aiosc-filters-container">
                <?php if(is_array($priorities) && count($priorities) > 0) : ?>
                    <select name="priority" id="filter-priorities">
                        <option value="0"><?php _e('- Priority -','aiosc')?></option>
                        <?php foreach($priorities as $pri) : ?>
                            <option value="<?php echo $pri->ID?>" <?php echo aiosc_pg('priority') == $pri->ID?"selected":""?>><?php echo $pri->name?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if(is_array($departments) && count($departments) > 0) : ?>
                    <select name="department" id="filter-departments">
                        <option value="0"><?php _e('- Department -','aiosc')?></option>
                        <?php foreach($departments as $dep) : ?>
                            <option value="<?php echo $dep->ID?>" <?php echo aiosc_pg('department') == $dep->ID?"selected":""?>><?php echo $dep->name?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
                <?php if($aiosc_user->can('staff')) : ?>
                    <select name="is_public" id="filter-is_public">
                        <option value="0"><?php _e('- Visibility -','aiosc')?></option>
                        <option value="N"><?php _e('Private','aiosc')?></option>
                        <option value="Y"><?php _e('Public','aiosc')?></option>
                    </select>
                    <?php if(is_array($users) && count($users) > 0) : ?>
                        <select name="author" id="filter-authors" style="width: 150px;">
                            <option value="0"><?php _e('- Author -','aiosc')?></option>
                            <option value="<?php echo $aiosc_user->ID?>" <?php echo aiosc_pg('author') == $aiosc_user->ID?"selected":""?>>
                                <?php printf(__('Me (%s)', 'aiosc'), $aiosc_user->display_name)?></option>
                            <?php foreach($users as $user) :
                                if($user->ID != $aiosc_user->ID) : ?>
                                    <option value="<?php echo $user->ID?>" <?php echo aiosc_pg('author') == $user->ID?"selected":""?>>
                                        <?php echo $user->display_name?> @<?php echo $user->user_login;?></option>
                                <?php endif; endforeach; ?>
                        </select>
                    <?php endif; ?>
                    <?php if(is_array($users) && count($users) > 0) : ?>
                        <select name="operator" id="filter-operators" style="width: 150px;" <?php if(aiosc_pg('me_operator', true, false)) : ?>disabled="disabled"<?php endif; ?>>
                            <option value="0"><?php _e('- Operator -','aiosc')?></option>
                            <option value="<?php echo $aiosc_user->ID?>" <?php echo aiosc_pg('operator') == $aiosc_user->ID?"selected":""?>>
                                <?php printf(__('Me (%s)', 'aiosc'), $aiosc_user->display_name)?></option>
                            <?php foreach($users as $user) :
                                $aUser = new aiosc_User($user->ID);
                                if($aUser->can('staff') && $aUser->ID != $aiosc_user->ID) :
                                    ?>
                                    <option value="<?php echo $user->ID?>" <?php echo aiosc_pg('operator') == $user->ID?"selected":""?>>
                                        <?php echo $user->display_name?> @<?php echo $user->user_login;?></option>
                                <?php endif; endforeach; ?>
                        </select>
                    <?php endif; ?>
                <?php endif; ?>

                &nbsp; <label>|</label> &nbsp;
                <label for="filter-awaiting_staff_reply" title="<?php _e('Only show tickets which require staff reply.', 'aiosc')?>"><input type="checkbox" id="filter-awaiting_staff_reply" name="awaiting_staff_reply" <?php checked(aiosc_pg('awaiting_staff_reply', true, false)) ?>/><strong><?php _e('Awaiting reply', 'aiosc')?></strong></label>
                &nbsp; <label>|</label> &nbsp;
                <label for="filter-requested_closure" title="<?php _e('Only show tickets with requested closure.', 'aiosc')?>"><input type="checkbox" id="filter-requested_closure" name="requested_closure" <?php checked(aiosc_pg('requested_closure', true, false)) ?>/><strong><?php _e('Requested closure', 'aiosc')?></strong></label>
                &nbsp; <label>|</label> &nbsp;
                <?php do_action('aiosc_ticket_filters') ?>
                <button type="submit" value="1" name="view-change" id="view-change" class="button button-primary"><?php _e('Apply Filters', 'aiosc')?></button>
                <button type="button" id="reset-filters" class="button"><?php _e('Reset', 'aiosc')?></button>
            </div>
        </div>

        <div class="aiosc-clear"></div>
        <div id="ajax-response"></div>
        <div class="aiosc-form">
            <div class="aiosc-tab-content-holder">
                <div class="aiosc-loading-holder"><div class="aiosc-loading-bar"><span><?php _e('Loading Screen...','aiosc')?></span></div></div>
                <div class="tablenav">
                    <!-- PAGINATION GOES HERE -->
                </div>
                <div class="aiosc-clear"></div>
                <div class="aiosc-tab-content">
                    <!-- Here we use one-time params for LIST query, they will be replaced the first time LIST is loaded -->
                    <?php if(isset($_GET['paged'])) : ?>
                        <input type="hidden" name="paged" value="<?php echo aiosc_pg('paged')?>" />
                    <?php endif; ?>
                </div>
            </div>
    </form>
</div>
</div>
