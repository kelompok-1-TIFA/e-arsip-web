<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_surat extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_jenis_surat');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        /*if ($this->session->userdata('level_user')!="Operator Desa") {
            redirect(base_url());
        }*/
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
                'id_jenis_surat'=> $row->id_jenis_surat,
                'kode'          => $row->kode,
                'jenis_surat'   => $row->jenis_surat,
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('jenis_surat/v_edit_jenis_surat', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
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
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Simpan data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Simpan data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }
    }

    function editaction(){
        $data = array(
            'id_jenis_surat'=> $this->input->post('id'),
            'kode'          => $this->input->post('kode'),
            'jenis_surat'   => $this->input->post('jenis_surat'),
        );
        $res = $this->M_jenis_surat->update($data['id_jenis_surat'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", "<div class='alert alert-success'><i class='fa fa-check'></i> <strong> Update data BERHASIL dilakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }else{
            $this->session->set_flashdata("alert", "<div class='alert alert-danger'><i class='fa fa-exclamation'></i> <strong> Update data GAGAL di lakukan</strong></div>");
            header('location:'.base_url().'jenis_surat');
        }       
    }

    function hapus($kode = 1){
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
