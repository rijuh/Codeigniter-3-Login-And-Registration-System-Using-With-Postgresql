<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function all_user()
    {
        $data['count_admin'] = $this->db->from('userlogin')->where('level', 'Admin')->count_all_results();
        $data['count_senior'] = $this->db->from('userlogin')->where('level', 'Senior')->count_all_results();
        $data['count_entry'] = $this->db->from('userlogin')->where('level', 'Entry')->count_all_results();
        return $data;
    }

    public function get_user_by_id($id)
    {
        $user_data = $this->db->select('*')->from('userinfo')->where('id', $id)->get()->row_array();
        return $user_data;
    }

    public function get_education($id)
    {
        $education_data = $this->db->select('*')->from('education')->where('user_id', $id)->get()->result_array();
        return $education_data;
    }

    public function get_user_by_email($email)
    {
        $user_data = $this->db->select('*')->from('userinfo')->where('email', $email)->get()->row_array();
        return $user_data;
    }

    public function all_admin()
    {
        $data = $this->db->select("id, CONCAT(fname,' ',mname,' ',lname) AS name, dob, age, email, mobile_no, gender, level")->from('userinfo')->where('level', 'Admin')->get()->result_array();
        return $data;
    }

    public function all_senior()
    {
        $data = $this->db->select("id, CONCAT(fname,' ',mname,' ',lname) AS name, dob, age, email, mobile_no, gender, level")->from('userinfo')->where('level', 'Senior')->get()->result_array();
        return $data;
    }

    public function all_entry()
    {
        $data = $this->db->select("id, CONCAT(fname,' ',mname,' ',lname) AS name, dob, age, email, mobile_no, gender, level")->from('userinfo')->where('level', 'Entry')->get()->result_array();
        return $data;
    }

    public function profile_view($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('userinfo');
        $result = $query->row_array();
        return $result;
    }

    public function change_password($email, $password)
    {
        $data = array('password' => $password);
        $this->db->where('email', $email);
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

    public function delete_userinfo($id)
    {
        $this->db->delete('userinfo', ['id' => $id]);
    }

    public function delete_userlogin($id)
    {
        return $this->db->delete('userlogin', ['user_id' => $id]);
    }

    public function delete_education($id)
    {
        return $this->db->delete('education', ['user_id' => $id]);
    }

    public function update_info($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('userinfo', $data);
    }

    public function update_login($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('userlogin', $data);
    }

    public function update_education($id, $data)
    {
        $this->db->where('user_id', $id);
        $this->db->update('education', $data);
    }
}