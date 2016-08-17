<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends CI_Controller {

    function _remap($param){
        $this->index($param);
    }  

    public function index($id = null) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
                    $resp = $this->MyModel->cars_all_data();
                    json_output(200, $resp);
        } elseif ($method == 'POST') {
                    $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['brand'] == "" || $params['type'] == "" || $params['plate'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Brand, Type & Plate can\'t empty');
                    } else {
                        $resp = $this->MyModel->cars_create_data($params);
                    }
                    json_output($respStatus, $resp);
        } elseif ($method == 'PUT') {
                    $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['brand'] == "" || $params['type'] == "" || $params['plate'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Brand, Type & Plate can\'t empty');
                    } else {
                        $resp = $this->MyModel->cars_update_data($id, $params);
                    }
        } elseif ($method == 'DELETE') {
                    $resp = $this->MyModel->cars_delete_data($id);
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    public function rented() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
                    $params = $_GET['date'];
                    $matches = array();
                    preg_match_all('/\{([^}]+)\}/', $params, $matches);
                    $string = $matches[1][0];
                    $date = DateTime::createFromFormat("d-m-Y", $string);
                    $resp = $this->MyModel->histories_rented_car($date->format("Y-m-d"));
                    json_output(200, array('date' => $matches[1][0], 'rented_cars' => $resp));
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}