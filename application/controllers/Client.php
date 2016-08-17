<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        /*
          $check_auth_client = $this->MyModel->check_auth_client();
          if($check_auth_client != true){
          die($this->output->get_output());
          }
         */
    }

    public function index() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'GET') {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                if ($response['status'] == 200) {
                    $resp = $this->MyModel->client_all_data();
                    json_output($response['status'], $resp);
                }
            }
        } elseif ($method == 'POST') {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                $respStatus = $response['status'];
                if ($response['status'] == 200) {
                    $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['name'] == "" || $params['gender'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
                    } else {
                        $resp = $this->MyModel->client_create_data($params);
                    }
                    json_output($respStatus, $resp);
                }
            }
        } else {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
    }

    public function detail($id) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                if ($response['status'] == 200) {
                    $resp = $this->MyModel->client_detail_data($id);
                    json_output($response['status'], $resp);
                }
            }
        }
    }

    public function update($id) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                $respStatus = $response['status'];
                if ($response['status'] == 200) {
                    $params = json_decode(file_get_contents('php://input'), TRUE);
                    if ($params['name'] == "" || $params['gender'] == "") {
                        $respStatus = 400;
                        $resp = array('status' => 400, 'message' => 'Name & Gender can\'t empty');
                    } else {
                        $resp = $this->MyModel->client_update_data($id, $params);
                    }
//                    json_output($respStatus, $resp);
                }
            }
        }
    }

    public function delete($id) {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->MyModel->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->MyModel->auth();
                if ($response['status'] == 200) {
                    $resp = $this->MyModel->client_delete_data($id);
//                    json_output($response['status'], $resp);
                }
            }
        }
    }

}
