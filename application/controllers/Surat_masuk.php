<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_surat_masuk');
        $this->load->model('M_jenis_surat');
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
            'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
            'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('surat_masuk/v_tambah_surat_masuk',$data);
    }

    public function edit($id){
        $row = $this->M_surat_masuk->get_by_id($id);
        if ($row) {
            $data = array(
                'id_surat_masuk'    => $row->id_surat_masuk,
                'no_surat'          => $row->no_surat,
                'asal_surat'        => $row->asal_surat,
                'isi_singkat'       => $row->isi_singkat,
                'id_jenis_surat'    => $row->id_jenis_surat,
                'perihal'           => $row->perihal,
                'tgl_surat'         => $row->tgl_surat,
                'keterangan'        => $row->keterangan,
                'file'              => $row->file,
                'data_jenis_surat'  => $this->M_jenis_surat->get_all(),
                'page_title'        => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('surat_masuk/v_edit_surat_masuk', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('surat_masuk'));

        }
    }

    function simpan(){
        $no_surat= $this->input->post('no_surat');
        $asal_surat= $this->input->post('asal_surat');
        $isi_singkat=$this->input->post('isi_singkat');
        $id_jenis_surat=$this->input->post('id_jenis_surat');
        $perihal=$this->input->post('perihal');
        $tgl_surat=$this->input->post('tgl_surat');
        $keterangan=$this->input->post('keterangan');

        $data = array(  
            'id_surat_masuk' => "",
            'no_surat'    => $no_surat, 
            'asal_surat' => $asal_surat,
            'isi_singkat' => $isi_singkat,
            'id_jenis_surat'=>$id_jenis_surat,
            'perihal' => $perihal,
            'tgl_surat' =>$tgl_surat,
            'tgl_arsip'  => date("Y-m-d"),
            'keterangan' =>$keterangan,
            
        );

        $result = $this->M_surat_masuk->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'surat_masuk');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'surat_masuk');
        }
    }

    function editaction(){
        $no_surat= $this->input->post('no_surat');
        $asal_surat= $this->input->post('asal_surat');
        $isi_singkat=$this->input->post('isi_singkat');
        $id_jenis_surat=$this->input->post('id_jenis_surat');
        $perihal=$this->input->post('perihal');
        $tgl_surat=$this->input->post('tgl_surat');
        $keterangan=$this->input->post('keterangan');

        $data = array(  
            'id_surat_masuk'    => $this->input->post('id'),
            'no_surat'          => $no_surat, 
            'asal_surat'        => $asal_surat,
            'isi_singkat'       => $isi_singkat,
            'id_jenis_surat'    => $id_jenis_surat,
            'perihal'           => $perihal,
            'tgl_surat'         => $tgl_surat,
            'keterangan'        => $keterangan,
            
        );
        $res = $this->M_surat_masuk->update($data['id_surat_masuk'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'surat_masuk');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'surat_masuk');
        }       
    }

    function hapus(){
        $id = $this->input->post("id");
        $result = $this->M_surat_masuk->delete($id);
        header('location:'.base_url().'surat_masuk');    
    }
}