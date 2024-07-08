<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ums_controller extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model("Ums_model");
		$this->load->library('form_validation');
    }

    public function index()
    {  
        return $this->load->view('Register_view');
    }

    public function insert_data()
    {
        if($this->input->server('REQUEST_METHOD') == 'POST')
		{
            $this->form_validation->set_rules('fname', 'First Name', 'required',
                array('required' => 'You must provide a %s')
            );
            $this->form_validation->set_rules('lname', 'Last Name', 'required',
                array('required' => 'You must provide a %s')
            );
            $this->form_validation->set_rules('age', 'Age', 'required|numeric|max_length[2]',
                array(
                    'required' => 'You must provide a %s',
                    'numeric' => '%s should be a number',
                    'max_length' => '%s contains maximum 2 digits'
                )
            );
            $this->form_validation->set_rules('dob', 'DOB', 'required',
                array('required' => 'You must provide a %s')
            );
            $this->form_validation->set_rules('gender', 'Gender', 'required',
                array('required' => 'You must provide a %s')
            );
            $this->form_validation->set_rules('mobile', 'Mobile No', 'required|numeric|exact_length[10]',
                array(
                    'required' => 'You must provide a %s',
                    'numeric' => '%s should be a number',
                    'exact_length' => '%s contains maximum 10 digits'
                )
            );
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[userinfo.email]',
                array(
                    'required' => 'You must provide a %s',
                    'valid_email' => 'Enter a valid %s',
                    'is_unique' => '%s already exsist'
                )
            );

            if($this->form_validation->run() == FALSE)
            {
                return $this->load->view('Register_view');
            }
            else
            {
                $fname = $this->input->post('fname');
                $mname = $this->input->post('mname');
                $lname = $this->input->post('lname');
                $age = $this->input->post('age');
                $dob = $this->input->post('dob');
                $gender = $this->input->post('gender');
                $mobile_no = $this->input->post('mobile');
                $email = $this->input->post('email');

                $data = array
                (
                    "fname" => $fname,
                    "mname" => $mname,
                    "lname" => $lname,
                    "age" => $age,
                    "dob" => $dob,
                    "gender" => $gender,
                    "mobile_no" => $mobile_no,
                    "email" => $email,
                );
                $status = $this->Ums_model->insert_data($data);
                if($status == true)
                {
                    $this->session->set_flashdata('success', 'Successfully added');
                }
                return redirect(base_url('Ums_controller/index/'), 'refresh');
            }
        }
        $this->load->view('Register_view');
    }

    public function login_data()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
                array
                (
                    'required' => 'You must provide %s',
                    'valid_email' => 'Enter a valid %s'
                )
            );
            $this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'You must provide %s')
            );

            if($this->form_validation->run() == false)
            {
                return $this->load->view('Login_view');
            }
            else
            {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user = $this->Ums_model->login_user($email);
                if($user && $user['password'] == $password)
                {
                    $user_data = array
                    (
                        'email' => $email,
                        'islogin' => true
                    );
                    $this->session->set_userdata($user_data);
                    return redirect(base_url('dashboard'), 'refresh');
                    // $this->session->set_flashdata('LoginDone', 'Can not logged in');
                }
                else
                {
                    $this->session->set_flashdata('LoginFailed', 'Can not logged in');
                }
            }

        }
        $this->load->view('Login_view');
    }

    // public function dashboard()
    // {
    //     $data['all_data'] = $this->Ums_model->get_data();
    //     $this->load->view('Dashboard_view', $data);
    // }

    // public function new_dashboard()
    // {
    //     $this->load->view('New_dashboard');
    // }
}