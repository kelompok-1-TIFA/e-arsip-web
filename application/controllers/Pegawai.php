<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this->load->model('M_pegawai');
        $this->load->model('M_bagian');
        $this->load->model('M_jabatan');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function index(){
        $pegawai = $this->M_pegawai->get_where(" LEFT JOIN tb_bagian ON tb_bagian.id_bagian=tb_pegawai.id_bagian_pegawai LEFT JOIN tb_jabatan ON tb_jabatan.id_jabatan=tb_pegawai.id_jabatan_pegawai");

        $data = array(
            'data_pegawai'  => $pegawai,
            'page_title'    => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('pegawai/v_pegawai',$data);
    }

    public function tambah(){
        $data = array(
            'data_bagian'   => $this->M_bagian->get_all(),
            'data_jabatan'  => $this->M_jabatan->get_all(),
            'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('pegawai/v_tambah_pegawai',$data);
    }

    public function edit($id){
        $row = $this->M_pegawai->get_by_id($id);
        if ($row) {
            $data = array(
                'nip'   		          => $row->nip,
                'id_bagian_pegawai'       => $row->id_bagian_pegawai,
                'id_jabatan_pegawai'      => $row->id_jabatan_pegawai,
                'niap'                    => $row->niap,
                'nama'                    => $row->nama,
                'jenis_kelamin'           => $row->jenis_kelamin,
                'tempat_lahir'            => $row->tempat_lahir,
                'tgl_lahir'               => $row->tgl_lahir,
                'agama'                   => $row->agama,
                'pangkat'                 => $row->pangkat,
                'alamat'                  => $row->alamat,
                'no_hp'                   => $row->no_hp,
                'pendidikan_terakhir'     => $row->pendidikan_terakhir,
                'sk_pengangkatan'         => $row->sk_pengangkatan,
               

                'data_bagian'   => $this->M_bagian->get_all(),
                'data_jabatan'  => $this->M_jabatan->get_all(),
                'page_title'    => ucwords($this->uri->segment(2)." ".str_replace("_", " ", $this->uri->segment(1))),
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
        $nip= $this->input->post('nip');
        $id_bagian_pegawai= $this->input->post('id_bagian');
        $id_jabatan_pegawai= $this->input->post('id_jabatan');
        $niap= $this->input->post('niap');
        $nama= $this->input->post('nama');
        $jenis_kelamin= $this->input->post('jenis_kelamin');
        $tempat_lahir= $this->input->post('tempat_lahir');
        $tgl_lahir= $this->input->post('tgl_lahir');
        $agama= $this->input->post('agama');
        $pangkat= $this->input->post('pangkat');
        $alamat= $this->input->post('alamat');
        $no_hp= $this->input->post('no_hp');
        $pendidikan_terakhir= $this->input->post('pendidikan_terakhir');
        $sk_pengangkatan= $this->input->post('sk_pengangkatan');

        $data = array( 
             'nip'                  => $nip,
             'id_bagian_pegawai'    => $id_bagian_pegawai, 
             'id_jabatan_pegawai'   => $id_jabatan_pegawai, 
             'niap'                 => $niap, 
             'nama'                 => $nama, 
             'jenis_kelamin'        => $jenis_kelamin, 
             'tempat_lahir'         => $tempat_lahir, 
             'tgl_lahir'            => $tgl_lahir, 
             'agama'                => $agama, 
             'pangkat'              => $pangkat, 
             'alamat'               => $alamat, 
             'no_hp'                => $no_hp, 
             'pendidikan_terakhir'  => $pendidikan_terakhir, 
             'sk_pengangkatan'      => $sk_pengangkatan, 
             

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
        $nip= $this->input->post('nip');
        $id_bagian_pegawai= $this->input->post('id_bagian');
        $id_jabatan_pegawai= $this->input->post('id_jabatan');
        $niap= $this->input->post('niap');
        $nama= $this->input->post('nama');
        $jenis_kelamin= $this->input->post('jenis_kelamin');
        $tempat_lahir= $this->input->post('tempat_lahir');
        $tgl_lahir= $this->input->post('tgl_lahir');
        $agama= $this->input->post('agama');
        $pangkat= $this->input->post('pangkat');
        $alamat= $this->input->post('alamat');
        $no_hp= $this->input->post('no_hp');
        $pendidikan_terakhir= $this->input->post('pendidikan_terakhir');
        $sk_pengangkatan= $this->input->post('sk_pengangkatan');

        $data = array(
            'nip'                   => $nip,
            'niap'                  => $niap, 
            'nama'                  => $nama, 
            'jenis_kelamin'         => $jenis_kelamin, 
            'tempat_lahir'          => $tempat_lahir, 
            'tgl_lahir'             => $tgl_lahir, 
            'agama'                 => $agama, 
            'pangkat'               => $pangkat, 
            'alamat'                => $alamat, 
            'no_hp'                 => $no_hp, 
            'pendidikan_terakhir'   => $pendidikan_terakhir, 
            'sk_pengangkatan'       => $sk_pengangkatan, 
             
            
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