<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load-> model('M_disposisi');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function index(){
        $disposisi = $this->M_disposisi->get_all();

        $data = array(
            'data_disposisi'    => $disposisi,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('disposisi/v_disposisi',$data);
    }

    public function mendisposisikan($id){
        $data = array(
            'page_title'   => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('disposisi/v_mendisposisikan',$data);
    }

    public function edit($id){
        $row = $this->M_disposisi->get_by_id($id);
       
        if ($row) {
            $data = array(
                'id_disposisi'                  => $row->id_disposisi,
                'id_bagian'                     => $row->id_bagian,
                'nip'                           => $row->nip,
                'isi_disposisi'                 => $row->isi_disposisi,
                'sifat'                         => $row->sifat,
                'catatan'                       => $row->catatan,
                'id_surat_masuk'                => $row->id_surat_masuk,
                'data_bagian'                   => $this->M_bagian->get_all(),
                'page_title'                    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
            );
            $this->load->view('disposisi/v_disposisi', $data);
        } else {
             $this->session->set_flashdata('message', 'swal({
                title: "Alert",
                text: "Data Tidak Ditemukan !",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "warning"
            }).catch(swal.noop)');
            redirect(site_url('disposisi'));

        }
    }

    public function simpan(){
        $id_disposisi= $this->input->post('id_disposisi');
        $id_bagian= $this->input->post('id_bagian');
        $nip= $this->input->post('nip');
        $isi_disposisi= $this->input->post('isi_disposisi');
        $sifat= $this->input->post('sifat');
        $catatan= $this->input->post('catatan');
        $id_surat_masuk= $this->input->post('id_surat_masuk');
        $data = array(
            'id_disposisi'   => "",
            'id_bagian'      => $id_bagian, 
            'nip'            => $nip, 
            'isi_disposisi'  => $isi_disposisi, 
            'sifat'          => $sifat, 
            'catatan'        => $catatan, 
            'id_surat_masuk' => $id_surat_masuk, 
            );
        $result = $this->M_disposisi->insert($data);
        if($result>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diSimpan!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');
        }


        
    }

    public function editaction(){
        $id_disposisi= $this->input->post('id_disposisi');
        $id_bagian= $this->input->post('id_bagian');
        $nip= $this->input->post('nip');
        $isi_disposisi= $this->input->post('isi_disposisi');
        $sifat= $this->input->post('sifat');
        $catatan= $this->input->post('catatan');
        $id_surat_masuk= $this->input->post('id_surat_masuk');
        $data = array(
            'id_disposisi'   => $this->input->post('id'),
            'id_bagian'      => $id_bagian, 
            'nip'            => $nip, 
            'isi_disposisi'  => $isi_disposisi, 
            'sifat'          => $sifat, 
            'catatan'        => $catatan, 
            'id_surat_masuk' => $id_surat_masuk, 
            );
        $res = $this->M_disposisi->update($data['id_disposisi'],$data);
        if($res>=0){
            $this->session->set_flashdata("sukses", 'swal({
                title: "Berhasi!",
                text: "Data Berhasil diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-success",
                type: "success"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');
        }else{
            $this->session->set_flashdata("alert", 'swal({
                title: "Gagal!",
                text: "Data Gagal diUpdate!",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-danger",
                type: "error"
            }).catch(swal.noop)');
            header('location:'.base_url().'disposisi');
             
    }

        # code...
    }

    public function lembar_disposisi($id){
        # code...
    }

    public function lembar_disposisi_print($id){
        # code...
    }

    public function hapus(){
        $id = $this->input->post("id");
        $result = $this->M_disposisi->delete($id);
        header('location:'.base_url().'disposisi'); 
        # code...
    }
}