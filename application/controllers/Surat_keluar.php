<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load->model('M_surat_keluar');
        $this->load->model('M_bagian');
        $this->load->model('M_user');
        $this->load->model('M_notifikasi');
        $this->load->model('M_jenis_surat');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')=="admin" or $this->session->userdata('level_user')=="sekertaris" or $this->session->userdata('level_user')=="staf") {
            redirect(base_url());
        }

    }

   public function index(){
        if ($this->session->userdata('level_user')=="kepala desa") {
            $surat_keluar = $this->M_surat_keluar->get_all();
        }else{
            $surat_keluar = $this->M_surat_keluar->get_by_bagian($this->session->userdata('id_bagian'));
        }
        
        $data = array(
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_keluar/v_surat_keluar',$data);
    }

    public function tambah(){
        if ($this->session->userdata('level_user')!="kepala bagian") {
            redirect(base_url());
        }
        $data = array(
            'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
            'data_bagian'       => $this->M_bagian->get_all(),
            'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_keluar/v_tambah_surat_keluar',$data);
    }

    public function edit($id){
        if ($this->session->userdata('level_user')!="kepala bagian") {
            redirect(base_url());
        }
        $row = $this->M_surat_keluar->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_keluar'   => $row->id_surat_keluar,
                'no_surat'          => $row->no_surat,
                'id_bagian'         => $row->id_bagian,
                'tujuan'            => $row->tujuan,
                'isi_singkat'       => $row->isi_singkat,
                'id_jenis_surat'    => $row->id_jenis_surat,
                'perihal'           => $row->perihal,
                'tgl_surat'         => $row->tgl_surat,
                'keterangan'        => $row->keterangan,
                'file'              => $row->file,
                'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
                'data_bagian'       => $this->M_bagian->get_all(),
                'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_keluar/v_edit_surat_keluar', $data);
        } else {
            $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('surat_keluar'));

        }
    }

    public function simpan(){
        if ($this->session->userdata('level_user')!="kepala bagian") {
            redirect(base_url());
        }
        $no_surat= $this->input->post('no_surat');
        $id_bagian= $this->session->userdata('id_bagian');
        $tujuan=$this->input->post('tujuan');
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
            'file_name'     => "Surat_Keluar_".str_replace("/", "-", $no_surat)
        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_surat')) {
            $upload_data = $this->upload->data();

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
                'file'              => 'assets/uploads/file/'.$jenis_surat_fix.'/'.'Surat_Keluar_'.str_replace("/", "-", $no_surat).$upload_data['file_ext'],
                'nama_file'         => str_replace("/", "-", $no_surat).$upload_data['file_ext']
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
                            'message'       => "No. Surat ".$no_surat." Perihal ".$perihal,
                            'title'         => "Surat Keluar Baru ",
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
                $this->session->set_flashdata("sukses", 'swal({
                    title: "Berhasi!",
                    text: "Data Berhasil diSimpan!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success",
                    type: "success"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_keluar');
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Data Gagal diSimpan!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_keluar');
            }
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Gagal Upload File!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'surat_keluar');
        }
    }

    public function editaction(){
        if ($this->session->userdata('level_user')!="kepala bagian") {
            redirect(base_url());
        }
        $no_surat= $this->input->post('no_surat');
        $id_bagian= $this->session->userdata('id_bagian');
        $tujuan=$this->input->post('tujuan');
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
            'file_name'     => "Surat_Keluar_".str_replace("/", "-", $no_surat)
        );
        $this->load->library('upload', $config);

        if ($_FILES['file_surat']['tmp_name']!=NULL) {
            if ($this->upload->do_upload('file_surat')) {
                $upload_data = $this->upload->data();

                $data = array(  
                
                    'id_surat_keluar'   => $this->input->post('id'),
                    'no_surat'          => $no_surat, 
                    'id_bagian'         => $id_bagian,
                    'tujuan'            => $tujuan,
                    'isi_singkat'       => $isi_singkat,
                    'id_jenis_surat'    => $id_jenis_surat,
                    'perihal'           => $perihal,
                    'tgl_surat'         => $tgl_surat,
                    'keterangan'        => $keterangan,
                    'file'              => 'assets/uploads/file/'.$jenis_surat_fix.'/'.'Surat_Keluar_'.str_replace("/", "-", $no_surat).$upload_data['file_ext'],
                    'nama_file'         => str_replace("/", "-", $no_surat).$upload_data['file_ext']
                );

                $row = $this->M_surat_keluar->get_by_id($this->input->post('id'));
                unlink(str_replace("%20", " ", $row->file));
                $res = $this->M_surat_keluar->update($data['id_surat_keluar'],$data);
                if($res>=0){
                    $this->session->set_flashdata("sukses", 'swal({
                        title: "Berhasi!",
                        text: "Data Berhasil diUpdate!",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "success"
                    }).catch(swal.noop)');
                    header('location:'.base_url().'surat_keluar');
                }else{
                    $this->session->set_flashdata("alert", 'swal({
                        title: "Gagal!",
                        text: "Data Gagal diUpdate!",
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-danger",
                        type: "error"
                    }).catch(swal.noop)');
                    header('location:'.base_url().'surat_keluar');
                } 
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Gagal Upload File!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_keluar');
            }   
        }else{
            $data = array(  
                'id_surat_keluar'   => $this->input->post('id'),
                'no_surat'          => $no_surat, 
                'id_bagian'         => $id_bagian,
                'tujuan'            => $tujuan,
                'isi_singkat'       => $isi_singkat,
                'id_jenis_surat'    => $id_jenis_surat,
                'perihal'           => $perihal,
                'tgl_surat'         => $tgl_surat,
                'keterangan'        => $keterangan
            );

            $res = $this->M_surat_keluar->update($data['id_surat_keluar'],$data);
            if($res>=0){
                $this->session->set_flashdata("sukses", 'swal({
                    title: "Berhasi!",
                    text: "Data Berhasil diUpdate!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success",
                    type: "success"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_keluar');
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Data Gagal diUpdate!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'surat_keluar');
            }      
        }  
    }

    public function hapus(){
        if ($this->session->userdata('level_user')!="kepala bagian") {
            redirect(base_url());
        }
        $id = $this->input->post("id");
        $row = $this->M_surat_keluar->get_by_id($id);
        unlink(str_replace("%20", " ", $row->file));
        $result = $this->M_surat_keluar->delete($id);
        header('location:'.base_url().'surat_keluar');       
    }

    public function detail($id){
        $row = $this->M_surat_keluar->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_keluar'   => $row->id_surat_keluar,
                'no_surat'          => $row->no_surat,
                'bagian'            => $row->bagian,
                'tujuan'            => $row->tujuan,
                'isi_singkat'       => $row->isi_singkat,
                'jenis_surat'       => $row->jenis_surat,
                'perihal'           => $row->perihal,
                'tgl_surat'         => $row->tgl_surat,
                'tgl_arsip'         => $row->tgl_arsip,
                'keterangan'        => $row->keterangan,
                'file'              => $row->file,
                'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
                'data_bagian'       => $this->M_bagian->get_all(),
                'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_keluar/v_detail_surat_keluar', $data);
        } else {
            $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('surat_keluar'));

        }
    }
}