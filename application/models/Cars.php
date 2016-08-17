<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends CI_Model {

    /* Cars Crud */

    public function cars_all_data() {
        return $this->db->select('id,color,plate,type,brand,year')
                        ->from('cars')
                        ->order_by('id', 'desc')
                        ->get()
                        ->result();
    }

    public function cars_detail_data($id) {
        return $this->db->select('id,color,plate,type,brand,year')
                        ->from('cars')
                        ->where('id', $id)
                        ->order_by('id', 'desc')
                        ->get()
                        ->row();
    }

    public function cars_create_data($data) {
        $this->db->insert('cars', $data);
        $insert_id = $this->db->insert_id();

        return array('id' => $insert_id);
    }

    public function cars_update_data($id, $data) {
        $this->db->where('id', $id)->update('cars', $data);
    }

    public function cars_delete_data($id) {
        $this->db->where('id', $id)->delete('cars');
    }

}
