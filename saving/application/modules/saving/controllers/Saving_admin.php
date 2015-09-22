<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Saving controllers class
 *
 * @package     GROOT
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Saving_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Saving_model');
        $this->load->model('member/Member_model');
        $this->load->model('activity_log/Activity_log_model');
        $this->load->helper(array('form', 'url'));
    }

    // Saving_customer view in list
    public function index($offset = NULL) {

        $this->load->library('pagination');

        $data['saving'] = $this->Saving_model->get(array('limit' => 10, 'type' => 0, 'offset' => $offset));
        $data['member'] = $this->Member_model->get();
        $data['title'] = 'Daftar Tabungan Masuk';
        $data['main'] = 'saving/saving_list_kredit';
        $config['base_url'] = site_url('admin/saving/index');
        $config['uri_segment'] = 4;
        $config['total_rows'] = count($this->Saving_model->get());
        $this->pagination->initialize($config);

        $this->load->view('admin/layout', $data);
    }

    // Saving_customer view in list
    public function debet($offset = NULL) {

        $this->load->library('pagination');

        $data['saving'] = $this->Saving_model->get(array('limit' => 10, 'type' => 1, 'offset' => $offset));
        $data['member'] = $this->Member_model->get();
        $data['title'] = 'Daftar Tabungan Keluar';
        $data['main'] = 'saving/saving_list_debet';
        $config['base_url'] = site_url('admin/saving/debet');
        $config['uri_segment'] = 4;
        $config['total_rows'] = count($this->Saving_model->get());
        $this->pagination->initialize($config);

        $this->load->view('admin/layout', $data);
    }

    // Add Saving_customer and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('saving_type', 'Tipe', 'required');
        $this->form_validation->set_rules('user_id', 'Penabung', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            if ($this->input->post('saving_id')) {
                $params['saving_id'] = $this->input->post('saving_id');
            } else {
                $params['saving_input_date'] = date('Y-m-d H:i:s');
            }
            $params['saving_date'] = ($this->input->post('saving_date')) ? $this->input->post('saving_date') : date('Y-m-d H:i:s');
            $params['member_id'] = $this->input->post('member_id');
            $params['saving_last_update'] = date('Y-m-d H:i:s');
            $params['saving_type'] = $this->input->post('saving_type');
            if ($this->input->post('saving_type') == 0) {
                $params['saving_kredit'] = $this->input->post('jumlah');
                $params['increase_balance'] = $this->input->post('jumlah');
            } else {
                $params['saving_debet'] = $this->input->post('jumlah');
                $params['decrease_balance'] = $this->input->post('jumlah');
            }
            $status = $this->Saving_model->add($params);

            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Saving',
                        'log_action' => $data['operation'],
                        'log_info' => 'ID:' . $status . ';Tanggal:' . $this->input->post('saving_date')
                    )
            );

            $this->session->set_flashdata('success', $data['operation'] . ' Berhasil');
            redirect('admin/saving');
        } else {
            if ($this->input->post('saving_id')) {
                redirect('admin/saving/edit/' . $this->input->post('saving_id'));
            }

            // Edit mode
            if (!is_null($id)) {
                if ($this->Saving_model->get(array('id' => $id)) == NULL) {
                    redirect('admin/saving');
                } else {
                    $data['saving'] = $this->Saving_model->get(array('id' => $id));
                }
            }
            $data['member'] = $this->Member_model->get();
            $data['title'] = $data['operation'] . ' Tabungan';
            $data['main'] = 'saving/saving_add';
            $this->load->view('admin/layout', $data);
        }
    }

    function detail($id = NULL) {
        if ($this->Saving_model->get(array('id' => $id)) == NULL) {
            redirect('admin/saving');
        }
        $data['saving'] = $this->Saving_model->get(array('id' => $id));
        $data['title'] = 'Detail Tabungan';
        $data['main'] = 'saving/saving_detail';
        $this->load->view('admin/layout', $data);
    }

    // Delete Saving
    public function delete($id = NULL) {
        if ($this->Saving_model->get(array('id' => $id)) == NULL) {
            redirect('admin/saving');
        }
        if ($_POST) {

            $this->Saving_model->delete($this->input->post('del_id'));
            // activity log
            $this->Activity_log_model->add(
                    array(
                        'log_date' => date('Y-m-d H:i:s'),
                        'user_id' => $this->session->userdata('user_id'),
                        'log_module' => 'Saving',
                        'log_action' => 'Delete',
                        'log_info' => 'ID:' . $this->input->post('del_id') . ';Tanggal:' . $this->input->post('del_name')
                    )
            );
            $this->session->set_flashdata('success', 'Delete Tabungan Berhasil');
            redirect('admin/saving');
        } elseif (!$_POST) {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/saving/edit/' . $id);
        }
    }

    function formKredit($id = NULL) {

        if ($_POST) {

            //Add Item Name as array
            $cpt = count($_POST['member_id']);
            for ($i = 0; $i < $cpt; $i++) {
                if ($_POST['member_id'][$i] != '') {

                    $param['member_id'] = $_POST['member_id'][$i];
                    $param['member_last_update'] = date('Y-m-d H:i:s');
                    if ($_POST['saving_kredit'][$i]) {
                        $param['increase_balance'] = $_POST['saving_kredit'][$i];
                    }
                    $this->Member_model->add($param);

                    $user = $this->Member_model->get(array('id' => $_POST['member_id'][$i]));

                    $params['member_id'] = $_POST['member_id'][$i];
                    if ($_POST['saving_kredit'][$i]) {
                        $params['saving_kredit'] = $_POST['saving_kredit'][$i];
                        $params['saving_balance'] = $user['member_balance'];
                        $params['saving_type'] = 0;
                    }
                    $params['user_id'] = $this->session->userdata('user_id');
                    $params['saving_input_date'] = date('Y-m-d H:i:s');
                    $params['saving_last_update'] = date('Y-m-d H:i:s');
                    $params['saving_date'] = ($_POST['saving_date']) ? $_POST['saving_date'] : date('Y-m-d H:i:s');
                    $status = $this->Saving_model->add($params);
                }
            }

            $this->session->set_flashdata('success', 'Tambah Tabungan berhasil');
            redirect('admin/saving');
        } else {
            redirect('admin/saving');
        }
    }

    function formDebet($id = NULL) {

        if ($_POST) {

            //Add Item Name as array
            $cpt = count($_POST['member_id']);
            for ($i = 0; $i < $cpt; $i++) {
                if ($_POST['member_id'][$i] != '') {

                    $param['member_id'] = $_POST['member_id'][$i];
                    $param['member_last_update'] = date('Y-m-d H:i:s');
                    if ($_POST['saving_debet'][$i]) {
                        $param['decrease_balance'] = $_POST['saving_debet'][$i];
                    }
                    $this->Member_model->add($param);

                    $user = $this->Member_model->get(array('id' => $_POST['member_id'][$i]));

                    $params['member_id'] = $_POST['member_id'][$i];
                    if ($_POST['saving_debet'][$i]) {
                        $params['saving_debet'] = $_POST['saving_debet'][$i];
                        $params['saving_balance'] = $user['member_balance'];
                        $params['saving_type'] = 1;
                    }
                    $params['user_id'] = $this->session->userdata('user_id');
                    $params['saving_input_date'] = date('Y-m-d H:i:s');
                    $params['saving_last_update'] = date('Y-m-d H:i:s');
                    $params['saving_date'] = ($_POST['saving_date']) ? $_POST['saving_date'] : date('Y-m-d H:i:s');
                    $status = $this->Saving_model->add($params);
                }
            }

            $this->session->set_flashdata('success', 'Tambah Tabungan berhasil');
            redirect('admin/saving/debet');
        } else {
            redirect('admin/saving/debet');
        }
    }

}

/* End of file saving.php */
/* Location: ./application/controllers/ccp/saving.php */
