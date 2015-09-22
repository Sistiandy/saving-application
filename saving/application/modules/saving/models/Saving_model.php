<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* saving Model Class
 *
 * @package     GROOT
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */

class Saving_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    var $table = 'saving';
    
    
    // Get From Databases
    function get($params = array())
    {
        $this->db->select('saving.saving_id, saving_date, saving_type, saving_kredit, saving_debet, 
                            member_member_id, member.member_name, member.member_full_name,
                            saving_balance, user_user_id, user.user_name, saving_input_date, saving_last_update'); 
        
        if(isset($params['id']))
        {
            $this->db->where('saving.saving_id', $params['id']);
        }
        
        if(isset($params['member_id']))
        {
            $this->db->where('saving.member_member_id', $params['member_id']);
        }
        
        if(isset($params['type']))
        {
            $this->db->where('saving_type', $params['type']);
        }
        
        if(isset($params['saving_date']))
        {
            $this->db->where('saving.saving_date', $params['saving_date']);
        }
        
        if(isset($params['limit']))
        {
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'desc');
        }
        else
        {
            $this->db->order_by('saving_last_update', 'desc');
        }

        $this->db->join('user', 'user.user_id = saving.user_user_id', 'left');
        $this->db->join('member', 'member.member_id = saving.member_member_id', 'left');
        $res = $this->db->get('saving');

        if(isset($params['id']))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }
    
    function add($data = array()) {
        
         if(isset($data['saving_id'])) {
            $this->db->set('saving_id', $data['saving_id']);
        }
        
         if(isset($data['saving_date'])) {
            $this->db->set('saving_date', $data['saving_date']);
        }
        
         if(isset($data['saving_type'])) {
            $this->db->set('saving_type', $data['saving_type']);
        }
        
         if(isset($data['saving_kredit'])) {
            $this->db->set('saving_kredit', $data['saving_kredit']);
        }
        
         if(isset($data['saving_debet'])) {
            $this->db->set('saving_debet', $data['saving_debet']);
        }
        
         if(isset($data['saving_balance'])) {
            $this->db->set('saving_balance', $data['saving_balance']);
        }
        
         if(isset($data['increase_balance'])) {
            $this->db->set('saving_balance', 'saving_balance +'.$data['increase_balance'], FALSE);
        }
        
         if(isset($data['decrease_balance'])) {
            $this->db->set('saving_balance', 'saving_balance -'.$data['decrease_balance'], FALSE);
        }
        
         if(isset($data['saving_input_date'])) {
            $this->db->set('saving_input_date', $data['saving_input_date']);
        }
        
         if(isset($data['saving_last_update'])) {
            $this->db->set('saving_last_update', $data['saving_last_update']);
        }
        
         if(isset($data['user_id'])) {
            $this->db->set('user_user_id', $data['user_id']);
        }
        
         if(isset($data['member_id'])) {
            $this->db->set('member_member_id', $data['member_id']);
        }
        
        if (isset($data['saving_id'])) {
            $this->db->where('saving_id', $data['saving_id']);
            $this->db->update('saving');
            $id = $data['saving_id'];
        } else {
            $this->db->insert('saving');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    function delete($id) {
        $this->db->where('saving_id', $id);
        $this->db->delete('saving');
    }

}
