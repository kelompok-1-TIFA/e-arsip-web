<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_surat_masuk');
        $this->load->model('M_jenis_surat');
        $this->load->model('M_user');
        $this->load->model('M_disposisi');
        $this->load->model('M_notifikasi');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')=="admin") {
            redirect(base_url());
        }

    }

   public function index(){
        $surat_masuk = $this->M_surat_masuk->get_all();

        $data = array(
            'data_surat_masuk'  => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_masuk/v_surat_masuk',$data);
    }

    public function tambah(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $data = array(
            'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
            'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_masuk/v_tambah_surat_masuk',$data);
    }

    public function edit($id){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $row = $this->M_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_masuk'    => $row->id_surat_masuk,
                'no_surat'          => $row->no_surat,
                'asal_surat'        => $row->asal_surat,
                'isi_singkat'       => $row->isi_singkat,
                'id_jenis_surat'    => $row->id_jenis_surat,
                'perihal'           => $row->perihal,
                'tgl_surat'         => $row->tgl_surat,
                'keterangan'        => $row->keterangan,
                'file'              => $row->file,
                'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
                'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_masuk/v_edit_surat_masuk', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('surat_masuk'));

        }
    }

    public function simpan(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $no_surat= $this->input->post('no_surat');
        $asal_surat= $this->input->post('asal_surat');
        $isi_singkat=$this->input->post('isi_singkat');
        $id_jenis_surat=$this->input->post('id_jenis_surat');
        $perihal=$this->input->post('perihal');
        $tgl_surat=$this->input->post('tgl_surat');
        $keterangan=$this->input->post('keterangan');

        $jenis_surat=$this->M_jenis_surat->get_by_id($id_jenis_surat);

        $jenis_surat_fix=str_replace(" ", "%20", $jenis_surat->jenis_surat);

        $config = array(
            'upload_path'   => './assets/uploads/file/'.$jenis_surat->jenis_surat.'/',
            'allowed_types' => 'gif|jpg|JPG|png|jpeg|pdf|doc|docx',
            'max_size'      => '10240',
            'remove_space'  => TRUE,
            'file_name'     => "Surat_Masuk_".str_replace("/", "-", $no_surat)
        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_surat')) {
            $upload_data = $this->upload->data();

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
                'file'              => 'assets/uploads/file/'.$jenis_surat_fix.'/'.'Surat_Masuk_'.str_replace("/", "-", $no_surat).$upload_data['file_ext'],
                'nama_file'         => str_replace("/", "-", $no_surat).$upload_data['file_ext']
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
                            "to"            => $user->token,
                            'notification'  => $msg,
                            'data'          => $dt
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
                header('location:'.base_url().'surat_masuk');
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Data Gagal diSimpan!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_masuk');
            }
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Gagal Upload File!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'surat_masuk');
        }
    }

    public function editaction(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $no_surat= $this->input->post('no_surat');
        $asal_surat= $this->input->post('asal_surat');
        $isi_singkat=$this->input->post('isi_singkat');
        $id_jenis_surat=$this->input->post('id_jenis_surat');
        $perihal=$this->input->post('perihal');
        $tgl_surat=$this->input->post('tgl_surat');
        $keterangan=$this->input->post('keterangan');

        $jenis_surat=$this->M_jenis_surat->get_by_id($id_jenis_surat);

        $jenis_surat_fix=str_replace(" ", "%20", $jenis_surat->jenis_surat);

        $config = array(
            'upload_path'   => './assets/uploads/file/'.$jenis_surat->jenis_surat.'/',
            'allowed_types' => 'gif|jpg|JPG|png|jpeg|pdf|doc|docx',
            'max_size'      => '10240',
            'remove_space'  => TRUE,
            'file_name'     => "Surat_Masuk_".str_replace("/", "-", $no_surat)
        );
        $this->load->library('upload', $config);

        if ($_FILES['file_surat']['tmp_name']!=NULL) {
            if ($this->upload->do_upload('file_surat')) {
                $upload_data = $this->upload->data();

                $data = array(  
                    'id_surat_masuk'    => $this->input->post('id'),
                    'no_surat'          => $no_surat, 
                    'asal_surat'        => $asal_surat,
                    'isi_singkat'       => $isi_singkat,
                    'id_jenis_surat'    => $id_jenis_surat,
                    'perihal'           => $perihal,
                    'tgl_surat'         => $tgl_surat,
                    'keterangan'        => $keterangan,
                    'file'              => 'assets/uploads/file/'.$jenis_surat_fix.'/'.'Surat_Masuk_'.str_replace("/", "-", $no_surat).$upload_data['file_ext'],
                    'nama_file'         => str_replace("/", "-", $no_surat).$upload_data['file_ext']
                    
                );

                $row = $this->M_surat_masuk->get_by_id($this->input->post('id'));
                unlink(str_replace("%20", " ", $row->file));
                $res = $this->M_surat_masuk->update($data['id_surat_masuk'],$data);
                if($res>=0){
                    $this->session->set_flashdata("sukses", 'swal({
                        title: "Berhasi!",
                        text: "Data Berhasil diUpdate!",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "success"
                    }).catch(swal.noop)');
                    header('location:'.base_url().'surat_masuk');
                }else{
                    $this->session->set_flashdata("alert", 'swal({
                        title: "Gagal!",
                        text: "Data Gagal diUpdate!",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-danger",
                        type: "error"
                    }).catch(swal.noop)');
                    header('location:'.base_url().'surat_masuk');
                }  
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Gagal Upload File!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_masuk');
            }
        }else{
            $data = array(  
                'id_surat_masuk'    => $this->input->post('id'),
                'no_surat'          => $no_surat, 
                'asal_surat'        => $asal_surat,
                'isi_singkat'       => $isi_singkat,
                'id_jenis_surat'    => $id_jenis_surat,
                'perihal'           => $perihal,
                'tgl_surat'         => $tgl_surat,
                'keterangan'        => $keterangan,
                
            );
            $res = $this->M_surat_masuk->update($data['id_surat_masuk'],$data);
            if($res>=0){
                $this->session->set_flashdata("sukses", 'swal({
                    title: "Berhasi!",
                    text: "Data Berhasil diUpdate!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success",
                    type: "success"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_masuk');
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Data Gagal diUpdate!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_masuk');
            }
        }     
    }

    public function hapus(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $id = $this->input->post("id");
        $row = $this->M_surat_masuk->get_by_id($id);
        unlink(str_replace("%20", " ", $row->file));
        $result = $this->M_surat_masuk->delete($id);
        header('location:'.base_url().'surat_masuk');    
    }

    public function detail($id){
        $row = $this->M_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_masuk'    => $row->id_surat_masuk,
                'no_surat'          => $row->no_surat,
                'asal_surat'        => $row->asal_surat,
                'isi_singkat'       => $row->isi_singkat,
                'jenis_surat'       => $row->jenis_surat,
                'perihal'           => $row->perihal,
                'tgl_surat'         => $row->tgl_surat,
                'keterangan'        => $row->keterangan,
                'file'              => $row->file,
                'tgl_arsip'         => $row->tgl_arsip,
                'status_disposisi'  => $row->status_disposisi,
                'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_masuk/v_detail_surat_masuk', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('surat_masuk'));
        }
    }
}