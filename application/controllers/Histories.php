<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Histories extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function car($id) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                if ($response['status'] == 200) {
                    $params = $_GET['month'];
                    $matches = array();
                    preg_match_all('/\{([^}]+)\}/', $params, $matches);
                    $string = $matches[1][0];
                    $date = DateTime::createFromFormat("m-Y", $string);
                    $resp = $this->MyModel->histories_car_data($id, $date->format("Y"), $date->format("m"));
                    $car = $this->MyModel->histories_car($id);
                    json_output($response['status'], array('id'=>$car->id, 'brand'=>$car->brand, 'type'=>$car->type, 'plate'=>$car->plate, 'histories'=>$resp));
                }
            }
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    public function client($id) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                if ($response['status'] == 200) {
                    $resp = $this->MyModel->histories_client_data($id);
                    $client = $this->MyModel->histories_client($id);
                    json_output($response['status'], array('id'=>$client->id, 'name'=>$client->name, 'gender'=>$client->gender, 'histories'=>$resp));
                }
            }
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}
