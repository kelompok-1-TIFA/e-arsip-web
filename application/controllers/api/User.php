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
                            'level_user'    => $cek_fase_2->level_user,
                        );
                        $message = array("success"=>1,"data_user"=>$cek_fase_2);
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
        }
    }


    
    
    function index_put(){
        $id = $this->put('id');
        $data = $this->put('data');
        $token = $this->put('token');
        $lat = $this->put('lat');
        $lang = $this->put('lang');
        $where = array('id_user' => $id, );
        $user_detail = $this->M_user->get_by_id($id);
        if ($this->M_user->cek_user($where)->num_rows() > 0) {
            if($user_detail->token != $token){
                $this->response(['kode' => 0,'pesan' =>'Anda tidak memiliki akses!'], REST_Controller::HTTP_OK);
            }else{
                if ($data=="lokasi") {
                    $data = array(
                        'lat' => $lat,
                        'lang' => $lang,
                    );
                    $this->M_user->update($id, $data);
                    $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
                }elseif($data=="editprofile"){
                    $data = array(
                        'nama' => $this->input->put('nama'),
                        'alamat' => $this->input->put('alamat'),
                        'email' => $this->input->put('email'),
                        'no_hp' => $this->input->put('no_hp'),
                    );
                    $this->M_user->update($id, $data);
                    $this->response(['kode' => 1,'pesan' =>'Data berhasil diupdate!'], REST_Controller::HTTP_OK);
                }
            }
        }else{
            $this->response([
                'kode' => 0,
                'pesan' =>'Data kosong!'
            ], REST_Controller::HTTP_OK);
            
        }
    }
}