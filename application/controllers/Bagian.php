<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_bagian');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')!="admin") {
            redirect(base_url());
        }
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
            'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('bagian/v_tambah_bagian',$data);
    }

    public function edit($id){
        $row = $this->M_bagian->get_by_id($id);
        if ($row) {
            $data = array(
                'id_bagian'     => $row->id_bagian,
                'bagian'        => $row->bagian,
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('bagian/v_edit_bagian', $data);
        } else {
            $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('bagian'));

        }
    }

    function simpan(){
        $bagian= $_POST['bagian'];
        $data = array(  
            'bagian'        => $bagian,
        );

        $result = $this->M_bagian->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'bagian');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'bagian');
        }
    }

    function editaction(){
        $data = array(
            'id_bagian'     => $this->input->post('id'),
            'bagian'        => $this->input->post('bagian'),
        );
        $res = $this->M_bagian->update($data['id_bagian'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'bagian');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'bagian');
        }       
    }

    function hapus(){
        $id = $this->input->post("id");
        $result = $this->M_bagian->delete($id);
        header('location:'.base_url().'bagian');
    }
}
