<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Notifikasi extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_notifikasi');
    }

    function index_get(){
        if ($this->get('api')=="notifikasi") {
            $id_user_login=$this->get('id_user');
            $notifikasi = $this->M_notifikasi->get_where("WHERE id_user='$id_user_login' ORDER BY id_notif DESC")->result();
            $jml_notifikasi = $this->M_notifikasi->get_where("WHERE id_user='$id_user_login' ORDER BY id_notif DESC")->num_rows();;
            $data = array(
                'data'     => $notifikasi,
                'jml_data' => $jml_notifikasi
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif ($this->get('api')=="lihat") {
            $id_notif=$this->get('id_notif');
            $this->M_notifikasi->delete($id_notif);
        }
    }

    /*function index_post(){
        if ($this->post('api')=="login") {
            $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
        }
    }*/

}