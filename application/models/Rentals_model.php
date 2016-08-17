<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rentals_model extends CI_Model {

    /* Rentals Crud */

    public function rentals_all_data() {
        return $this->db->select('rentals.date-from, rentals.date-to, cars.brand, cars.type, cars.plate, client.name')
                        ->from('rentals')
                        ->join('cars', 'cars.id=rentals.car-id', 'left')
                        ->join('client', 'client.id=rentals.client-id', 'left')
                        ->order_by('rentals.id', 'desc')
                        ->get()
                        ->result();
    }

    public function rentals_detail_data($id) {
        return $this->db->select('rentals.date-from, rentals.date-to, cars.brand, cars.type, cars.plate, client.name')
                        ->from('rentals')
                        ->where('rentals.id', $id)
                        ->join('cars', 'cars.id=rentals.car-id', 'left')
                        ->join('client', 'client.id=rentals.client-id', 'left')
                        ->order_by('rentals.id', 'desc')
                        ->get()
                        ->row();
    }

    public function rentals_check($car, $client, $from, $to) {
        return $this->db->select('*')
                        ->from('rentals')
                        ->where("(`date-from` BETWEEN '$from' AND '$to')")
                        ->where("(car-id = $car OR client-id = $client)")
                        ->get()
                        ->result();
    }

    public function rentals_create_data($data) {
        $this->db->insert('rentals', $data);
        $insert_id = $this->db->insert_id();

        return array('id' => $insert_id);
    }

    public function rentals_update_data($id, $data) {
        $this->db->where('id', $id)->update('rentals', $data);
    }

    public function rentals_delete_data($id) {
        $this->db->where('id', $id)->delete('rentals');
    }

}
