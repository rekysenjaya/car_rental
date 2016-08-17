<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Histories_model extends CI_Model {

    /* Histories */
    /* Rented Car */

    public function histories_rented_car($date) {
        return $this->db->select('cars.brand, cars.type, cars.plate')
                        ->from('rentals')
                        ->join('cars', 'cars.id=rentals.car-id', 'left')
                        ->where("rentals.`date-from` <= str_to_date('$date','%Y-%m-%d') AND rentals.`date-to` >= str_to_date('$date','%Y-%m-%d')")
                        ->get()
                        ->result();
    }


    /* Available Car */

    public function histories_free_car($date) {
        $query = $this->db->query("SELECT brand, type, plate FROM cars WHERE id NOT IN (SELECT `cars`.`id`
                                    FROM `rentals`
                                    LEFT JOIN `cars` ON `cars`.`id`=`rentals`.`car-id`
                                    WHERE rentals.`date-from` <= str_to_date('$date','%Y-%m-%d') and rentals.`date-to` >= str_to_date('$date','%Y-%m-%d'))");

        return $query->result();
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

}
