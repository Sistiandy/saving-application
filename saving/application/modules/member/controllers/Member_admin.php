<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Member controllers class
 *
 * @package     GROOT
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Member_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Member_model');
        $this->load->model('user/User_model');
        $this->load->model('activity_log/Activity_log_model');
        $this->load->helper(array('form', 'url'));
    }

    // Member_customer view in list
    public function index($offset = NULL) {

        $this->load->library('pagination');

        $data['member'] = $this->Member_model->get(array('limit' => 10, 'offset' => $offset));
        $data['title'] = 'Daftar Anggota';
        $data['main'] = 'member/member_list';
        $config['base_url'] = site_url('member/index');
        $config['total_rows'] = count($this->Member_model->get());
        $this->pagination->initialize($config);

        $this->load->view('admin/layout', $data);
    }

    // Add Member_customer and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');

        if (!$this->input->post('member_id')) {
            $this->form_validation->set_rules('member_name', 'Member Name', 'trim|required|xss_clean|is_unique[member.member_name]');
        }
        $this->form_validation->set_rules('member_full_name', 'Member Full Name', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('member_id')) {
                $params['member_id'] = $this->input->post('member_id');
            } else {
                $params['member_input_date'] = date('Y-m-d H:i:s');
                $params['member_password'] = $this->input->post('member_password');
            }
            $params['member_last_update'] = date('Y-m-d H:i:s');
            $params['member_name'] = $this->input->post('member_name');
            $params['member_full_name'] = $this->input->post('member_full_name');
            $params['member_phone'] = $this->input->post('member_phone');
            $params['member_address'] = $this->input->post('member_address');
            $status = $this->Member_model->add($params);

            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Member',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:' . $status . ';Name:' . $this->input->post('member_name')
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Anggota Berhasil');
            redirect('admin/member');
        } else {
            if ($this->input->post('member_id')) {
                redirect('admin/member/edit/' . $this->input->post('member_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                if ($this->Member_model->get(array('id' => $id)) == NULL) {
                    redirect('admin/member');
                } else {
                    $data['member'] = $this->Member_model->get(array('id' => $id));
                }
            }
            $data['title'] = $data['operation'] . ' Anggota';
            $data['main'] = 'member/member_add';
            $this->load->view('admin/layout', $data);
        }
    }

    function detail($id = NULL, $offset = NULL) {
        $this->load->model('saving/Saving_model');
        $this->load->library('pagination');
        if ($this->Member_model->get(array('id' => $id)) == NULL) {
            redirect('admin/member');
        }
        $data['saving'] = $this->Saving_model->get(array('limit' => 10, 'member_id' => $id, 'offset' => $offset));
        $data['member'] = $this->Member_model->get(array('id' => $id));
        $data['title'] = 'Detail Anggota';
        $data['main'] = 'member/member_detail';
        $config['base_url'] = site_url('admin/member/detail/');
        $config['uri_segment'] = 5;
        $config['total_rows'] = count($this->Saving_model->get(array('member_id' => $id, 'offset' => $offset)));
        $this->pagination->initialize($config);
        
        $this->load->view('admin/layout', $data);
    }

    // Delete Member
    public function delete($id = NULL) {
        if ($this->Member_model->get(array('id' => $id)) == NULL) {
            redirect('admin/member');
        }
        if ($_POST) {

            $this->Member_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Member',
                        'log_action' => 'Delete',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Name:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Delete Anggota Berhasil');
            redirect('admin/member');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/member/edit/' . $id);
        }
    }

}

/* End of file member.php */
/* Location: ./application/controllers/ccp/member.php */
