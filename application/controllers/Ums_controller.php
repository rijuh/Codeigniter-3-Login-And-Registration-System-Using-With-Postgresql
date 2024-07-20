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
                $password = $this->input->post('password');
                $level = $this->input->post('level');

                $user_data = array
                (
                    "fname" => $fname,
                    "mname" => $mname,
                    "lname" => $lname,
                    "age" => $age,
                    "dob" => $dob,
                    "gender" => $gender,
                    "mobile_no" => $mobile_no,
                    "email" => $email,
                    "level" => $level
                );
                $user_id = $this->Ums_model->insert_info($user_data);

                $login_data = array
                (
                    'name' => $fname.' '.$mname.' '.$lname,
                    'email' => $email,
                    'mobile_no' => $mobile_no,
                    'password' => $password,
                    'level' => $level,
                    'user_id' => $user_id
                );
                $islogin_data = $this->Ums_model->insert_login($login_data);

                $exam_name = $this->input->post('exam_name');
                $yop = $this->input->post('yop');
                $inst_name = $this->input->post('inst_name');
                $o_marks = $this->input->post('o_marks');
                $f_marks = $this->input->post('f_marks');

                for($i=0;$i<count($exam_name);$i++)
                {
                    $education_data = [
                        'exam_name' => $exam_name[$i],
                        'yop' => $yop[$i],
                        'inst_name' => $inst_name[$i],
                        'o_marks' => $o_marks[$i],
                        'f_marks' => $f_marks[$i],
                        'user_id' => $user_id
                    ];
                    $this->Ums_model->insert_education($education_data);
                }

                if($islogin_data)
                {
                    $this->session->set_flashdata('success', 'Successfully added');
                }
                return redirect(base_url('Ums_controller/index/'), 'refresh');
            }
        }
        $this->load->view('Register_view');
    }

    private function _create_captcha() {
        $captcha_config = array(
            'img_path'      => './captcha/',
            'img_url'       => base_url() . 'captcha/',
            'img_width'     => '150',
            'img_height'    => 50,
            'expiration'    => 7200,
            'word_length'   => 6,
            'font_size'     => 20,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789', //abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ

            // White background and border, black text and red grid
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        $captcha = create_captcha($captcha_config);

        if ($captcha !== false) {
            $this->session->set_userdata('captchaWord', $captcha['word']);
            return $captcha;
        } else {
            return false;
        }
    }

    public function refresh_captcha() {
        // Generate CAPTCHA
        $captcha = $this->_create_captcha();

        if ($captcha !== false) {
            // Return the new CAPTCHA image and word
            echo json_encode(array('image' => $captcha['image'], 'word' => $captcha['word']));
        } else {
            echo json_encode(array('error' => 'Error generating CAPTCHA.'));
        }
    }

    public function login_view()
    {
        $data['captcha'] = $this->_create_captcha();
        $this->load->view('Login_view', $data);
    }

    public function login_data()
    {
        // $data['captcha'] = $this->_create_captcha();
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
            $this->form_validation->set_rules('captcha', 'Captcha', 'required',
                array('required' => 'You must provide %s')
            );

            if($this->form_validation->run() == false)
            {
                redirect(base_url('login-view'));
                // $this->load->view('Login_view', $data);
            }
            else
            {
                $userCaptcha = $this->input->post('captcha');
                $word = $this->session->userdata('captchaWord');

                if (strcasecmp($userCaptcha, $word) !== 0)
                {
                    $this->session->set_flashdata('captchaerror', 'Captcha did not match.');
                    redirect('login-view');
                }
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                
                $user = $this->Ums_model->login_user($email);
                if($user && $user['password'] == $password)
                {
                    $user_data = array
                    (
                        'id' => $user['user_id'],
                        'email' => $email,
                        'islogin' => true
                    );
                    $this->session->set_userdata($user_data);
                    redirect(base_url('dashboard'));
                    // $this->session->set_flashdata('LoginDone', 'Can not logged in');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Invalid credentials');
                    redirect('login-view');
                }
            }

        }
    }

    public function forgot_password()
    {
        $this->load->view('Forgot_password');
    }

    public function check_user()
    {
            $this->form_validation->set_rules('mobile', 'Mobile No', 'required|numeric|exact_length[10]',
                array(
                    'required' => 'You must provide a %s',
                    'numeric' => '%s should be a number',
                    'exact_length' => '%s contains maximum 10 digits'
                )
            );
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
                array(
                    'required' => 'You must provide a %s',
                    'valid_email' => 'Enter a valid %s'
                )
            );
            if($this->form_validation->run() == false)
            {
                redirect(base_url('forgot-password'));
            }
            else
            {
                $email = $this->input->post('email');
                $mobile = $this->input->post('mobile');
                $check = $this->Ums_model->check_email_mobile($email, $mobile);
                if($check)
                {
                    $data = array
                    (
                        'email' => $email,
                        'mobile' => $mobile
                    );
                    $this->load->view('Reset_password', $data);
                }
                else
                {
                    $this->session->set_flashdata('notFound', 'No user found');
                    $this->load->view('Forgot_password');
                }
            }
    }

    public function reset_password()
    {
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $new_password = $this->input->post('new-password');
        $confirm_password = $this->input->post('confirm-password');
        if($new_password !== $confirm_password)
        {
            $this->session->set_flashdata('notMatched', 'Password not matched');
            redirect(base_url('forgot-password'));
        }
        else
        {
            $data = array('password' => $new_password);
            $status = $this->Ums_model->reset_password($email, $mobile, $data);
            if($status)
            {
                $this->session->set_flashdata('PasswordReset', 'Password has been reset');
                redirect(base_url('login-view'));
            }
            else
            {
                $this->session->set_flashdata('notReset', 'Password not reset');
                redirect(base_url('forgot-password'));
            }
        }
            
    }

    public function send_mail()
    {
        // Generate a random 4-digit code
        $verification_code = rand(1000, 9999);

        // Email configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587, // or 465 for SSL
            'smtp_user' => 'rijuh739@gmail.com',
            'smtp_pass' => 'ycew epnz wogs mcef',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'smtp_crypto' => 'tls'
        );

        $this->email->initialize($config);

        // Email details
        $this->email->from('rijuh739@gmail.com', 'Riju');
        $this->email->to('bidisaadak@gmail.com'); // Replace with the recipient's email
        $this->email->subject('Your Verification Code');
        $this->email->message('Your verification code is: ' . $verification_code);

        // Send email
        if ($this->email->send())
        {
            echo 'Verification code sent successfully.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
    }

    public function new_forgot_password()
    {
        $this->load->view('Forgot_password_new');
    }
}