<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends CI_Controller {

    function __contruct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    function _remap($param) {
        if (ctype_digit($param) == true || $param == 'index') {
            $this->index($param);
        } else {
            if ($param[0] . $param[1] . $param[2] . $param[3] == 'free') {
                $this->free();
            } else {
                $this->rented();
            }
        }
    }

    public function index($id = null) {
    $this->load->helper('json_output');
        $this->load->model('Cars_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $resp = $this->Cars_model->cars_all_data();
            json_output(200, $resp);
        } elseif ($method == 'POST') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            if ($params['brand'] == "" || $params['type'] == "" || $params['plate'] == "") {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Brand, Type & Plate can\'t empty');
            } else {
                $respStatus = 200;
                $resp = $this->Cars_model->cars_create_data($params);
            }
            json_output($respStatus, $resp);
        } elseif ($method == 'PUT') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            if ($params['brand'] == "" || $params['type'] == "" || $params['plate'] == "") {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Brand, Type & Plate can\'t empty');
            } else {
                $resp = $this->Cars_model->cars_update_data($id, $params);
            }
        } elseif ($method == 'DELETE') {
            $resp = $this->Cars_model->cars_delete_data($id);
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    public function rented() {
    $this->load->helper('json_output');
        $this->load->model('Histories_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $params = $_GET['date'];
            $matches = array();
            preg_match_all('/\{([^}]+)\}/', $params, $matches);
            $string = $matches[1][0];
            $date = DateTime::createFromFormat("d-m-Y", $string);
            $resp = $this->Histories_model->histories_rented_car($date->format("Y-m-d"));
            json_output(200, array('date' => $matches[1][0], 'rented_cars' => $resp));
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    public function free() {
    $this->load->helper('json_output');
        $this->load->model('Histories_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $params = $_GET['date'];
            $matches = array();
            preg_match_all('/\{([^}]+)\}/', $params, $matches);
            $string = $matches[1][0];
            $date = DateTime::createFromFormat("d-m-Y", $string);
            $resp = $this->Histories_model->histories_free_car($date->format("Y-m-d"));
            json_output(200, array('date' => $matches[1][0], 'free_cars' => $resp));
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}
