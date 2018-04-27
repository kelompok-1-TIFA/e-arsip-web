<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this -> load -> model('M_surat_keluar');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

   public function index(){
        $surat_keluar = $this->M_surat_keluar->get_all();

        $data = array(
            'data_surat_keluar'  => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_keluar/v_surat_keluar',$data);
    }

    public function tambah(){
        $data = array(
            'page_title' => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_keluar/v_tambah_surat_keluar',$data);
    }

    public function edit($id){
        $row = $this->M_surat_keluar->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_keluar'=> $row->id_surat_keluar,
                'surat_keluar'          => $row->surat_keluar,
                
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_keluar/v_edit_surat_keluar', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat_keluar'));

        }
    }

    function simpan(){

        $surat_keluar= $_POST['surat_keluar'];
        $data = array(  
            'id_surat_keluar' => "",
            'surat_keluar'    => $surat_keluar, 
        );

        $result = $this->M_surat_keluar->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Simpan data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'surat_keluar');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Simpan data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'surat_keluar');
        }
    }

    function editaction(){
        $data = array(
            'id_surat_keluar'=> $this->input->post('id'),
            'surat_keluar'          => $this->input->post('surat_keluar'),
            
        );
        $res = $this->M_surat_keluar->update($data['id_surat_keluar'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'surat_keluar');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'surat_keluar');
        }       
    }

    function hapus($id_surat_keluar = 1){
        $result = $this->M_surat_keluar->delete($id_surat_keluar);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Hapus data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'surat_keluar');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Hapus data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'surat_keluar');
        }   
    }
}