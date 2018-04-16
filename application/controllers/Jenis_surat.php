<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_surat extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_jenis_surat');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')!="Operator Desa") {
            redirect(base_url());
        }
    }

    public function index(){
        $jenis_surat = $this->M_jenis_surat->get_all();

        $data = array(
            'data_jenis_surat' => $jenis_surat,
            'page_title' => "Jenis Surat"
        );
        $this->load->view('jenis_surat/v_jenis_surat',$data);
    }

    public function tambah(){
        $data = array('page_title' => ucwords($this->uri->segment(3)." ".$this->uri->segment(2)),);
        $this->load->view('jenis_surat/v_tambah_jenis_surat',$data);
    }

    public function edit($id){
        $row = $this->M_jenis_surat->get_by_id($id);
        if ($row) {
            $data = array(
        'kode_jenis_surat' => $row->kode_jenis_surat,
        'nama_jenis_surat' => $row->nama_jenis_surat,
        'harga' => $row->harga,
        'stok' => $row->stok,
        'page_title' => ucwords($this->uri->segment(3)." ".$this->uri->segment(2)),
        );
            $this->load->view('jenis_surat/v_edit_jenis_surat', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_surat'));
        }
    }

    function simpan(){

        $kode_jenis_surat = $_POST['kode_jenis_surat'];
        $nama_jenis_surat = $_POST['nama_jenis_surat'];

        $data = array(  
            'kode_jenis_surat'=> $kode_jenis_surat,
            'nama_jenis_surat' => $nama_jenis_surat,
            );

        $result = $this->M_jenis_surat->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Simpan data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Simpan data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }
    }

    function editaction(){
        $config = array(
            'upload_path' => './assets/upload/image/jenis_surat/',
            'allowed_types' => 'gif|jpg|JPG|png|jpeg',
            'max_size' => '2048',

        );

        $this->load->library('upload', $config);    
        $this->upload->do_upload('nama_file');
        $upload_data = $this->upload->data();

        if ($upload_data['file_name'] != null) {
            
            $data = array(
                'kode_jenis_surat' => $this->input->post('id'),
                'nama_jenis_surat' => $this->input->post('nama'),
                'atas_nama' => $this->input->post('atas_nama'),
                'no_rek' => $this->input->post('norek'),
                'image' => base_url()."assets/upload/image/jenis_surat/".$upload_data['file_name']
                );
            $row=$this->M_jenis_surat->get_by_id($data['kode_jenis_surat']);
            unlink(str_replace(base_url(), "", $row->image));
            $res = $this->M_jenis_surat->update($data['kode_jenis_surat'],$data);
            if($res>=0){
                $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
                header('location:'.base_url().'jenis_surat');
            }else{
                $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
                header('location:'.base_url().'jenis_surat');
            }       
        }else{
            
            $data = array(
                'kode_jenis_surat' => $this->input->post('id'),
                'nama_jenis_surat' => $this->input->post('nama'),
                'atas_nama' => $this->input->post('atas_nama'),
                'no_rek' => $this->input->post('norek')
                );

            $res = $this->M_jenis_surat->update($data['kode_jenis_surat'],$data);
            if($res>=0){
                $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
                header('location:'.base_url().'jenis_surat');
            }else{
                $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
                header('location:'.base_url().'jenis_surat');
            }       
        }
    }

    function hapus($kode = 1){
        $row=$this->M_jenis_surat->get_by_id($kode);
        unlink(str_replace(base_url(), "", $row->image));
        $result = $this->M_jenis_surat->delete($kode);

        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Hapus data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Hapus data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }   
    }
}
