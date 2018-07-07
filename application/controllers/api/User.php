<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_pegawai');
    }

    function index_post(){
        $api=$this->post('api');
        if ($api=="login") {
            $username = $this->post('user');
            $password = $this->post('pass');
            $where = array('username' => $username, );
            $cek_fase_1 = $this->M_user->cek_login($where)->num_rows();
            $cek_fase_2 = $this->M_user->cek_login($where)->row();
            if($cek_fase_1 > 0){
                if ($cek_fase_2->level_user=="admin") {
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
                            'token'         => $cek_fase_2->token,
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
        }else if ($api=="editprofile") {
            $data = array(
                'nama'          => $this->post('nama'),
                'tempat_lahir'  => $this->post('tempat_lahir'),
                'tgl_lahir'     => $this->post('tgl_lahir'),
                'alamat'        => $this->post('alamat'),
                'no_hp'         => $this->post('no_hp')
            );
            $res = $this->M_pegawai->update($this->post('id'),$data);
            if($res>=0){
                $this->response(['kode' => 1,'data' => $res], REST_Controller::HTTP_OK);
            }else{
                $this->response(['kode' => 2,'pesan' =>'Proses Gagal'], REST_Controller::HTTP_OK);
            }
        }else if ($api=="ubahpassword"){
            $this->load->library('encrypt'); 
            $key = 'vyanarypratamabanyuwangi12345678';
            $password_encrypt =  $this->encrypt->encode($this->post('password_baru'), $key);
            $data = array(
                'password'  => $password_encrypt,
            );
            $res = $this->M_user->update($this->post('id'),$data);
            if($res>=0){
                $this->response(['kode' => 1,'data' => $res], REST_Controller::HTTP_OK);
            }else{
                $this->response(['kode' => 2,'pesan' =>'Proses Gagal'], REST_Controller::HTTP_OK);
            }
        }else if($api=="ubahfoto"){
            $tgl_sekarang=date("ymdHis");
            $path="assets/uploads/foto_user/".$this->post('id')."_".$tgl_sekarang.".jpeg";
            if (file_put_contents($path, base64_decode($this->post('foto')))) {
                $data = array(
                    'foto'  => $path,
                );
                $res = $this->M_pegawai->update($this->post('id'),$data);
                if($res>=0){
                    $this->response(['kode' => 1,'urlFoto' => $path], REST_Controller::HTTP_OK);
                }else{
                    $this->response(['kode' => 2,'pesan' =>'Proses Gagal'], REST_Controller::HTTP_OK);
                }   
            }else{
                $this->response(['kode' => 2,'pesan' =>'Proses Gagal'], REST_Controller::HTTP_OK);
            }
            
        }else if ($api=="retoken") {
            $data = array(
                'token'  => $this->post('token')
            );
            $res = $this->M_user->update($this->post('id'),$data);
            if($res>=0){
                $this->response(['kode' => 1], REST_Controller::HTTP_OK);
            }else{
                $this->response(['kode' => 2,'pesan' =>'Proses Gagal'], REST_Controller::HTTP_OK);
            }
            echo "string";
        }
    }
    
    function index_get(){
        if ($this->get('api')=="profile") {
            $row = $this->M_pegawai->get_by_id($this->get('id'));
            $this->load->library('encrypt'); 
            $key = 'vyanarypratamabanyuwangi12345678';
            $password_decrypt =  $this->encrypt->decode($row->password, $key);
            if ($row) {
                $data = array(
                    'nip'                   => $row->nip,
                    'id_bagian_pegawai'     => $row->id_bagian_pegawai,
                    'bagian'                => $row->bagian,
                    'id_jabatan_pegawai'    => $row->id_jabatan_pegawai,
                    'niap'                  => $row->niap,
                    'nama'                  => $row->nama,
                    'jenis_kelamin'         => $row->jenis_kelamin,
                    'tempat_lahir'          => $row->tempat_lahir,
                    'tgl_lahir'             => $row->tgl_lahir,
                    'agama'                 => $row->agama,
                    'pangkat'               => $row->pangkat,
                    'alamat'                => $row->alamat,
                    'no_hp'                 => $row->no_hp,
                    'pendidikan_terakhir'   => $row->pendidikan_terakhir,
                    'sk_pengangkatan'       => $row->sk_pengangkatan,
                    'foto'                  => $row->foto,
                    'username'              => $row->username,
                    'password'              => $password_decrypt,
                    'level_user'            => $row->level_user,
                );
                $this->response($data, REST_Controller::HTTP_OK);   
            }
        }
    }
}