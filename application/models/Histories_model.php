<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Histories_model extends CI_Model {

    /* Histories */
    /* Rented Car */

    public function histories_rented_car($date) {
        $d = "'$date', 'yyyy-mm-dd'";
        $query = $this->db->query('select cars.brand, cars.type, cars.plate 
                      from rentals 
                        left join cars on cars.id=rentals."car-id" 
                        where  rentals."date-from" <= to_date('.$d.') AND rentals."date-to" >= to_date('.$d.')');

        return $query->result();
    }


    /* Available Car */

    public function histories_free_car($date) {
        $d = "'$date', 'yyyy-mm-dd'";
        $query = $this->db->query('SELECT brand, type, plate FROM cars WHERE id NOT IN (SELECT cars.id
                                    FROM rentals
                                    LEFT JOIN cars ON cars.id=rentals."car-id"
                                    WHERE rentals."date-from" <= to_date('.$d.') and rentals."date-to" >= to_date('.$d.'))');

        return $query->result();
    }

    /* Car */

    public function histories_car_data($id, $year, $month) {
        return $this->db->select('client.name as "rent-by", rentals."date-from", rentals."date-to"')
                        ->from('rentals')
                        ->join('client', 'client.id=rentals."client-id"', 'left')
                        ->where('YEAR(rentals."date-from") = '.$year.' AND MONTH(rentals."date-from") = '.$month.' AND rentals."car-id" = '.$id)
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
        return $this->db->select('cars.brand, cars.type, cars.plate, rentals."date-from", rentals."date-to"')
                        ->from('rentals')
                        ->join('cars', 'cars.id=rentals."car-id"', 'left')
                        ->join('client', 'client.id=rentals."client-id"', 'left')
                        ->where('rentals."client-id" = '.$id)
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
