<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$auth['redirect_if_authenticated_to'] = 'welcome';

$auth['redirect_if_not_authenticated_to'] = '/login';

$auth['auth_paths'] = array(
    'auth_view_folder_name' => 'auth',
    'view_pag_login_name' => 'login',
    'view_pag_recover_name' => 'recover',
    'view_pag_register_name' => 'register',
    'view_pag_password_reset_name' => 'reset'
);


$auth['auth_session_prefix'] = 'auth_';