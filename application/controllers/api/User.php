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

    function index_get(){
        $data = $this->get('data');
        $email = $this->get('email');
        $pass = $this->get('pass');
        $id=$this->get('id');
        $kendaraan=$this->get('kendaraan');
        $token = $this->get('token');

        $where = array('email' => $email, );

        if ($data == "login") {
            if ($this->M_user->cek_user($where)->num_rows() > 0) {
                $cek_pass = $this->M_user->cek_user($where)->row();
                if ($this->M_auth->check_auth_client()!=TRUE) {
                    $message = array("status"=>401, "pesan"=>"Maaf anda tidak dapat mengakses aplikasi ini!");
                    $this->response($message, 401);
                }else{
                    $this->load->library('encrypt'); 
                    $key = 'vyanarypratamabanyuwangi12345678';
                    $password_encrypt=$this->encrypt->decode($cek_pass->password, $key);
                    if ($password_encrypt == $pass) {
                        $response=$this->M_auth->auth();
                        $user_detail = $this->M_user->cek_user($where)->row();
                        if ($response['status']==200) {
                            $message = array("kode"=>1,"id"=>$user_detail->id_user, "token"=>$user_detail->token, "pesan"=>"Berhasil Login!");
                            $this->response($message, REST_Controller::HTTP_OK);
                            return TRUE;
                        }else{
                            $this->response($response);
                        }
                    }else{
                        $message = array("status"=>401,"pesan"=>"Password anda salah!");
                        $this->response($message, 401);
                    }
                }
            }else{
                $message = array("status"=>401, "pesan"=>"Maaf email anda salah!");
                $this->response($message, 401);
            }
        }elseif($data=="detail"){
                $user_detail = $this->M_user->get_by_id($id);
                if ($user_detail=="") {
                     $this->response([
                        'kode' => 0,
                        'pesan' =>'Data kosong!'
                    ], REST_Controller::HTTP_OK);
                }else{
                    if($user_detail->token != $token){
                        $this->response(['kode' => 0,'pesan' =>'Anda tidak memiliki akses!'], REST_Controller::HTTP_OK);
                    }else{
                        if ($user_detail->kategori=="driver") {
                            $kendaraan_detail = $this->M_kendaraan->get_by_userid($user_detail->id_user);
                            $foto_kendaraan = explode(" ", $kendaraan_detail->foto_kendaraan);
                            $this->response([
                                'kode' => 1,
                                'id_user'=> $user_detail->id_user,
                                'nama'=> $user_detail->nama,
                                'alamat'=> $user_detail->alamat,
                                'tgl_lahir'=> $user_detail->tgl_lahir,
                                'email'=> $user_detail->email,
                                'no_hp'=> $user_detail->no_hp,
                                'foto_user'=> $user_detail->foto_user,
                                'lat'=> $user_detail->lat,
                                'lag'=> $user_detail->lang,
                                'ket'=> $user_detail->ket,
                                'date'=> $user_detail->date,
                                'saldo'=> $user_detail->saldo,
                                'id_kendaraan' => $kendaraan_detail->id_kendaraan,
                                'merk' => $kendaraan_detail->merk,
                                'model' => $kendaraan_detail->model,
                                'warna' => $kendaraan_detail->warna,
                                'tahun' => $kendaraan_detail->tahun,
                                'plat' => $kendaraan_detail->plat,
                                'wilayah' => $kendaraan_detail->wilayah,
                                'foto_kendaraan' => $foto_kendaraan,
                                'pesan' =>'Data tidak kosong!'
                            ], REST_Controller::HTTP_OK);
                        }else{
                            $this->response([
                                'kode' => 1,
                                'id_user'=> $user_detail->id_user,
                                'nama'=> $user_detail->nama,
                                'alamat'=> $user_detail->alamat,
                                'tgl_lahir'=> $user_detail->tgl_lahir,
                                'email'=> $user_detail->email,
                                'no_hp'=> $user_detail->no_hp,
                                'foto_user'=> $user_detail->foto_user,
                                'lat'=> $user_detail->lat,
                                'lag'=> $user_detail->lang,
                                'ket'=> $user_detail->ket,
                                'date'=> $user_detail->date,
                                'saldo'=> $user_detail->saldo,
                                'pesan' =>'Data tidak kosong!'
                            ], REST_Controller::HTTP_OK);
                        }
                    }
                }
        }elseif ($data=="driver") {
            $driver_detail = $this->M_user->get_by_kat('driver');
            $this->response([
                'kode' => 1,
                'result' => $driver_detail,
                'pesan' =>'Data tidak kosong!'
            ], REST_Controller::HTTP_OK);
        }
    }

    function index_post(){
        $data = $this->post('data');
        $this->load->library('encrypt'); 
        $key = 'vyanarypratamabanyuwangi12345678';
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $email = $this->input->post('email');
        $password =  $this->encrypt->encode($this->input->post('password'), $key);
        $no_hp = $this->input->post('no_hp');
        $tanggal = date("Y/m/d");
        $token=$this->post('token');

        $where = array('email' => $email, );
        
        if ($this->M_user->cek_user($where)->num_rows() > 0) {
            $message = array("status"=>401,"pesan"=>"Email sudah digunakan, mohon diganti yang lain!");
            $this->response($message, 401);
        } else {
            if ($data =="daftar") {
                $data = array(
                    'id_user' => " ",
                    'nama' => $nama,
                    'alamat' => $alamat,
                    'tgl_lahir' => $tgl_lahir,
                    'email' => $email,
                    'password' => $password,
                    'no_hp' => $no_hp,
                    'status' => "active",
                    'kategori' => "customer",
                    'date' => $tanggal,
                    'token' => $token,
                    'saldo' => 0,
                );
                $this->M_user->insert($data);
                $id_user=$this->M_user->get_limit_data_row(1);
                $user_detail = $this->M_user->get_by_id($id_user->id_user);
                $data_json=array(
                    'status'=>200,
                    'id' => $user_detail->id_user,
                    'nama' => $user_detail->nama,
                    'email' => $user_detail->email,
                    'pesan' => "Daftar Berhasil",
                );
                $this->response($data_json, REST_Controller::HTTP_OK);
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