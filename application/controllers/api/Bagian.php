<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Bagian extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_bagian');
    }

    function index_get(){
        if ($this->get('api')=="bagianall") {
            $bagian = $this->M_bagian->get_all();
            $jml_bagian = $this->M_bagian->total_rows();
            $data = array(
                'data'     => $bagian,
                'jml_data' => $jml_bagian
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /*function index_post(){
        if ($this->post('api')=="mendisposisikan") {
            $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
        }
    }*/

}