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
        if ($method == 'GET' && $id != NULL && $id != 'index') {
            $resp = $this->Client_model->client_detail_data($id);
            $this->Json_output_model->json_output(200, $resp);
        } elseif ($method == 'GET' && $id == 'index') {
            $resp = $this->Client_model->client_all_data();
            $this->Json_output_model->json_output(200, $resp);
        } elseif ($method == 'POST') {
            $params = json_decode(file_get_contents('php://input'), TRUE);
            if ($params['name'] == "" || $params['gender'] == "") {
                $respStatus = 400;
                $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
            } else {
                $respStatus = 200;
                $resp = $this->Client_model->client_create_data($params);
            }
            $this->Json_output_model->json_output($respStatus, $resp);
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
            $this->Json_output_model->json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}
