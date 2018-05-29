<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Disposisi extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_disposisi');
    }

    function index_get(){
        if ($this->get('api')=="disposisiall") {
            $disposisi = $this->M_disposisi->get_all();
            $this->response($disposisi, REST_Controller::HTTP_OK);
        }elseif ($this->get('api')=="lembardisposisi") {
            # code...
        }
    }

    /*function index_post(){
        if ($this->post('api')=="login") {
            $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
        }
    }*/

}