<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (dirname(dirname(dirname(__DIR__))) . '/system/core/Model.php');

class Auth_model extends CI_Model
{
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $rememberToken;
    public $created_at;
    public $updated_at;

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user($email)
    {
        $sql = "SELECT id, name, lastname, password FROM users WHERE email = ?";
        $query = $this->db->query($sql, $email);

        $result = $query->result();

        if(empty($result))
            return null;

        return $result[0];
    }

    public function set_token($id, $token)
    {
        $this->db->set(['rememberToken' => $token], FALSE);
        $this->db->where('id', $id);
        $status = $this->db->update('users');

        if($status) {
            return true;
        }

        return false;
    }

    public function get_token($id)
    {
        $sql = "SELECT rememberToken FROM users WHERE id = ?";
        $query = $this->db->query($sql, $id);

        $result = $query->result();

        if(empty($result))
            return null;

        return $result[0];
    }

}