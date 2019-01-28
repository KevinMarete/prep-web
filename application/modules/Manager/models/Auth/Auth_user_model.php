<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_user_model extends CI_Model {

    // function register user
    public function register_user($user) {

        $this->db->insert('auth_tbl_users', $user);
    }

    // function check if email is already registered     
    public function email_check($email) {
        $this->db->select('*');
        $this->db->from('auth_tbl_users');
        $this->db->where('email', $email);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    //Get user details
    public function getRegisteredUser($email){

        $this->db->select('u.id,u.first_name,u.last_name,u.email,r.role,u.mobile,s.scope');
        $this->db->from('auth_tbl_users u');
        $this->db->join('auth_tbl_roles r', 'r.roleId=u.roleId');
        $this->db->join('auth_tbl_scope s', 's.id=u.scope');
        $this->db->where('u.email',$email);
        $query= $this->db->get();
        return $query->result_array();
    }

}
