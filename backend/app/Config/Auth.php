<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Auth extends BaseConfig
{
    /**
     * Validation rules for registration
     */
    public $registration = [
        'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
    ];
    
    /**
     * Validation rules for login
     */
    public $login = [
        'email'    => 'required|valid_email',
        'password' => 'required',
    ];
    
    /**
     * User Session variable used for storing logged in
     * user information.
     */
    public $sessionConfig = [
        'sessionName'  => 'user_session',
        'rememberName' => 'user_remember',
    ];
    
    /**
     * User provider
     */
    public $userProvider = 'database';
    
    /**
     * Tables used by Auth library
     */
    public $tables = [
        'users'       => 'users',
        'permissions' => 'auth_permissions',
        'groups'      => 'auth_groups',
        'roles'       => 'auth_roles',
    ];
    
    /**
     * Password hash method
     */
    public $hashMethod = 'PASSWORD_DEFAULT';
}