<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model("Dashboard_model");
		$this->load->library('form_validation');
    }

    public function index()
    {
        if($this->session->userdata('islogin'))
        {
            $id = $this->session->userdata('id');
            $data['user_data'] = $this->Dashboard_model->get_user_by_id($id);
            $data['count_user'] = $this->Dashboard_model->all_user();
            $this->load->view('New_dashboard', $data);
        }
        else
        {
            $this->session->set_flashdata('Dashn', 'Dashboard is not opening');
            return redirect(base_url('login-view'));
        }
    }

    public function user_list($level)
    {
        if($this->session->userdata('islogin'))
        {
            $id = $this->session->userdata('id');
            $data['user_data'] = $this->Dashboard_model->get_user_by_id($id);
            if($level == 'admin')
            {
                $data['all_user'] = $this->Dashboard_model->all_admin();
                $data['level'] = ucwords($level);
            }
            elseif($level == 'senior')
            {
                $data['all_user'] = $this->Dashboard_model->all_senior();
                $data['level'] = ucwords($level);
            }
            else
            {
                $data['all_user'] = $this->Dashboard_model->all_entry();
                $data['level'] = ucwords($level);
            }
            $this->load->view('Datatable_view', $data);
        }
        else
        {
            return redirect(base_url('login-view'), 'refresh');
        }
    }

    public function senior_list()
    {
        if($this->session->userdata('islogin'))
        {
            $id = $this->session->userdata('id');
            $data['user_data'] = $this->Dashboard_model->get_user_by_id($id);
            $data['all_user'] = $this->Dashboard_model->all_senior();
            $this->load->view('Datatable_senior_view', $data);
        }
        else
        {
            return redirect(base_url('login-view'), 'refresh');
        }
    }

    public function entry_list()
    {
        if($this->session->userdata('islogin'))
        {
            $id = $this->session->userdata('id');
            $data['user_data'] = $this->Dashboard_model->get_user_by_id($id);
            $data['all_user'] = $this->Dashboard_model->all_entry();
            $this->load->view('Datatable_entry_view', $data);
        }
        else
        {
            return redirect(base_url('login-view'), 'refresh');
        }
    }

    public function change_password()
    {
        if($this->session->userdata('islogin'))
        {
            $id = $this->session->userdata('id');
            $data['user_data'] = $this->Dashboard_model->get_user_by_id($id);
            if($this->input->server('REQUEST_METHOD') == 'POST')
            {
                $this->form_validation->set_rules('current-password', 'Current Password', 'required',
                    array('required' => 'You must provide %s')
                );
                // $this->form_validation->set_rules('new-password', 'New Password', 'required',
                //     array('required' => 'You must provide %s')
                // );
                // $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required',
                //     array('required' => 'You must provide %s')
                // );
                if($this->form_validation->run() == false)
                {
                    return $this->load->view('Change_password_view', $data);
                }
                else
                {
                    $current_password = $this->input->post('current-password');
                    $new_password = $this->input->post('new-password');
                    $confirm_password = $this->input->post('confirm-password');
                    if($data['user_data']['password'] == $current_password)
                    {
                        if($new_password == $confirm_password)
                        {
                            $status = $this->Dashboard_model->change_password($data['user_data']['email'], $new_password);
                            if($status)
                            {
                                $this->session->set_flashdata('password_changed', 'Your password has changed');
                                redirect(base_url('dashboard'));
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata('password_not_changed', 'Your password has not changed');
                            return $this->load->view('Change_password_view', $data);
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('password_not_changed', 'Your password has not changed');
                        return $this->load->view('Change_password_view', $data);
                    }
                }
            }
            $this->load->view('Change_password_view', $data);
        }
        else
        {
            return redirect(base_url('login-view'), 'refresh');
        }
    }

    public function profile_view($id)
    {
        if($this->session->userdata('islogin'))
        {
            $user_id = $this->session->userdata('id');
            $data['user_data'] = $this->Dashboard_model->get_user_by_id($user_id);
            $data['user_profile'] = $this->Dashboard_model->get_user_by_id($id);
            $data['user_education'] = $this->Dashboard_model->get_education($id);
            $this->load->view('Profile_view', $data);
        }
    }

    public function delete_user($id)
    {
        if($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $this->db->trans_start();
            $this->Dashboard_model->delete_userlogin($id);
            $this->Dashboard_model->delete_education($id);
            $this->Dashboard_model->delete_userinfo($id);
            $this->db->trans_complete();
            if ($this->db->trans_status() === true)
            {
                echo json_encode(['status' => 'success']);
            }
            else
            {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('islogin');
        $this->session->unset_userdata('email');
        redirect(base_url('login-view'));
    }
}