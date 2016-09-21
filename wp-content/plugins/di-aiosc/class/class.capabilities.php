<?php
    class aiosc_Capabilities {
        public $roles;
        function __construct() {
            $this->roles = $this->get_roles();
        }

        /**
         * Returns list of AIOSC roles.
         * It can be extended by using 'aiosc_roles' filter so extensions can add more capabilities and roles,
         * but additional roles (not capabilities) must be registered first.
         *
         * Capabilities assigned to these roles aren't real WP capabilities. We use dedicated function to check for these
         * capabilities in aiosc_User class.
         *
         * @filter aiosc_roles
         *
         * @return mixed|void
         */
        public function get_roles() {
            $roles = array(
                'aiosc_admin'=>array(
                    'name'=>__('Supervisor','aiosc'),
                    'caps'=>array(
                        'create_ticket'=>true,
                        'create_tickets'=>true,
                        'close_ticket'=>true,
                        'close_tickets'=>true,
                        'view_ticket'=>true,
                        'view_tickets'=>true,
                        'answer_tickets'=>true,
                        'answer_ticket'=>true,
                        'reply_tickets'=>true,
                        'reply_ticket'=>true,
                        'edit_tickets'=>true,
                        'edit_ticket'=>true,
                        'reopen_tickets'=>true,
                        'reopen_ticket'=>true,
                        'delete_tickets'=>true,
                        'delete_ticket'=>true,
                        'delete_replies'=>true,
                        'delete_reply'=>true,
                        'upload_files'=>true,
                        'download_files'=>true,
                        'download_file'=>true,
                        'request_ticket_closure'=>true,
                        'manage_options'=>true,
                        'view_statistics'=>true,
                        'staff'=>true
                    )
                ), //highest
                'aiosc_editor'=>array(
                    'name'=>__('Moderator','aiosc'),
                    'caps'=>array(
                        'create_ticket'=>true,
                        'create_tickets'=>true,
                        'close_ticket'=>true,
                        'close_tickets'=>true,
                        'reopen_tickets'=>true,
                        'reopen_ticket'=>true,
                        'delete_tickets'=>true,
                        'delete_ticket'=>true,
                        'delete_replies'=>true,
                        'delete_reply'=>true,
                        'view_ticket'=>true,
                        'view_tickets'=>true,
                        'answer_tickets'=>true,
                        'answer_ticket'=>true,
                        'reply_tickets'=>true,
                        'reply_ticket'=>true,
                        'edit_tickets'=>true,
                        'edit_ticket'=>true,
                        'request_ticket_closure'=>true,
                        'upload_files'=>true,
                        'download_files'=>true,
                        'download_file'=>true,
                        'staff'=>true
                    )
                ), //can moderate most of things (but not manage_options)

                'aiosc_support_op'=>array(
                    'name'=>__('Ticket Operator','aiosc'),
                    'caps'=>array(
                        'create_ticket'=>true,
                        'close_ticket'=>true,
                        'view_ticket'=>true,
                        'view_tickets'=>true,
                        'reopen_tickets'=>true,
                        'reopen_ticket'=>true,
                        'answer_tickets'=>false,
                        'answer_ticket'=>true,
                        'reply_ticket'=>true,
                        'request_ticket_closure'=>true,
                        'upload_files'=>true,
                        'download_files'=>true,
                        'download_file'=>true,
                        'staff'=>true
                    )
                ), //can answer tickets but cannot chat with customers
                'aiosc_exclusive_customer'=>array(
                    'name'=>__('Exclusive Customer','aiosc'),
                    'caps'=>array(
                        'create_ticket'=>true,
                        'reply_ticket'=>true,
                        'view_ticket'=>true,
                        'reopen_ticket'=>true,
                        'request_ticket_closure'=>true,
                        'upload_files'=>true,
                        'download_file'=>true
                    )
                ), //has some benefits that regular customer doesn't
                'aiosc_customer'=>array(
                    'name'=>__('Customer','aiosc'),
                    'caps'=>array(
                        'create_ticket'=>true,
                        'reply_ticket'=>true,
                        'view_ticket'=>true,
                        'reopen_ticket'=>true,
                        'request_ticket_closure'=>true,
                        'upload_files'=>true,
                        'download_file'=>true
                    )
                ), //can create tickets and chat, simple as that
            );
            $roles = apply_filters('aiosc_roles', $roles);
            return $roles;
        }
        function role_exists($role) {
            if(empty($role)) return false;
            $this->roles = $this->get_roles();
            return is_array($this->roles)?array_key_exists($role, $this->roles):false;
        }
        /**
         * Check if specific role has specific capability
         *
         * @update 1.1
         * @param $capability
         * @param $role_id
         * @return bool
         */
        function role_has_cap($capability, $role_id) {
            if(!$this->role_exists($role_id)) return false;
            return (isset($this->roles[$role_id]['caps'][$capability]) && $this->roles[$role_id]['caps'][$capability] == true);
        }
        function get_role_name($role_id) {
            $roles = $this->get_roles();
            if(!array_key_exists($role_id,$roles)) return __('None','aiosc');
            return $roles[$role_id]['name'];
        }

        /**
         * Get array of roles that can be used for Mass-update of current roles on Preferences > General page.
         * In case any add-on adds new role to AIOSC, it can define his role as un-allowed using below filter.
         *
         * @filter aiosc_allowed_massupdate_roles
         *
         * @return mixed|void
         */
        function get_allowed_massupdate_roles() {
            $roles = $this->get_roles();
            unset($roles['aiosc_admin']);
            unset($roles['aiosc_editor']);
            unset($roles['aiosc_support_op']);
            $roles = apply_filters('aiosc_allowed_massupdate_roles', $roles);
            return $roles;
        }

        /**
         * Get array of roles which have specific ca
         * @param $capability
         * @return array
         */
        function get_roles_by_cap($capability) {
            $roles = array();
            $this->roles = $this->get_roles();
            foreach($this->roles as $k=>$v) {
                if(array_key_exists($capability, $v['caps'])) {
                    $roles[$k] = $v;
                }
            }
            return $roles;
        }

        /**
         * Returns array of roles from previous Support Center (v1.3.9)
         * @return array
         */
        function get_old_sc_roles() {
            return array('disupport_customer','disupport_exclusive','disupport_staff','disupport_admin');
        }
        /**
         * @called-on-activation
         */
        function install() {
            //install AIOSC roles
            $this->install_roles();
            //assign highest AIOSC role to administrators
            $admins = get_users(array('role'=>'administrator'));
            $admin_ids = array();

            $aiosc_roles = $this->get_roles();
            $aiosc_roles = array_keys($aiosc_roles);

            foreach($admins as $admin) {
                $admin_ids[] = $admin->ID;
                /** @updated 1.0.3 */
                //remove old AIOSC roles in case there was any
                foreach($aiosc_roles as $k) {
                    if(in_array($k,$admin->roles))
                        $admin->remove_role($k);
                }
                //continue
                $admin->add_role('aiosc_admin');
                $aiosc_admin = new aiosc_User($admin->ID);
                $aiosc_admin->install_meta();
            }

            //assign lowest AIOSC role to other users, but skip Staff members if any
            $users = get_users(array('exclude'=>$admin_ids));
            $staff_roles = $this->get_roles_by_cap('staff');
            foreach($users as $user) {
                $new_role = 'aiosc_customer';
                foreach($user->roles as $k) {
                    //check if we have staff role first
                    if(array_key_exists($k,$staff_roles)) {
                        $new_role = $k;
                        $user->remove_role($k);
                    }
                    elseif(in_array($k,$aiosc_roles)) {
                        $new_role = $k;
                        $user->remove_role($k);
                    }
                }
                $user->add_role($new_role);
                if(array_key_exists($new_role, $staff_roles)) {
                    $staff_user = new aiosc_User($user->ID);
                    $staff_user->install_meta();
                }
            }
            aiosc_log('[AIOSC Installer] [Capabilities] Installed successfully.');
        }

        /**
         * @called-on-uninstall
         */
        function uninstall() {
            //unassign AIOSC roles from all users
            $roles = $this->get_roles();
            $users = get_users();
            foreach($users as $user) {
                foreach($roles as $k=>$v) {
                    if(in_array($k,$user->roles))
                        $user->remove_role($k);
                }
            }
            //and finally remove AIOSC roles from WordPress
            foreach($roles as $k=>$v) {
                remove_role($k);
            }
        }
        /**
         * @called-on-activation
         * Installs AIOSC roles as WordPress roles, but with only "read" capability so anyone can be assigned to even highest AIOSC role.
         * This is because we might want to assign Operator role to some user so he can answer tickets, but doesn't need access to 'manage_options'
         * for example. Even "Subscriber" WP role is enough for having highest AIOSC role.
         */
        private function install_roles() {
            foreach($this->get_roles() as $id=>$data) {
                add_role($id,$data['name'],array('read'=>true));
            }
        }
    }

    global $aiosc_capabilities;
    $aiosc_capabilities = new aiosc_Capabilities();