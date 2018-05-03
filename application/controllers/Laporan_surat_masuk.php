<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat_masuk extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load->model('M_surat_masuk');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

    }

    public function Laporan_harian(){
        $surat_masuk = $this->M_surat_masuk->get_all();

        $data = array(
            'data_surat_masuk' => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_harian_surat_masuk',$data);
    }
    public function Laporan_bulanan(){
        $surat_masuk = $this->M_surat_masuk->get_all();

        $data = array(
            'data_surat_masuk' => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_bulanan_surat_masuk',$data);
    }
    public function Laporan_tahunan(){
        $surat_masuk = $this->M_surat_masuk->get_all();

        $data = array(
            'data_surat_masuk' => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_tahunan_surat_masuk',$data);
    }
}