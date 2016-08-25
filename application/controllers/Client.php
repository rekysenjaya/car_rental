<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    function __contruct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    function _remap($param) {
        $this->index($param);
    }

    public function index($id = null) {
        
        $this->load->model('Client_model');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $resp = $this->Client_model->client_all_data();
            json_output(200, $resp);
        } elseif ($method == 'POST') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            if ($params['name'] == "" || $params['gender'] == "") {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
            } else {
                $respStatus = 200;
                $resp = $this->Client_model->client_create_data($params);
            }
            json_output($respStatus, $resp);
        } elseif ($method == 'PUT') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            if ($params['name'] == "" || $params['gender'] == "") {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
            } else {
                $resp = $this->Client_model->client_update_data($id, $params);
            }
        } elseif ($method == 'DELETE') {
            $resp = $this->Client_model->client_delete_data($id);
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    function json_output($statusHeader, $response) {
        $ci = & get_instance();
        $ci->output->set_content_type('application/json');
        $ci->output->set_status_header($statusHeader);
        $ci->output->set_output(json_encode($response));
    }

}
