<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_jabatan');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')!="admin") {
            redirect(base_url());
        }
    }

    public function index(){
        $jabatan = $this->M_jabatan->get_all();

        $data = array(
            'data_jabatan'  => $jabatan,
            'page_title'    => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('jabatan/v_jabatan',$data);
    }

    public function tambah(){
        $data = array(
            'page_title' => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('jabatan/v_tambah_jabatan',$data);
    }

    public function edit($id){
        $row = $this->M_jabatan->get_by_id($id);
        if ($row) {
            $data = array(
                'id_jabatan'    => $row->id_jabatan,
                'jabatan'       => $row->jabatan,
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('jabatan/v_edit_jabatan', $data);
        } else {
            $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('jabatan'));

        }
    }

    function simpan(){

        $jabatan= $_POST['jabatan'];
        $data = array(  
            'id_jabatan' => "",
            'jabatan'    => $jabatan, 
        );

        $result = $this->M_jabatan->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'jabatan');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'jabatan');
        }
    }

    function editaction(){
        $data = array(
            'id_jabatan'    => $this->input->post('id'),
            'jabatan'       => $this->input->post('jabatan'),
            
        );
        $res = $this->M_jabatan->update($data['id_jabatan'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'jabatan');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'jabatan');
        }       
    }

    function hapus(){
        $id = $this->input->post("id");
        $result = $this->M_jabatan->delete($id);
        header('location:'.base_url().'jabatan'); 
    }
}
