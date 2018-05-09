<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_surat extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_jenis_surat');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')!="admin") {
            redirect(base_url());
        }
    }

    public function index(){
        $jenis_surat = $this->M_jenis_surat->get_all();

        $data = array(
            'data_jenis_surat'  => $jenis_surat,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('jenis_surat/v_jenis_surat',$data);
    }

    public function tambah(){
        $data = array(
            'page_title' => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('jenis_surat/v_tambah_jenis_surat',$data);
    }

    public function edit($id){
        $row = $this->M_jenis_surat->get_by_id($id);
        if ($row) {
            $data = array(
                'id_jenis_surat'    => $row->id_jenis_surat,
                'kode'              => $row->kode,
                'jenis_surat'       => $row->jenis_surat,
                'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('jenis_surat/v_edit_jenis_surat', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('jenis_surat'));

        }
    }

    function simpan(){

        $kode = $_POST['kode'];
        $jenis_surat = $_POST['jenis_surat'];
        $data = array(  
            'kode'          => $kode,
            'jenis_surat'   => $jenis_surat,
        );

        $result = $this->M_jenis_surat->insert($data);
        if($result>=0){
            if(mkdir("assets/uploads/file/".$jenis_surat)){
                $this->session->set_flashdata("sukses", 'swal({
                    title: "Berhasi!",
                    text: "Data Berhasil diSimpan!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-success",
                    type: "success"
                }).catch(swal.noop)');
                header('location:'.base_url().'jenis_surat');
            }else{
                $this->session->set_flashdata("alert", 'swal({
                    title: "Gagal!",
                    text: "Data Gagal diSimpan!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error"
                }).catch(swal.noop)');
                header('location:'.base_url().'jenis_surat');
            }
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'jenis_surat');
        }
    }

    function editaction(){
        $data = array(
            'id_jenis_surat'    => $this->input->post('id'),
            'kode'              => $this->input->post('kode'),
            'jenis_surat'       => $this->input->post('jenis_surat'),
        );
        $res = $this->M_jenis_surat->update($data['id_jenis_surat'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'jenis_surat');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'jenis_surat');
        } 
    }

    function hapus(){
        $id = $this->input->post("id");
        $row = $this->M_jenis_surat->get_by_id($id);
        array_map('unlink', glob("assets/uploads/file/".$row->jenis_surat."/*.*"));
        rmdir("assets/uploads/file/".$row->jenis_surat);
        $result = $this->M_jenis_surat->delete($id);
        header('location:'.base_url().'jenis_surat'); 
    }
}
