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
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
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
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'pegawai');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
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
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'pegawai');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'pegawai');
        }       
    }

    function hapus(){
        $id = $this->input->post("id");
        $result = $this->M_pegawai->delete($id);
        header('location:'.base_url().'pegawai'); 
    }
}