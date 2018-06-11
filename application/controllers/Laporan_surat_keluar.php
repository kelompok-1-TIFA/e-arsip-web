<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_surat_keluar extends CI_Controller {

    function __construct()    {
        parent::__construct();
        $this ->load->model('M_surat_keluar');
        $this->load->model('M_bagian');
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
        
        $surat_keluar = $this->M_surat_keluar->get_where("WHERE tgl_arsip BETWEEN '$dari' and '$sampai'");

        $data = array(
            'dari'              => $dari,
            'sampai'            => $sampai,
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Harian"),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_harian_surat_keluar',$data);
    }
    public function Laporan_bulanan(){
        if (isset($_POST['proses'])) {
            $bulan=$this->input->post('bulan');
            $tahun=$this->input->post('tahun');
        }else{
            $bulan=date("m");
            $tahun=date("Y");
        }
        $surat_keluar = $this->M_surat_keluar->get_where("WHERE MONTH(tgl_arsip) = '$bulan' and YEAR(tgl_arsip) = '$tahun'");

        $data = array(
            'bulan'             => $bulan,
            'tahun'             => $tahun,
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Bulanan"),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_bulanan_surat_keluar',$data);
    }
    public function Laporan_tahunan(){
        if (isset($_POST['proses'])) {
            $tahun=$this->input->post('tahun');
        }else{
            $tahun=date("Y");
        }
        $surat_keluar = $this->M_surat_keluar->get_where("WHERE YEAR(tgl_arsip) = '$tahun'");

        $data = array(
            'tahun'             => $tahun,
            'data_surat_keluar' => $surat_keluar,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Tahunan"),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_tahunan_surat_keluar',$data);
    }

    public function Laporan_harian_print(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $dari=$this->input->get('dari');
        $sampai=$this->input->get('sampai');
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        $sekertaris= $this->M_user->getwhere(array('level_user' => "sekertaris", ))->row();
        $surat_keluar = $this->M_surat_keluar->get_where("WHERE tgl_arsip BETWEEN '$dari' and '$sampai'");

        $data = array(
            'dari'              => $dari,
            'sampai'            => $sampai,
            'data_surat_keluar' => $surat_keluar,
            'nama_kepala_desa'  => $kepaladesa->nama,
            'nip_kepala_desa'   => $kepaladesa->nip,
            'nama_sekertaris'   => $sekertaris->nama,
            'nip_sekertaris'    => $sekertaris->nip,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Harian"),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_harian_surat_keluar_print',$data);
    }
    public function Laporan_bulanan_print(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $bulan=$this->input->get('bulan');
        $tahun=$this->input->get('tahun');
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        $sekertaris= $this->M_user->getwhere(array('level_user' => "sekertaris", ))->row();
        $surat_keluar = $this->M_surat_keluar->get_where("WHERE MONTH(tgl_arsip) = '$bulan' and YEAR(tgl_arsip) = '$tahun'");

        $data = array(
            'bulan'             => $bulan,
            'tahun'             => $tahun,
            'data_surat_keluar' => $surat_keluar,
            'nama_kepala_desa'  => $kepaladesa->nama,
            'nip_kepala_desa'   => $kepaladesa->nip,
            'nama_sekertaris'   => $sekertaris->nama,
            'nip_sekertaris'    => $sekertaris->nip,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Bulanan"),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_bulanan_surat_keluar_print',$data);
    }
    public function Laporan_tahunan_print(){
        if ($this->session->userdata('level_user')!="sekertaris") {
            redirect(base_url());
        }
        $tahun=$this->input->get('tahun');
        $kepaladesa= $this->M_user->getwhere(array('level_user' => "kepala desa", ))->row();
        $sekertaris= $this->M_user->getwhere(array('level_user' => "sekertaris", ))->row();
        $surat_keluar = $this->M_surat_keluar->get_where("WHERE YEAR(tgl_arsip) = '$tahun'");

        $data = array(
            'tahun'             => $tahun,
            'data_surat_keluar' => $surat_keluar,
            'nama_kepala_desa'  => $kepaladesa->nama,
            'nip_kepala_desa'   => $kepaladesa->nip,
            'nama_sekertaris'   => $sekertaris->nama,
            'nip_sekertaris'    => $sekertaris->nip,
            'page_title'        => ucwords(str_replace("_", " ", $this->uri->segment(1))." Tahunan"),
        );
        $this->load->view('laporan_surat_keluar/v_laporan_tahunan_surat_keluar_print',$data);
    }
}