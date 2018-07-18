<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Surat_keluar extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_surat_keluar');
        $this->load->model('M_user');
        $this->load->model('M_notifikasi');
        $this->load->model('M_jenis_surat');
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

    function index_post(){
        if ($this->post('api')=="tambah") {
            $no_surat= $this->post('no_surat');
            $id_bagian= $this->post('id_bagian');
            $tujuan=$this->post('tujuan');
            $isi_singkat=$this->post('isi_singkat');
            $id_jenis_surat=$this->post('id_jenis_surat');
            $perihal=$this->post('perihal');
            $tgl_surat=$this->post('tgl_surat');
            $keterangan=$this->post('keterangan');

            $jenis_surat=$this->M_jenis_surat->get_by_id($id_jenis_surat);

            $jenis_surat_fix=str_replace(" ", "%20", $jenis_surat->jenis_surat);

            $path='assets/uploads/file/'.$jenis_surat->jenis_surat.'/'.'Surat_Keluar_'.str_replace("/", "-", $no_surat).'.jpeg';
            if (file_put_contents($path, base64_decode($this->post('file')))) {
                $data = array(  
                    'id_surat_keluar'   => "",
                    'no_surat'          => $no_surat, 
                    'id_bagian'         => $id_bagian,
                    'tujuan'            => $tujuan,
                    'isi_singkat'       => $isi_singkat,
                    'id_jenis_surat'    => $id_jenis_surat,
                    'perihal'           => $perihal,
                    'tgl_surat'         => $tgl_surat,
                    'tgl_arsip'         => date("Y-m-d"),
                    'keterangan'        => $keterangan,
                    'file'              => $path,
                    'nama_file'         => 'Surat_Keluar_'.str_replace("/", "-", $no_surat).'.jpeg'
                );

                $result = $this->M_surat_keluar->insert($data);
                if($result>=0){
                    $datauser = $this->M_user->get_where_default("LEFT JOIN tb_pegawai ON tb_pegawai.nip=tb_user.nip_user WHERE id_bagian_pegawai='$data[id_bagian]' or level_user = 'kepala desa'")->result();
                    $dataterakhir = $this->M_surat_keluar->get_satu_baru();
                    foreach ($datauser as $user) {
                        if ($user->level_user=="kepala desa") {
                            $data_notif = array(
                                'id_notif'      => "",
                                'id_user'       => $user->id_user,
                                'id'            => $dataterakhir->id_surat_keluar,
                                'jenis_notif'   => "surat keluar",
                                'judul_notif'   => "Surat Keluar Baru ",
                                'isi_notif'     => "No. Surat ".$no_surat." Perihal ".$perihal,
                            );
                            /*send notif to android*/
                            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                            $msg = array(
                                'body'  => "No. Surat ".$no_surat." Perihal ".$perihal,
                                'title' => "Surat Keluar Baru ",
                                'sound' => 'default'
                            );
                            $dt = array(
                                'id'            => $dataterakhir->id_surat_keluar,
                                'jenis_notif'   => "surat keluar",
                                'message'  => "No. Surat ".$no_surat." Perihal ".$perihal,
                                'title' => "Surat Keluar Baru ",
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
                    $this->response(['kode' => 3,'pesan' =>'Data gagal disimpan!'], REST_Controller::HTTP_OK);
                }
            }else{
                echo $this->post('file');
                $this->response(['kode' => 2,'pesan' =>'Data gagal disimpan!'], REST_Controller::HTTP_OK);
            } 
        }
    }

}