<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
    }

    function index_post(){
        if ($this->post('api')=="login") {
            $username = $this->post('user');
            $password = $this->post('pass');
            $where = array('username' => $username, );
            $cek_fase_1 = $this->M_user->cek_login($where)->num_rows();
            $cek_fase_2 = $this->M_user->cek_login($where)->row();
            if($cek_fase_1 > 0){
                if ($cek_fase_2->level_user=="admin" OR $cek_fase_2->level_user=="sekertaris") {
                    $message = array("success"=>3);
                    $this->response($message, REST_Controller::HTTP_OK);   
                }else{
                    $this->load->library('encrypt'); 
                    $key = 'vyanarypratamabanyuwangi12345678';
                    $password_encrypt =  $this->encrypt->decode($cek_fase_2->password, $key);
                    if ($password==$password_encrypt) {
                        $data_session = array(
                            'id_user'       => $cek_fase_2->id_user,
                            'nip'           => $cek_fase_2->nip,
                            'nama'          => $cek_fase_2->nama,
                            'foto'          => $cek_fase_2->foto,
                            'id_bagian'     => $cek_fase_2->id_bagian_pegawai,
                            'jabatan'       => $cek_fase_2->jabatan,
                            'bagian'        => $cek_fase_2->bagian,
                            'level_user'    => $cek_fase_2->level_user,
                        );
                        $message = array("success"=>1,"data_user"=>$data_session);
                        $this->response($message, REST_Controller::HTTP_OK);
                    }else{
                        $message = array("success"=>2);
                        $this->response($message, REST_Controller::HTTP_OK);
                    }
                }
            }else{
                $message = array("success"=>3);
                $this->response($message, REST_Controller::HTTP_OK);   
            }
        }elseif (condition) {
            # code...
        }
    }


    
    
    function index_put(){
       
    }
}