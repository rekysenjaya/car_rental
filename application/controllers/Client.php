<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    function _remap($param){
        $this->index($param);
    }  

    public function index($id = null) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
                    $resp = $this->MyModel->client_all_data();
                    json_output(200, $resp);
        } elseif ($method == 'POST') {
                    $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['name'] == "" || $params['gender'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
                    } else {
                        $resp = $this->MyModel->client_create_data($params);
                    }
                    json_output($respStatus, $resp);
        } elseif ($method == 'PUT') {
                    $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['name'] == "" || $params['gender'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
                    } else {
                        $resp = $this->MyModel->client_update_data($id, $params);
                    }
        } elseif ($method == 'DELETE') {
                    $resp = $this->MyModel->client_delete_data($id);
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

}
