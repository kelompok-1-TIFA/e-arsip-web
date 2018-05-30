<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Surat_keluar extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_surat_keluar');
    }

    function index_get(){
        if ($this->get('api')=="suratkeluarall") {
            $surat_keluar = $this->M_surat_keluar->get_all();
            $jml_surat_keluar = $this->M_surat_keluar->total_rows();
            $data = array(
                'data'     => $surat_keluar,
                'jml_data' => $jml_surat_keluar
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif ($this->get('api')=="suratkeluarperbagian") {
            $surat_keluar = $this->M_surat_keluar->get_by_bagian($this->get('id_bagian'));
            $jml_surat_keluar = $this->M_surat_keluar->total_rows_perbagian($this->get('id_bagian'));
            $data = array(
                'data'     => $surat_keluar,
                'jml_data' => $jml_surat_keluar
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }else if ($this->get('api')=="suratkeluardetail") {
            $surat_keluar = $this->M_surat_keluar->get_by_id($this->get('id'));
            $this->response($surat_keluar, REST_Controller::HTTP_OK);
        }
    }

    /*function index_post(){
        if ($this->post('api')=="login") {
            $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
        }
    }*/

}