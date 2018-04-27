<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_bagian');
        $this->load->model('M_pegawai');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        /*if ($this->session->userdata('level_user')!="Operator Desa") {
            redirect(base_url());
        }*/
    }

    public function index(){
        $bagian = $this->M_bagian->get_all();

        $data = array(
            'data_bagian'  => $bagian,
            'page_title'   => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('bagian/v_bagian',$data);
    }

    public function tambah(){
        $data = array(
            'data_pegawai'  => $this->M_pegawai->get_all(),
            'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('bagian/v_tambah_bagian',$data);
    }

    public function edit($id){
        $row = $this->M_bagian->get_by_id($id);
        if ($row) {
            $data = array(
                'id_bagian'=> $row->id_bagian,
                'bagian'          => $row->bagian,
                'kepala_bagian'   => $row->kepala_bagian,
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('bagian/v_edit_bagian', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bagian'));

        }
    }

    function simpan(){

        $kepala_bagian = $_POST['kepala_bagian'];
        $bagian= $_POST['bagian'];
        $data = array(  
            'bagian'          => $bagian,
            'kepala_bagian'   => $kepala_bagian,
        );

        $result = $this->M_bagian->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Simpan data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'bagian');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Simpan data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'bagian');
        }
    }

    function editaction(){
        $data = array(
            'id_bagian'=> $this->input->post('id'),
            'bagian'          => $this->input->post('bagian'),
            'kepala_bagian'   => $this->input->post('kepala_bagian'),
        );
        $res = $this->M_bagian->update($data['id_bagian'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'bagian');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'bagian');
        }       
    }

    function hapus($id_bagian = 1){
        $result = $this->M_bagian->delete($id_bagian);
        if($result>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Hapus data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'bagian');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Hapus data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'bagian');
        }   
    }
}
