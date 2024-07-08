<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_email($email)
    {
        $user_data = $this->db->select('*')->from('userlogin')->where('email', $email)->get()->row_array();
        return $user_data;
    }

    public function all_admin()
    {
        $data = $this->db->select('*')->from('userlogin')->where('level', 'admin')->get()->result_array();
        return $data;
    }

    public function all_senior()
    {
        $data = $this->db->select('*')->from('userlogin')->where('level', 'senior')->get()->result_array();
        return $data;
    }

    public function all_entry()
    {
        $data = $this->db->select('*')->from('userlogin')->where('level', 'entry')->get()->result_array();
        return $data;
    }

    public function change_password()
    {
        
    }
}