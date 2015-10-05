<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member/Member_model');
        $this->load->model('saving/Saving_model');
        $this->load->helper('string');
    }

    public function index() {
        $params['success'] = 0;
        $params['message'] = 'Failed';

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $data['limit'] = 10;
            $data['member_id'] = $this->input->post('id', TRUE);
            if ($this->input->post('id', TRUE) == 'admin') {
                $saving = $this->Saving_model->get(array('limit' => 10));
            } else {
                $saving = $this->Saving_model->get($data);
            }

            $params['data'] = $saving;
            $params['success'] = 1;
            $params['message'] = '';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($params));
    }
    

}

?>
