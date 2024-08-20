<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Home_Model');
    }
    public function register()
    {
        $this->load->view('signup');
    }
    public function sign_up()
    {
        //Form Validation
        $this->form_validation->set_rules('firstname', 'First Name', 'required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|alpha');
        $this->form_validation->set_rules('emailid', 'EmailId', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_message('is_unique', 'This email is already exists.');
        if ($this->form_validation->run()) {
            $fname = $this->input->post('firstname');
            $lname = $this->input->post('lastname');
            $emailid = $this->input->post('emailid');
            $password = $this->input->post('password');
            $this->Home_Model->index($fname, $lname, $emailid, $password);
        } else {
            $this->load->view('signup');
        }
    }
    public function login()
    {
        $this->load->view('signin');
    }
    public function logout()
    {
        $this->session->unset_userdata(array('uid', 'fname'));
        redirect(base_url('login'));
    }
    public function select_course()
    {
        if (isset($_SESSION['uid']) && isset($_SESSION['uid']) != '') {
            $data['course'] = $this->Home_Model->get_course();
            $data['users'] = $this->Home_Model->get_user_details($_SESSION['uid']);
            $data['applied_course'] = $this->Home_Model->get_applied_course($_SESSION['uid']);
            $this->load->view('course', $data);
        } else {
            redirect('login');
        }
    }
    public function login_check()
    {
        //Validation for login form
        $this->form_validation->set_rules('emailid', 'Email id', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run()) {
            $email = $this->input->post('emailid');
            $password = $this->input->post('password');
            $validate = $this->Home_Model->signin($email, $password);
            if ($validate) {
                $this->session->set_userdata('uid', $validate->id);
                $this->session->set_userdata('fname', $validate->name);
                $user_id = $validate->id;
                $applied_course = $this->Home_Model->get_applied_course($user_id);
                if (isset($applied_course) && !empty($applied_course)) {
                    redirect('user-view');
                } else {
                    redirect('user-details');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid login details.Please try again.');
                $this->load->view('signin');
            }
        } else {
            $this->load->view('signin');
        }
    }
    public function user_view()
    {
        if (isset($_SESSION['uid']) && isset($_SESSION['uid']) != '') {
            $data['user_det'] = '';
            $user_id =  $_SESSION['uid'];
            $userdetails = $this->Home_Model->get_user($user_id);
            $applied_course = $this->Home_Model->get_applied_course($user_id);
            $course_details = $this->Home_Model->user_applied_course($applied_course->course_id);
            if (isset($course_details) && $course_details != '') {
                $data['course_details'] = $course_details;
            }
            if (isset($userdetails) && $userdetails != '') {
                $data['user_det'] = $userdetails;
            }
            if (isset($applied_course) && $applied_course != '') {
                $data['applied_course'] = $applied_course;
            }
            $this->load->view('user_view', $data);
        } else {
            redirect('login');
        }
    }
    public function user_details()
    {
        if (isset($_SESSION['uid']) && isset($_SESSION['uid']) != '') {
            $data['user_det'] = '';
            $user_id =  $_SESSION['uid'];
            $userdetails = $this->Home_Model->get_user($user_id);
            if (isset($userdetails) && $userdetails != '') {
                $data['user_det'] = $userdetails;
            }
            $this->load->view('user_details_form', $data);
        } else {
            redirect('login');
        }
    }
    public function apply_course()
    {
        if (isset($_SESSION['uid']) && isset($_SESSION['uid']) != '') {
            $this->form_validation->set_rules('course', 'Course', 'required');
            if ($this->form_validation->run()) {
                $this->db->where('user_id', $_SESSION['uid']);
                $query = $this->db->get('applied_course');
                if ($query->num_rows() > 0) {
                    $data = array(
                        'course_id'      => $this->input->post('course'),
                        'status'      => 'Pending',
                    );
                    $this->db->where('user_id', $_SESSION['uid']);
                    $this->db->update('applied_course', $data);
                    $this->session->set_flashdata('success', 'Your course has been successfully applied');
                    redirect('user-view');
                } else {
                    $data = array(
                        'user_id' => $_SESSION['uid'],
                        'course_id' => $this->input->post('course'),
                        'status'      => 'Pending',
                    );
                    $this->Home_Model->insert_applied_course($data);
                }
                $this->load->view('user_details_form');
            } else {
                $this->select_course();
            }
        } else {
            redirect('login');
        }
    }
    public function user_form_details()
    {
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|max_length[15]|min_length[8]');
        $this->form_validation->set_rules('country', 'Country Name', 'required|alpha');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('computer', 'computer', 'required|numeric');
        $this->form_validation->set_rules('biology', 'biology', 'required|numeric');
        $this->form_validation->set_rules('accounts', 'accounts', 'required|numeric');
        $this->form_validation->set_rules('maths', 'maths', 'required|numeric');
        $this->form_validation->set_rules('school_img_in', 'Document', 'required');
        $this->form_validation->set_rules('high_school_img_in', 'Document', 'required');
        $this->form_validation->set_message('is_unique', 'This email is already exists.');
        if ($this->form_validation->run()) {
            $data = array(
                'user_id' => $_SESSION['uid'],
                'phone' => $this->input->post('phone'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'dob' => $this->input->post('dob'),
                'computer' => $this->input->post('computer'),
                'biology' => $this->input->post('biology'),
                'accounts' => $this->input->post('accounts'),
                'maths' => $this->input->post('maths'),
                'certificate_1' => $this->input->post('school_img_in'),
                'certificate_2' => $this->input->post('high_school_img_in'),
            );
            $this->Home_Model->inser_user_data($data);
        } else {
            if ($this->input->post('school_img_in') == '') {
                $this->session->set_flashdata('highschool', 'The Document field is required.');
            }
            if ($this->input->post('high_school_img_in') == '') {
                $this->session->set_flashdata('high_sec', 'The Document field is required.');
            }
            $this->user_details();
        }
    }
    public function edit_form_details()
    {
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|max_length[15]|min_length[8]');
        $this->form_validation->set_rules('country', 'Country Name', 'required|alpha');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('computer', 'computer', 'required|numeric');
        $this->form_validation->set_rules('biology', 'biology', 'required|numeric');
        $this->form_validation->set_rules('accounts', 'accounts', 'required|numeric');
        $this->form_validation->set_rules('school_img_in', 'Document', 'required');
        $this->form_validation->set_rules('high_school_img_in', 'Document', 'required');
        $this->form_validation->set_rules('maths', 'maths', 'required|numeric');
        $this->form_validation->set_message('is_unique', 'This email is already exists.');
        if ($this->form_validation->run()) {
            $data = array(
                'user_id' => $_SESSION['uid'],
                'phone' => $this->input->post('phone'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'dob' => $this->input->post('dob'),
                'computer' => $this->input->post('computer'),
                'biology' => $this->input->post('biology'),
                'accounts' => $this->input->post('accounts'),
                'maths' => $this->input->post('maths'),
                'certificate_1' => $this->input->post('school_img_in'),
                'certificate_2' => $this->input->post('high_school_img_in'),
            );
            $this->Home_Model->update_user_data($this->input->post('id'), $data);
            // $this->load->view('user_details_form');
        } else {
            if ($this->input->post('school_img_in') == '') {
                $this->session->set_flashdata('highschool', 'The Document field is required.');
            }
            if ($this->input->post('high_school_img_in') == '') {
                $this->session->set_flashdata('high_sec', 'The Document field is required.');
            }
            $this->user_details();
        }
    }
    public function image_upload()
    {
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            // Specify the directory where you want to save the uploaded file 
            $target_directory = 'uploads/';
            $datas['status'] = 0;
            // Move the uploaded file to the target directory 
            $target_file = $target_directory . time() . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                $datas['msg'] = 'File uploaded successfully!';
                $datas['status'] = 1;
            } else {
                $datas['msg'] = 'Error uploading file.';
            }
        } else {
            $datas['msg'] =  'No file sent.';
        }
        $datas['img'] = base_url() . $target_file;
        echo json_encode($datas);
    }
}
