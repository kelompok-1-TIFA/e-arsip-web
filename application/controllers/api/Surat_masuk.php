<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Surat_masuk extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_surat_masuk');
        $this->load->model('M_user');
        $this->load->model('M_notifikasi');
        $this->load->model('M_jenis_surat');
    }

    function index_get(){
        if ($this->get('api')=="suratmasukall") {
            $surat_masuk = $this->M_surat_masuk->get_all();
            $jml_surat_masuk= $this->M_surat_masuk->total_rows();
            $data = array(
                'data'     => $surat_masuk,
                'jml_data' => $jml_surat_masuk
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }else if ($this->get('api')=="suratmasukdetail") {
            $surat_masuk = $this->M_surat_masuk->get_by_id($this->get('id'));
            $this->response($surat_masuk, REST_Controller::HTTP_OK);
        }
    }

    function index_post(){
        if ($this->post('api')=="tambah") {
            $no_surat= $this->post('no_surat');
            $asal_surat= $this->post('asal_surat');
            $isi_singkat=$this->post('isi_singkat');
            $id_jenis_surat=$this->post('id_jenis_surat');
            $perihal=$this->post('perihal');
            $tgl_surat=$this->post('tgl_surat');
            $keterangan=$this->post('keterangan');

            $jenis_surat=$this->M_jenis_surat->get_by_id($id_jenis_surat);

            $jenis_surat_fix=str_replace(" ", "%20", $jenis_surat->jenis_surat);

            $path='assets/uploads/file/'.$jenis_surat->jenis_surat.'/'.'Surat_Masuk_'.str_replace("/", "-", $no_surat).'.jpeg';
            if (file_put_contents($path, base64_decode($this->post('file')))) {

                $data = array(  
                    'id_surat_masuk'    => "",
                    'no_surat'          => $no_surat, 
                    'asal_surat'        => $asal_surat,
                    'isi_singkat'       => $isi_singkat,
                    'id_jenis_surat'    => $id_jenis_surat,
                    'perihal'           => $perihal,
                    'tgl_surat'         => $tgl_surat,
                    'tgl_arsip'         => date("Y-m-d"),
                    'keterangan'        => $keterangan,
                    'file'              => $path,
                    'nama_file'         => 'Surat_Masuk_'.str_replace("/", "-", $no_surat).'.jpeg'
                );

                $result = $this->M_surat_masuk->insert($data);
                if($result>=0){
                    $datauser = $this->M_user->get_all();
                    $dataterakhir = $this->M_surat_masuk->get_satu_baru();
                    $to1="";
                    $data_notif = array();
                    foreach ($datauser as $user) {
                        if ($user->level_user=="kepala desa") {
                            $data_notif = array(
                                'id_notif'      => "",
                                'id_user'       => $user->id_user,
                                'id'            => $dataterakhir->id_surat_masuk,
                                'jenis_notif'   => "surat masuk",
                                'judul_notif'   => "Surat Masuk Baru ",
                                'isi_notif'     => "No. Surat ".$no_surat." Perihal ".$perihal,
                            );
                            /*send notif to android*/
                            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                            $msg = array(
                                'body'  => "No. Surat ".$no_surat." Perihal ".$perihal,
                                'title' => "Surat Masuk Baru ",
                                'sound' => 'default'
                            );
                            $dt = array(
                                'id'            => $dataterakhir->id_surat_masuk,
                                'jenis_notif'   => "surat masuk",
                                'message'       => "No. Surat ".$no_surat." Perihal ".$perihal,
                                'title'         => "Surat Masuk Baru ",
                                'sound'         => 'default'
                            );
                            $notification = [
                                "to"  => $user->token,
                                'notification'      => $msg,
                                'data'              => $dt
                            ];

                            $headers = [
                                'Authorization: key=AAAABYQOPYQ:APA91bFyhxHctHnOWHt54CQXDk9CqwID4twwFuMFwaP3GoTJmhDBfwYT0HUhyEa-8W3szf9wHJbiDG9okjXwB3h1KIoX3eyewsxBw8XNA5_sWWwVCn4CmyPYcSaO7UeQX-KG5EYsB7DA',
                                'Content-Type: application/json'
                            ];

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
                            $result = curl_exec($ch);
                            curl_close($ch);
                            /*send notif to android*/
                            $this->M_notifikasi->insert($data_notif);   
                        }
                    }
                    $this->response(['kode' => 1, 'data' => $dataterakhir,'pesan' =>'Data Berhasil disimpan!'], REST_Controller::HTTP_OK);
                }else{
                    $this->response(['kode' => 2,'pesan' =>'Data gagal diSimpan!'], REST_Controller::HTTP_OK);
                }
            }else{
                $this->response(['kode' => 3,'pesan' =>'Data gagal diSimpan1!'], REST_Controller::HTTP_OK);
            }
        }
    }

}