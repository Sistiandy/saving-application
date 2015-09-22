<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member/Member_model');
        $this->load->model('user/User_model');
        $this->load->helper('string');
    }

    public function index() {

        $this->output->set_content_type('application/json')->set_output(json_encode(array('Message' => 'Nothing Here')));
    }

    public function login() {
        $params['success'] = 0;
        $params['message'] = 'Username or password incorrect';

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Usename', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {

            $data['name'] = $this->input->post('username', TRUE);
            $data['password'] = sha1($this->input->post('password', TRUE));

            $user = $this->User_model->get($data);
            $member = $this->Member_model->get($data);

            if (count($user) == 1) {
                $arr_res = array(
                    'role' => 'admin',
                    'id' => $user[0]['user_id'],
                    'name' => $user[0]['user_name'],
                    'fullname' => $user[0]['user_full_name'],
                    'email' => $user[0]['user_email'],
                    'description' => $user[0]['user_description'],
                );

                $params['success'] = 1;
                $params['data'] = $arr_res;
                $params['message'] = '';
            } elseif (count($member) == 1) {
                $arr_res = array(
                    'role' => 'member',
                    'id' => $member[0]['member_id'],
                    'name' => $member[0]['member_name'],
                    'fullname' => $member[0]['member_full_name'],
                    'memberBalance' => $member[0]['member_balance'],
                    'createdDate' => $member[0]['member_created_date'],
                );

                $params['success'] = 1;
                $params['data'] = $arr_res;
                $params['message'] = '';
            } else {
                $params['success'] = 0;
                $params['message'] = 'Username or password incorrect';
            };
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

    public function register() {
        $params['success'] = 0;
        $params['message'] = 'Failed';

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Nama', 'trim|required|xss_clean|is_unique[member.member_name]');
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $data['member_name'] = $this->input->post('username', TRUE);
            $data['member_full_name'] = $this->input->post('fullname', TRUE);
            $data['member_password'] = sha1($this->input->post('password', TRUE));
            $data['member_created_date'] = date('Y-m-d H:i:s');
            $this->Member_model->add($data);

//            $params['data'] = array(
//                'fullName' => $data['fullname'],
//            );

            $params['success'] = 1;
            $params['message'] = '';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

}

/* End of file Auth.php */
/* Location: .//Applications/MAMP/htdocs/saving/apiapp/controllers/Auth.php */