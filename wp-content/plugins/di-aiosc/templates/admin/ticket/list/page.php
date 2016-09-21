<?php aisoc_print_js_debug() ?>
<?php
global $aiosc_settings, $aiosc_capabilities, $aiosc_user;

if($aiosc_user->can('staff') && !$aiosc_user->can('answer_tickets'))
    $departments = $aiosc_user->get_departments(true);
else
    $departments = aiosc_DepartmentManager::get_departments(!$aiosc_user->can('staff'), true);

$priorities = aiosc_PriorityManager::get_priorities(!$aiosc_user->can('staff'), true);
$users = get_users();

$ticket_query = array();

$additional_query = '';
if(!$aiosc_user->can('staff')) $ticket_query['author_id'] = $aiosc_user->ID;
if(!$aiosc_user->can('edit_tickets') && $aiosc_user->can('staff')) {
    $ddd = $aiosc_user->get_departments(false);
    if($ddd !== false) {
        if(!empty($ticket_query)) $additional_query .= " AND (";
        else $additional_query .= "WHERE (";
        for($i=0;$i<count($ddd);$i++) {
            $additional_query .= " department_id = ".$ddd[$i]." ";
            if($i == count($ddd) - 1) $additional_query .= ")";
            else $additional_query .= " OR ";
        }
    }
}

$ticket_count_all = aiosc_TicketManager::get_count_by($ticket_query,$additional_query);
$ticket_count_queue = aiosc_TicketManager::get_count_by(array_merge($ticket_query,array('status'=>'queue')),$additional_query);
$ticket_count_open = aiosc_TicketManager::get_count_by(array_merge($ticket_query,array('status'=>'open')),$additional_query);
$ticket_count_closed = aiosc_TicketManager::get_count_by(array_merge($ticket_query,array('status'=>'closed')),$additional_query);

?>
<div id="screen-meta" class="metabox-prefs" style="display: none;">
    <div id="screen-options-wrap" class="hidden" tabindex="-1" aria-label="<?php _e('Screen Options Tab','aiosc')?>'" style="display: none;">
        <form id="adv-settings" action="<?php echo get_admin_url(0,'/admin-ajax.php')?>" method="post">
            <input type="hidden" name="action" value="aiosc_screen_options_tickets" />
            <h5><?php _e('Show tags','aiosc')?></h5>
            <div class="metabox-prefs">
                <label>
                    <input name="tag-awaiting_reply-hide" type="checkbox" <?php checked(!aiosc_cookie_get('tag-awaiting_reply-hide', false))?>><?php _e('Awaiting staff reply','aiosc')?>
                </label>
                <label>
                    <input name="tag-requested_closure-hide" type="checkbox" <?php checked(!aiosc_cookie_get('tag-requested_closure-hide', false))?>><?php _e('Requested closure','aiosc')?>
                </label>
                <label>
                    <input name="tag-attachments-hide" type="checkbox" <?php checked(!aiosc_cookie_get('tag-attachments-hide', false))?>><?php _e('Attachments','aiosc')?>
                </label>
            </div>
            <h5><?php _e('Show columns','aiosc')?></h5>
            <div class="metabox-prefs">
                <label>
                    <input name="id-hide" type="checkbox" <?php checked(!aiosc_cookie_get('id-hide', false))?>><?php _e('ID','aiosc')?>
                </label>
                <label>
                    <input name="status-hide" type="checkbox" <?php checked(!aiosc_cookie_get('status-hide', false))?>><?php _e('Status','aiosc')?>
                </label>
                <label>
                    <input name="replies-hide" type="checkbox" <?php checked(!aiosc_cookie_get('replies-hide', false))?>><?php _e('Replies','aiosc')?>
                </label>
                <label>
                    <input name="priority-hide" type="checkbox" <?php checked(!aiosc_cookie_get('priority-hide', false))?>><?php _e('Priority','aiosc')?>
                </label>
                <label>
                    <input name="department-hide" type="checkbox" <?php checked(!aiosc_cookie_get('department-hide', false))?>><?php _e('Department','aiosc')?>
                </label>
                <?php if($aiosc_user->can('staff')) : ?>
                    <label>
                        <input name="author-hide" type="checkbox" <?php checked(!aiosc_cookie_get('author-hide', false))?>><?php _e('Author','aiosc')?>
                    </label>
                    <label>
                        <input name="operator-hide" type="checkbox" <?php checked(!aiosc_cookie_get('operator-hide', false))?>><?php _e('Operator','aiosc')?>
                    </label>
                    <label>
                        <input name="last_update-hide" type="checkbox" <?php checked(!aiosc_cookie_get('last_update-hide', false))?>><?php _e('Last Update','aiosc')?>
                    </label>
                <?php endif; ?>
                <label>
                    <input name="date_created-hide" type="checkbox" <?php checked(!aiosc_cookie_get('date_created-hide', false))?>><?php _e('Date Created','aiosc')?>
                </label>
                <br class="clear">
            </div>
            <h5><?php _e('Items per page', 'aiosc')?></h5>
            <div class="metabox-prefs">
                <input type="number" step="1" min="1" max="999" name="tickets-per-page" maxlength="3" value="<?php echo aiosc_tickets_per_page(); ?>">
                <label for="edit_post_per_page"><?php _e('Tickets','aiosc')?></label>
                <br class="clear">
            </div>
            <br />
            <div class="screen-options">
                <input type="submit" name="screen-options-apply" id="screen-options-apply" class="button button-primary" value="<?php _e('Apply','aiosc')?>">
            </div>
        </form>
    </div>
