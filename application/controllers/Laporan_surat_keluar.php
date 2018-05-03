<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat_keluar extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load->model('M_surat_keluar');
        $this->load->model('M_bagian');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function Laporan_harian(){
        $surat_keluar = $this->M_surat_keluar->get_all();

        $data = array(
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_harian_surat_keluar',$data);
    }
    public function Laporan_bulanan(){
        $surat_keluar = $this->M_surat_keluar->get_all();

        $data = array(
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_bulanan_surat_keluar',$data);
    }
    public function Laporan_tahunan(){
        $surat_keluar = $this->M_surat_keluar->get_all();

        $data = array(
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_tahunan_surat_keluar',$data);
    }
}