<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Jenis_surat extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_jenis_surat');
    }

    function index_get(){
        if ($this->get('api')=="jenis_suratall") {
            $jenis_surat = $this->M_jenis_surat->get_all();
            $jml_jenis_surat = $this->M_jenis_surat->total_rows();
            $data = array(
                'data'     => $jenis_surat,
                'jml_data' => $jml_jenis_surat
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