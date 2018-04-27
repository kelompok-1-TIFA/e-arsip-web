<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_surat_masuk');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
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
        $data = array(
            'page_title' => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_masuk/v_tambah_surat_masuk',$data);
    }

    public function edit($id){
        $row = $this->M_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_masuk'=> $row->id_surat_masuk,
                'surat_masuk'          => $row->surat_masuk,
                
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_masuk/v_edit_surat_masuk', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('surat_masuk'));

        }
    }

    function simpan(){

        $surat_masuk= $_POST['surat_masuk'];
        $data = array(  
            'id_surat_masuk' => "",
            'surat_masuk'    => $surat_masuk, 
        );

        $result = $this->M_surat_masuk->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Simpan data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'surat_masuk');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Simpan data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'surat_masuk');
        }
    }

    function editaction(){
        $data = array(
            'id_surat_masuk'=> $this->input->post('id'),
            'surat_masuk'          => $this->input->post('surat_masuk'),
            
        );
        $res = $this->M_surat_masuk->update($data['id_surat_masuk'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'surat_masuk');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'surat_masuk');
        }       
    }

    function hapus($id_surat_masuk = 1){
        $result = $this->M_surat_masuk->delete($id_surat_masuk);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Hapus data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'surat_masuk');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Hapus data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'surat_masuk');
        }   
    }
}