</div>
<div id="screen-meta-links">
    <div id="screen-options-link-wrap" class="hide-if-no-js screen-meta-toggle" style="">
        <a href="#screen-options-wrap" id="show-settings-link" class="show-settings" aria-controls="screen-options-wrap" aria-expanded="false"><?php _e('Screen Options','aiosc')?></a>
    </div>
</div>
<div class="wrap aiosc-wrap">
    <div class="aiosc-ticket-list">
        <form method="post" id="aiosc-form" action="<?php echo get_admin_url()?>admin-ajax.php">
            <input type="hidden" name="action" value="aiosc_tickets_list" />
            <input type="hidden" name="status" id="list-screen" value="<?php echo in_array(aiosc_pg('status'),aiosc_TicketManager::get_statuses())?aiosc_pg('status'):'all'?>" />
            <input type="hidden" name="order" id="list-order" value="desc" />
            <input type="hidden" name="sort" id="list-sort" value="ID" />
            <div class="aiosc-toolbar">
                <ul class="aiosc-tabs">
                    <li data-screen="all"><?php _e('All','aiosc')?> (<span class="ticket-count-all"><?php echo $ticket_count_all?></span>)</li>
                    <li data-screen="queue"><?php _e('In Queue','aiosc')?> (<span class="ticket-count-queue"><?php echo $ticket_count_queue?></span>)</li>
                    <li data-screen="open"><?php _e('Open','aiosc')?> (<span class="ticket-count-open"><?php echo $ticket_count_open?></span>)</li>
                    <li data-screen="closed"><?php _e('Closed','aiosc')?> (<span class="ticket-count-closed"><?php echo $ticket_count_closed?></span>)</li>
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
                        <!-- Bulk Actions -->
                        <?php if($aiosc_user->can('answer_tickets')) : ?>
                            <div class="alignleft actions bulkactions">
                                <select name="bulkaction">
                                    <option value="-1" selected="selected"><?php _e('Bulk Actions','aiosc')?></option>
                                    <option value="edit"><?php _e('Quick Edit','aiosc')?></option>
                                    <option value="delete"><?php _e('Delete permanently','aiosc')?></option>
                                </select>
                                <input type="submit" name="bulkaction-submit" id="doaction" class="button action" value="<?php _e('Apply','aiosc')?>">
                            </div>
                        <?php endif; ?>
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
</div>