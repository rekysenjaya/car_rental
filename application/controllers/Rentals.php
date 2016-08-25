<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rentals extends CI_Controller {

    function __contruct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    function _remap($param) {
        $this->index($param);
    }

    public function index($id = null) {
        $this->load->helper('json_output');
        $this->load->model('Rentals_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $resp = $this->Rentals_model->rentals_all_data();
            json_output(200, $resp);
        } elseif ($method == 'POST') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            $day = $params['date-from'];
            $pDate = strtotime("$day + 3 day");
            $max3day = date('Y-m-d', $pDate);
            if ($max3day <= $params['date-to']) {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Max rent 3 day.');
            } else {
                $resp = $this->Rentals_model->rentals_check($params['car-id'], $params['client-id'], $params['date-from'], $params['date-to']);
                if ($resp != null) {
                    $respStatus = 400;
                    $resp = array('status' => 400, 'message' => 'Cars on rent.');
                } else {
                    if ($params['car-id'] == "" || $params['client-id'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Car id & Client id can\'t empty');
                    } else {
                        $respStatus = 200;
                        $resp = $this->Rentals_model->rentals_create_data($params);
                    }
                }
            }
            json_output($respStatus, $resp);
        } elseif ($method == 'PUT') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            if ($params['car-id'] == "" || $params['client-id'] == "") {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Car id & Client id can\'t empty');
            } else {
                $resp = $this->Rentals_model->rentals_update_data($id, $params);
            }
        } elseif ($method == 'DELETE') {
            $resp = $this->Rentals_model->rentals_delete_data($id);
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}
