<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ums_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_data($data) {
        $this->db->insert('userinfo', $data);
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

    public function get_data()
    {
        $data = $this->db->select("id, CONCAT(fname, ' ', mname, ' ', lname) AS name, age, dob, gender, mobile_no, email")->from('userinfo')->get()->result_array();
        return $data;
    }
}