<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load-> model('M_disposisi');
        $this ->load-> model('M_bagian');
        $this ->load-> model('M_user');
        $this ->load-> model('M_notifikasi');
        $this ->load-> model('M_surat_masuk');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')=="admin" or $this->session->userdata('level_user')=="sekertaris") {
            redirect(base_url());
        }

    }

    public function index(){
        if ($this->session->userdata('level_user')=="kepala desa") {
            $disposisi = $this->M_disposisi->get_all();
        }else{
            $disposisi = $this->M_disposisi->get_by_bagian($this->session->userdata('id_bagian'));
        }

        $data = array(
            'data_disposisi'    => $disposisi,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('disposisi/v_disposisi',$data);
    }

    public function mendisposisikan($id){
        if ($this->session->userdata('level_user')!="kepala desa") {
            redirect(base_url());
        }
        $row = $this->M_surat_masuk->get_by_id($id);
        $data = array(
            'data_bagian'   => $this->M_bagian->get_all(),
            'no_surat'      => $row->no_surat,
            'id_surat_masuk'=> $row->id_surat_masuk,
            'page_title'    => ucwords(str_replace("_", " ", $this->uri->segment(2))),
        );
        $this->load->view('disposisi/v_mendisposisikan',$data);
    }

    public function edit($id){
        if ($this->session->userdata('level_user')!="kepala desa") {
            redirect(base_url());
        }
        $row = $this->M_disposisi->get_by_id($id);
       
        if ($row) {
            $data = array(
                'id_disposisi'                  => $row->id_disposisi,
                'id_bagian'                     => $row->id_bagian,
                'isi_disposisi'                 => $row->isi_disposisi,
                'sifat'                         => $row->sifat,
                'catatan'                       => $row->catatan,
                'id_surat_masuk'                => $row->id_surat_masuk,
                'data_bagian'                   => $this->M_bagian->get_all(),
                'page_title'                    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('disposisi/v_edit_disposisi', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('disposisi'));

        }
    }

    public function simpan(){
        if ($this->session->userdata('level_user')!="kepala desa") {
            redirect(base_url());
        }
        $id_bagian= $this->input->post('id_bagian');
        $isi_disposisi= $this->input->post('isi_disposisi');
        $sifat= $this->input->post('sifat');
        $catatan= $this->input->post('catatan');
        $id_surat_masuk= $this->input->post('id');
        $data = array(
            'id_disposisi'      => "",
            'id_bagian'         => $id_bagian, 
            'isi_disposisi'     => $isi_disposisi, 
            'sifat'             => $sifat, 
            'catatan'           => $catatan, 
            'id_surat_masuk'    => $id_surat_masuk,
            'tgl_disposisi'     => date("Y-m-d")
            );
        $result = $this->M_disposisi->insert($data);
        if($result>=0){
            $datauser = $this->M_user->get_where_default("LEFT JOIN tb_pegawai ON tb_pegawai.nip=tb_user.nip_user WHERE id_bagian_pegawai='$data[id_bagian]' or level_user = 'kepala desa'")->result();
            $dataterakhir = $this->M_disposisi->get_satu_baru();
            $datasurat = $this->M_surat_masuk->get_by_id($id_surat_masuk);
            foreach ($datauser as $user) {
                if ($user->level_user=="kepala bagian" or $user->level_user=="staf") {
                    $data_notif = array(
                        'id_notif'      => "",
                        'id_user'       => $user->id_user,
                        'id'            => $dataterakhir->id_disposisi,
                        'jenis_notif'   => "disposisi",
                        'judul_notif'   => "Disposisi Baru ",
                        'isi_notif'     => "No. Surat ".$datasurat->no_surat." Isi Disposisi ".$dataterakhir->isi_disposisi,
                    );
                    /*send notif to android*/
                    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                    $msg = array(
                        'body'  => "No. Surat ".$datasurat->no_surat." Isi Disposisi ".$dataterakhir->isi_disposisi,
                        'title' => "Disposisi Baru ",
                        'sound' => 'default'
                    );
                    $dt = array(
                        'id'            => $dataterakhir->id_disposisi,
                        'jenis_notif'   => "disposisi",
                        'message'  => "No. Surat ".$datasurat->no_surat." Isi Disposisi ".$dataterakhir->isi_disposisi,
                        'title' => "Disposisi Baru ",
                        'sound' => 'default'
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
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi/lembar_disposisi/'.$dataterakhir->id_disposisi);
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');
        }
    }

    public function editaction(){
        if ($this->session->userdata('level_user')!="kepala desa") {
            redirect(base_url());
        }
        $id_bagian= $this->input->post('id_bagian');
        $isi_disposisi= $this->input->post('isi_disposisi');
        $sifat= $this->input->post('sifat');
        $catatan= $this->input->post('catatan');
        $id_surat_masuk= $this->input->post('id_surat_masuk');
        $data = array(
            'id_disposisi'   => $this->input->post('id'),
            'isi_disposisi'  => $isi_disposisi, 
            'sifat'          => $sifat, 
            'catatan'        => $catatan, 
            );
        $res = $this->M_disposisi->update($data['id_disposisi'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');      
        }
    }

    public function lembar_disposisi($id){
        $row = $this->M_disposisi->get_by_id($id);
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        if ($row) {

            $data = array(
                'id_disposisi'                  => $row->id_disposisi,
                'id_bagian'                     => $row->id_bagian,
                'isi_disposisi'                 => $row->isi_disposisi,
                'sifat'                         => $row->sifat,
                'catatan'                       => $row->catatan,
                'id_surat_masuk'                => $row->id_surat_masuk,
                'no_surat'                      => $row->no_surat,
                'asal_surat'                    => $row->asal_surat,
                'tgl_arsip'                     => $row->tgl_arsip,
                'tgl_surat'                     => $row->tgl_surat,
                'tgl_disposisi'                 => $row->tgl_disposisi,
                'nama_kepala_desa'              => $kepaladesa->nama,
                'nip_kepala_desa'               => $kepaladesa->nip,
                'data_bagian'                   => $this->M_bagian->get_all(),
                'page_title'                    => ucwords(str_replace("_", " ", $this->uri->segment(2))),
            );
            $this->load->view('disposisi/v_lembar_disposisi', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('disposisi'));

        }
    }

    public function lembar_disposisi_print($id){
       $row = $this->M_disposisi->get_by_id($id);
       $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        if ($row) {

            $data = array(
                'id_disposisi'                  => $row->id_disposisi,
                'id_bagian'                     => $row->id_bagian,
                'isi_disposisi'                 => $row->isi_disposisi,
                'sifat'                         => $row->sifat,
                'catatan'                       => $row->catatan,
                'id_surat_masuk'                => $row->id_surat_masuk,
                'no_surat'                      => $row->no_surat,
                'asal_surat'                    => $row->asal_surat,
                'tgl_arsip'                     => $row->tgl_arsip,
                'tgl_surat'                     => $row->tgl_surat,
                'tgl_disposisi'                 => $row->tgl_disposisi,
                'nama_kepala_desa'              => $kepaladesa->nama,
                'nip_kepala_desa'               => $kepaladesa->nip,
                'data_bagian'                   => $this->M_bagian->get_all(),
                'page_title'                    => ucwords(str_replace("_", " ", $this->uri->segment(2))),
            );
            $this->load->view('disposisi/v_lembar_disposisi_print', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('disposisi'));

        }
    }

    public function hapus(){
        if ($this->session->userdata('level_user')!="kepala desa") {
            redirect(base_url());
        }
        $id = $this->input->post("id");
        $result = $this->M_disposisi->delete($id);
        header('location:'.base_url().'disposisi'); 
    }
}