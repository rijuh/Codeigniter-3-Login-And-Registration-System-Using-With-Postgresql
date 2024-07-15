<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ums_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_info($user_data)
    {
        $this->db->insert('userinfo', $user_data);
        return $this->db->insert_id(); // RETURN THE AUTO_INCREAMENTED ID
    }

    public function insert_login($login_data)
    {
        $this->db->insert('userlogin', $login_data);
        if($this->db->affected_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function insert_education($education_data)
    {
        $this->db->insert('education', $education_data);
        if($this->db->affected_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function login_user($email)
    {
        $user = $this->db->select('*')->from('userlogin')->where('email', $email)->get()->row_array();
        return $user;
    }

    public function reset_password($email, $mobile, $data)
    {
        $this->db->where('email', $email);
        $this->db->where('mobile_no', $mobile);
        $this->db->update('userlogin', $data);
        if($this->db->affected_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_email_mobile($email, $mobile)
    {
        $check = $this->db->from('userlogin')->where('email', $email)->where('mobile_no', $mobile)->get()->num_rows();
        return $check;
    }
}