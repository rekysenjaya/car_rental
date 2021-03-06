<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Histories extends CI_Controller {

    function __contruct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function car($id) {
        
        $this->load->model('Histories_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $params = $_GET['month'];
            $matches = array();
            preg_match_all('/\{([^}]+)\}/', $params, $matches);
            $string = $matches[1][0];
            $date = DateTime::createFromFormat("m-Y", $string);
            $resp = $this->Histories_model->histories_car_data($id, $date->format("Y"), $date->format("m"));
            $car = $this->Histories_model->histories_car($id);
            $this->Json_output_model->json_output(200, array('id' => $car->id, 'brand' => $car->brand, 'type' => $car->type, 'plate' => $car->plate, 'histories' => $resp));
        } else {
            $this->Json_output_model->json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    public function client($id) {
        
        $this->load->model('Histories_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $resp = $this->Histories_model->histories_client_data($id);
            $client = $this->Histories_model->histories_client($id);
            $this->Json_output_model->json_output(200, array('id' => $client->id, 'name' => $client->name, 'gender' => $client->gender, 'histories' => $resp));
        } else {
            $this->Json_output_model->json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}
