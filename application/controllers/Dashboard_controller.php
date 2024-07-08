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
            $email = $this->session->userdata('email');
            $data['user_data'] = $this->Dashboard_model->get_user_by_email($email);
            $this->load->view('New_dashboard', $data);
        }
        else
        {
            return redirect(base_url('login'), 'refresh');
        }
    }

    public function admin_list()
    {
        if($this->session->userdata('islogin'))
        {
            $email = $this->session->userdata('email');
            $data['user_data'] = $this->Dashboard_model->get_user_by_email($email);
            $data['all_user'] = $this->Dashboard_model->all_admin();
            $this->load->view('Datatable_admin_view', $data);
        }
        else
        {
            return redirect(base_url('login'), 'refresh');
        }
    }

    public function senior_list()
    {
        if($this->session->userdata('islogin'))
        {
            $email = $this->session->userdata('email');
            $data['user_data'] = $this->Dashboard_model->get_user_by_email($email);
            $data['all_user'] = $this->Dashboard_model->all_senior();
            $this->load->view('Datatable_senior_view', $data);
        }
        else
        {
            return redirect(base_url('login'), 'refresh');
        }
    }

    public function entry_list()
    {
        if($this->session->userdata('islogin'))
        {
            $email = $this->session->userdata('email');
            $data['user_data'] = $this->Dashboard_model->get_user_by_email($email);
            $data['all_user'] = $this->Dashboard_model->all_entry();
            $this->load->view('Datatable_entry_view', $data);
        }
        else
        {
            return redirect(base_url('login'), 'refresh');
        }
    }

    public function change_password()
    {
        if($this->session->userdata('islogin'))
        {
            $email = $this->session->userdata('email');
            $data['user_data'] = $this->Dashboard_model->get_user_by_email($email);
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
                            echo "password changed";
                        }
                        else
                        {
                            return $this->load->view('Change_password_view', $data);
                        }
                    }
                    else
                    {
                        return $this->load->view('Change_password_view', $data);
                    }
                }
            }
            $this->load->view('Change_password_view', $data);
        }
        else
        {
            return redirect(base_url('login'), 'refresh');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('islogin');
        $this->session->unset_userdata('email');
        return redirect(base_url('login'), 'refresh');
    }
}