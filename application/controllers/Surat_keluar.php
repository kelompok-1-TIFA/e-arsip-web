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
            'data_surat_keluar' => $surat_keluar,
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
                'id_surat_keluar'   => $row->id_surat_keluar,
                'no_surat'          => $row->no_surat,
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

    function simpan(){

        $no_surat= $_POST['no_surat'];
        $data = array(  
            'id_surat_keluar'   => "",
            'no_surat'          => $no_surat, 
        );

        $result = $this->M_surat_keluar->insert($data);
        if($result>=0){
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
    }

    function editaction(){
        $data = array(
            'id_surat_keluar'=> $this->input->post('id'),
            'no_surat'       => $this->input->post('no_surat'),
            
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

    function hapus(){
        $id = $this->input->post("id");
        $result = $this->M_jenis_surat->delete($id);
        header('location:'.base_url().'surat_keluar');       
    }
}