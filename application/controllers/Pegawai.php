<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_pegawai');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function index(){
        $pegawai = $this->M_pegawai->get_all();

        $data = array(
            'data_pegawai'  => $pegawai,
            'page_title'    => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('pegawai/v_pegawai',$data);
    }

    public function tambah(){
        $data = array(
            'page_title' => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('pegawai/v_tambah_pegawai',$data);
    }

    public function edit($id){
        $row = $this->M_pegawai->get_by_id($id);
        if ($row) {
            $data = array(
                'nip'		=> $row->nip,
                'page_title'=> ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('pegawai/v_edit_pegawai', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));

        }
    }

    function simpan(){

        $data = array(  
            'nip'=> $this->input->post('nip'),
            'nama_pegawai'   => $this->input->post('nama_pegawai'), 
        );

        $result = $this->M_pegawai->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Simpan data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'pegawai');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Simpan data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'pegawai');
        }
    }

    function editaction(){
        $data = array(
            'nip'=> $this->input->post('nip'),
            'nama_pegawai'   => $this->input->post('nama_pegawai'),
            
        );
        $res = $this->M_pegawai->update($data['nip'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'pegawai');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'pegawai');
        }       
    }

    function hapus($nip = 1){
        $result = $this->M_pegawai->delete($nip);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Hapus data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'pegawai');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Hapus data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'pegawai');
        }   
    }
}