<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member/Member_model');
        $this->load->helper('string');
    }

    public function index() {
        $params['success'] = 0;
        $params['message'] = 'Failed';

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $member = $this->Member_model->get();

            $params['data'] = $member;
            $params['success'] = 1;
            $params['message'] = '';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }

}

?>
