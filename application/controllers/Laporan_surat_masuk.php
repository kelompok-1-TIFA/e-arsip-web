<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat_masuk extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load->model('M_surat_masuk');
        $this ->load->model('M_user');
        if ($this->session->userdata('status_login')!="login") {
            redirect(base_url(''));
        }

        if ($this->session->userdata('level_user')=="admin" or $this->session->userdata('level_user')=="kepala bagian" or $this->session->userdata('level_user')=="staf") {
            redirect(base_url());
        }
    }

    public function Laporan_harian(){
        if (isset($_POST['proses'])) {
            $dari=$this->input->post('dari');
            $sampai=$this->input->post('sampai');
        }else{
            $dari=date("Y-m-d");
            $sampai=date("Y-m-d");
        }
        
        $surat_masuk = $this->M_surat_masuk->get_where("WHERE tgl_arsip BETWEEN '$dari' and '$sampai'");

        $data = array(
            'dari'              => $dari,
            'sampai'            => $sampai,
            'data_surat_masuk' => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Harian"),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_harian_surat_masuk',$data);
    }
    public function Laporan_bulanan(){
        if (isset($_POST['proses'])) {
            $bulan=$this->input->post('bulan');
            $tahun=$this->input->post('tahun');
        }else{
            $bulan=date("m");
            $tahun=date("Y");
        }
        $surat_masuk = $this->M_surat_masuk->get_where("WHERE MONTH(tgl_arsip) = '$bulan' and YEAR(tgl_arsip) = '$tahun'");

        $data = array(
            'bulan'             => $bulan,
            'tahun'             => $tahun,
            'data_surat_masuk' => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Bulanan"),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_bulanan_surat_masuk',$data);
    }
    public function Laporan_tahunan(){
        if (isset($_POST['proses'])) {
            $tahun=$this->input->post('tahun');
        }else{
            $tahun=date("Y");
        }
        $surat_masuk = $this->M_surat_masuk->get_where("WHERE YEAR(tgl_arsip) = '$tahun'");

        $data = array(
            'tahun'             => $tahun,
            'data_surat_masuk' => $surat_masuk,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Tahunan"),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_tahunan_surat_masuk',$data);
    }

    public function Laporan_harian_print(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $dari=$this->input->get('dari');
        $sampai=$this->input->get('sampai');
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        $sekertaris= $this->M_user->getwhere(array('level_user' => "sekertaris", ))->row();

        
        $surat_masuk = $this->M_surat_masuk->get_where("WHERE tgl_arsip BETWEEN '$dari' and '$sampai'");

        $data = array(
            'dari'              => $dari,
            'sampai'            => $sampai,
            'data_surat_masuk'  => $surat_masuk,
            'nama_kepala_desa'  => $kepaladesa->nama,
            'nip_kepala_desa'   => $kepaladesa->nip,
            'nama_sekertaris'   => $sekertaris->nama,
            'nip_sekertaris'    => $sekertaris->nip,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Harian"),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_harian_surat_masuk_print',$data);
    }
    public function Laporan_bulanan_print(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $bulan=$this->input->get('bulan');
        $tahun=$this->input->get('tahun');
        $surat_masuk = $this->M_surat_masuk->get_where("WHERE MONTH(tgl_arsip) = '$bulan' and YEAR(tgl_arsip) = '$tahun'");
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        $sekertaris= $this->M_user->getwhere(array('level_user' => "sekertaris", ))->row();


        $data = array(
            'bulan'             => $bulan,
            'tahun'             => $tahun,
            'data_surat_masuk'  => $surat_masuk,
            'nama_kepala_desa'  => $kepaladesa->nama,
            'nip_kepala_desa'   => $kepaladesa->nip,
            'nama_sekertaris'   => $sekertaris->nama,
            'nip_sekertaris'    => $sekertaris->nip,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Bulanan"),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_bulanan_surat_masuk_print',$data);
    }
    public function Laporan_tahunan_print(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $tahun=$this->input->get('tahun');
        $surat_masuk = $this->M_surat_masuk->get_where("WHERE YEAR(tgl_arsip) = '$tahun'");
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        $sekertaris= $this->M_user->getwhere(array('level_user' => "sekertaris", ))->row();

        $data = array(
            'tahun'             => $tahun,
            'data_surat_masuk'  => $surat_masuk,
            'nama_kepala_desa'  => $kepaladesa->nama,
            'nip_kepala_desa'   => $kepaladesa->nip,
            'nama_sekertaris'   => $sekertaris->nama,
            'nip_sekertaris'    => $sekertaris->nip,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Tahunan"),
        );
        $this->load->view('laporan_surat_masuk/v_laporan_tahunan_surat_masuk_print',$data);
    }
}