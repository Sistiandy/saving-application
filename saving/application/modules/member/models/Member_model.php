<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * member Model Class
 *
 * @package     GROOT
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Member_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    var $table = 'member';

    // Get From Databases
    function get($params = array()) {
        $this->db->select('member.member_id, member_name, member_balance, member_full_name,
            member_phone, member_address, member_password,
            member_input_date, member_last_update');

        if (isset($params['id'])) {
            $this->db->where('member.member_id', $params['id']);
        }

        if (isset($params['name'])) {
            $this->db->where('member.member_name', $params['name']);
        }

        if (isset($params['password'])) {
            $this->db->where('member.member_password', $params['password']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('member_last_update', 'desc');
        }

        $res = $this->db->get('member');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

    function add($data = array()) {

        if (isset($data['member_id'])) {
            $this->db->set('member_id', $data['member_id']);
        }

        if (isset($data['member_name'])) {
            $this->db->set('member_name', $data['member_name']);
        }

        if (isset($data['member_password'])) {
            $this->db->set('member_password', $data['member_password']);
        }

        if (isset($data['member_full_name'])) {
            $this->db->set('member_full_name', $data['member_full_name']);
        }

        if (isset($data['member_phone'])) {
            $this->db->set('member_phone', $data['member_phone']);
        }

        if (isset($data['member_address'])) {
            $this->db->set('member_address', $data['member_address']);
        }

        if (isset($data['member_balance'])) {
            $this->db->set('member_balance', $data['member_balance']);
        }

        if (isset($data['increase_balance'])) {
            $this->db->set('member_balance', 'member_balance +' . $data['increase_balance'], FALSE);
        }

        if (isset($data['decrease_balance'])) {
            $this->db->set('member_balance', 'member_balance -' . $data['decrease_balance'], FALSE);
        }

        if (isset($data['member_input_date'])) {
            $this->db->set('member_input_date', $data['member_input_date']);
        }

        if (isset($data['member_last_update'])) {
            $this->db->set('member_last_update', $data['member_last_update']);
        }

        if (isset($data['member_id'])) {
            $this->db->where('member_id', $data['member_id']);
            $this->db->update('member');
            $id = $data['member_id'];
        } else {
            if (isset($data['edit'])) {
                $this->db->where('member_name', $data['name']);
                $this->db->update('member');
                $id = NULL;
            } else {
                $this->db->insert('member');
                $id = $this->db->insert_id();
            }
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id) {
        $this->db->where('member_id', $id);
        $this->db->delete('member');
    }

}
