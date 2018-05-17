<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Surat_masuk extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_surat_masuk');
    }

    function index_get(){
        if ($this->get('api')=="suratmasukall") {
            $surat_masuk = $this->M_surat_masuk->get_all();
            $this->response($surat_masuk, REST_Controller::HTTP_OK);
        }else if ($this->get('api')=="suratmasukdetail") {
            $surat_masuk = $this->M_surat_masuk->get_by_id($this->get('id'));
            $this->response($surat_masuk, REST_Controller::HTTP_OK);
        }
    }

    /*function index_post(){
        if ($this->post('api')=="login") {
            $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
        }
    }*/

}