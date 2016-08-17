<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {

    /* Histories */
    /* Rented Car */

    public function histories_rented_car($date) {
        return $this->db->select('cars.brand, cars.type, cars.plate')
                        ->from('rentals')
                        ->join('cars', 'cars.id=rentals.car-id', 'left')
                        ->where("rentals.date-from between $date and ADDDATE('$date', INTERVAL 3 DAY)")
                        ->get()
                        ->result();
    }

    /* Car */

    public function histories_car_data($id, $year, $month) {
        return $this->db->select('client.name as rent-by, rentals.date-from, rentals.date-to')
                        ->from('rentals')
                        ->join('client', 'client.id=rentals.client-id', 'left')
                        ->where("YEAR(rentals.`date-from`) = $year AND MONTH(rentals.`date-from`) = $month AND rentals.car-id = $id")
                        ->get()
                        ->result();
    }

    public function histories_car($id) {
        return $this->db->select('*')
                        ->from('cars')
                        ->where("id = $id")
                        ->get()
                        ->row();
    }

    /* Client */

    public function histories_client_data($id) {
        return $this->db->select('cars.brand, cars.type, cars.plate, rentals.date-from, rentals.date-to')
                        ->from('rentals')
                        ->join('cars', 'cars.id=rentals.car-id', 'left')
                        ->join('client', 'client.id=rentals.client-id', 'left')
                        ->where("rentals.client-id = $id")
                        ->get()
                        ->result();
    }

    public function histories_client($id) {
        return $this->db->select('*')
                        ->from('client')
                        ->where("id = $id")
                        ->get()
                        ->row();
    }

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
                        ->where("(`date-from` BETWEEN '2016-08-12' AND '2016-08-14')")
                        ->where('date-from <=', "$to")
                        ->where('date-to >=', "$from")
                        ->where('date-to <=', "$to")
                        ->where('car-id =', "$car")
                        ->or_where('client-id =', "$client")
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

    public function auth() {
//        $users_id  = $this->input->get_request_header('User-ID', TRUE);
//        $token     = $this->input->get_request_header('Authorization', TRUE);
//        $q  = $this->db->select('expired_at')->from('users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
//        if($q == ""){
//            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
//        } else {
//            if($q->expired_at < date('Y-m-d H:i:s')){
//                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
//            } else {
//                $updated_at = date('Y-m-d H:i:s');
//                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
//                $this->db->where('users_id',$users_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
        return array('status' => 200, 'message' => 'Authorized.');
//            }
//        }
    }

}
