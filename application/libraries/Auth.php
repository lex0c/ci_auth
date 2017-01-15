<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (dirname(dirname(__DIR__)) . '/system/core/Controller.php');
require_once (dirname(dirname(__DIR__)) . '/system/core/Loader.php');
require_once (dirname(dirname(__DIR__)) . '/system/libraries/Session/Session.php');
require_once (dirname(__DIR__) . '/models/auth/Auth_model.php');

class Auth extends CI_Session
{
    protected $hasher = null;
    protected $authModel;
    protected $load;

    public function __construct()
    {
        //$this->load->config('auth', TRUE);
        //$this->load->helper('language');
        //$this->load->model('auth/Auth_model', 'authModel');
        //$this->load->library('Hash');

        $this->hasher = new Hash();
        $this->authModel = new Auth_model();
        $this->load = new CI_Loader();
    }

    public function authenticate(array $authData, $redirect)
    {
        if(!$this->isAuthenticated()) {
            $authData = array_map('htmlentities', $authData);
            $authData = array_map('trim', $authData);

            $user = $this->authModel->get_user($authData['email']);

            if($user == null) {
                return $this->load->view('auth/login', array(
                    'errors' => ['Incorrect email or does not exist.'],
                    'email_fail' => 'Incorrect email or does not exist.'
                ));
            } elseif(!$this->hasher->isEquals($authData['password'], $user->password)) {
                return $this->load->view('auth/login', array(
                    'errors' => ['Wrong password!'],
                    'password_fail' => 'Wrong password!'
                ));
            }

            $addr  = str_ireplace('.', '', filter_input(INPUT_SERVER, 'REMOTE_ADDR'));
            $agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');

            $auth_token = $addr . date("Ymd") . $agent . $user->id;
            $auth_token = $this->hasher->generate($auth_token);
            $this->authModel->set_token($user->id, $auth_token);

            $this->set_userdata([
                'user_id'    => $user->id,
                'name'       => $user->name,
                'lastname'   => $user->lastname,
                'email'      => $authData['email'],
                'status'     => $this->hasher->generate('isok'),
                '_token'     => $this->hasher->generate($agent . $addr . 'ramm4')
            ]);

        }

        return redirect($redirect, 200);
    }

    public function isAuthenticated()
    {
        if(($this->has_userdata('status') != null)
            && ($this->hasher->isEquals('isok', $this->userdata('status')))) {

            $addr  = str_ireplace('.', '', filter_input(INPUT_SERVER, 'REMOTE_ADDR'));
            $agent = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
            $token = $agent . $addr . 'ramm4';

            if($this->hasher->isEquals($token, $this->userdata('_token'))) {
                return true;
            }
        }

        return false;
    }

    public function who_see($access, $redirect = '/login', $excepts = [])
    {
        switch($access) {
            case 'auth':
                if(!$this->isAuthenticated()) {
                    redirect($redirect);
                }
                break;
            case 'public':
                // ...
                break;
            default:
                throw new InvalidArgumentException('Invalid access type.');
        }
    }

    protected function token_verify()
    {}

    public function logout()
    {}

    public function register($name, $email, $password)
    {}

}
