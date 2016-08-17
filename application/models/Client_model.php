<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

    /* Client Crud */

    public function client_all_data() {
        return $this->db->select('id,name, gender')
                        ->from('client')
                        ->order_by('id', 'desc')
                        ->get()
                        ->result();
    }

    public function client_detail_data($id) {
        return $this->db->select('id,name, gender')
                        ->from('client')
                        ->where('id', $id)
                        ->order_by('id', 'desc')
                        ->get()
                        ->row();
    }

    public function client_create_data($data) {
        $this->db->insert('client', $data);
        $insert_id = $this->db->insert_id();

        return array('id' => $insert_id);
    }

    public function client_update_data($id, $data) {
        $this->db->where('id', $id)->update('client', $data);
    }

    public function client_delete_data($id) {
        $this->db->where('id', $id)->delete('client');
    }

}
